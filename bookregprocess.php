<?php
require_once("Configuration.php");


session_start();

$update = false;

$id="";
$name="";
$cat="";

// Function to validate Book ID format
function validatebook_id($book_id) {
    return preg_match('/^B\d{3}$/', $book_id);
}

// Function to register a new book
function registerBook($book_id, $bookName, $bookCategory) {
    require("Configuration.php");
    
    if (validatebook_id($book_id)) {
        
        
        $stmt = $conn->prepare("INSERT INTO book (book_id, book_name, category_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $book_id, $bookName, $bookCategory);

        
        if ($stmt->execute()) {
            echo "Book registered successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid Book ID format. Please use the 'B<BOOK_ID>' format (e.g., B001).";
    }
}


// Retrieve data 

if (isset($_GET['edit'])){


    $id = $_GET['edit'];

    $update = true;

    $sql=("SELECT * FROM book WHERE `book_id`='$id' ");
    $result = $conn->query($sql) or die($conn->error);


//retrieve oher data
    if(count(array($result)) == 1){
        $row = $result->fetch_array() or die($conn->error);

        $id = $row['book_id'];
        $name = $row['book_name'];
        $cat = $row['category_id'];

    }
}


//update
if (isset($_POST['update'])){
    $id = $_POST['bookID'];
    $name = $_POST['bookName'];
    $cat = $_POST['bookCategory'];

  
    $sql = "UPDATE book SET  `book_id`='$id',`book_name`='$name',`category_id`='$cat' WHERE `book_id`='$id'";
    echo("<script>Alert('Updated!');</script>");
    $conn->query($sql) or die($conn->error);

    
    echo '<script>window.location="bookreg.php"</script>';
}




//delete
if (isset($_GET['delete'])){

    $id = $_GET['delete'];

    $sql = "DELETE FROM book WHERE book_id='$id'";

    echo("<script>confirm('Are you sure ?');</script>");

    $conn->query($sql);

    echo '<script>window.location="bookreg.php"</script>'; 

    
}

// Function to update book details
function updateBook($book_id, $newBookName, $newBookCategory) {
    require("Configuration.php");

    
    $stmt = $conn->prepare("UPDATE book SET book_name = ?, category_id = ? WHERE book_id = ?");
    $stmt->bind_param("sss", $newBookName, $newBookCategory, $book_id);

    
    if ($stmt->execute()) {
        echo "Book details updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    header("Location: bookreg.php");
    $stmt->close();
    $conn->close();
}


// Function to delete a book record
function deleteBook($book_id) {
    require("Configuration.php");

    
    $stmt = $conn->prepare("DELETE FROM book WHERE book_id = ?");
    $stmt->bind_param("s", $book_id);

    
    if ($stmt->execute()) {
        echo "Book deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}



// Check if form is submitted for registration
if (isset($_POST['register'])) {
    $book_id = $_POST['bookID'];
    $bookName = $_POST['bookName'];
    $bookCategory = $_POST['bookCategory'];
    registerBook($book_id, $bookName, $bookCategory);
    header("Location:bookreg.php");
}


// Check if action is delete and id is provided
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {

    $book_id = $_GET['id'];
    

    deleteBook($book_id);

    echo("Book Deleted");
    

    header("Location: bookreg.php");
    exit;
}




?>