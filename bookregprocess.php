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

?>