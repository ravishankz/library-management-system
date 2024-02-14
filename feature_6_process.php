<?php
include 'feature_6_config.php';

// Add Record
if (isset($_POST['add_fine'])) {
    // Retrieve form data
    $fine_id = $_POST['fine_id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $fine_amount = $_POST['fine_amount'];
    $fine_date_modified = $_POST['fine_date_modified'];

    // Check if the provided book_id exists in the book table
    $check_book_sql = "SELECT * FROM book WHERE book_id = '$book_id'";
    $result = $conn->query($check_book_sql);
    if ($result->num_rows == 0) {
        echo "Error: Book with ID $book_id does not exist.";
        exit(); // terminate script execution
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO fine (fine_id, book_id, member_id, fine_amount, fine_date_modified)
            VALUES ('$fine_id', '$book_id', '$member_id', '$fine_amount', '$fine_date_modified')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to refresh the page after adding
        header("Location: feature_6.php");
        exit(); // terminate script execution after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete Record
if (isset($_GET['delete'])) {
    $fine_id = $_GET['delete'];
    $sql = "DELETE FROM fine WHERE fine_id='$fine_id'";
    if ($conn->query($sql) === TRUE) {
        // Redirect to refresh the page after deleting
        header("Location: feature_6.php");
        exit(); // terminate script execution after redirection
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Display Fine Records
$sql = "SELECT `fine_id`, `book_id`, `member_id`, `fine_amount`, `fine_date_modified` FROM `fine`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["fine_id"] . "</td>
                <td>" . $row["book_id"] . "</td>
                <td>" . $row["member_id"] . "</td>
                <td>" . $row["fine_amount"] . "</td>
                <td>" . $row["fine_date_modified"] . "</td>
                <td> <a href=\"feature_6_process.php?edit=" . $row['fine_id'] . "\"><button>Edit</button></a></td>
                <td> <a href=\"feature_6_process.php?delete=" . $row['fine_id'] . "\"><button>Delete</button></a></td>
            </tr>";
    }
} else {
    echo "0 results";
}


// Edit Record
if (isset($_GET['edit'])) {
    $fine_id = $_GET['edit'];
    $update = true;
    $sql = "SELECT * FROM fine WHERE fine_id='$fine_id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $fine_id = $row['fine_id'];
        $book_id = $row['book_id'];
        $member_id = $row['member_id'];
        $fine_amount = $row['fine_amount'];
        $fine_date_modified = $row['fine_date_modified'];
    }
}

// Update Record
if (isset($_POST['update'])) {
    $fine_id = $_POST['fine_id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $fine_amount = $_POST['fine_amount'];
    $fine_date_modified = $_POST['fine_date_modified'];
    $sql = "UPDATE fine SET book_id='$book_id', member_id='$member_id', fine_amount='$fine_amount', fine_date_modified='$fine_date_modified' WHERE fine_id='$fine_id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: feature_6.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


// Add Record
if (isset($_POST['add_fine'])) {
    // Retrieve form data
    $fine_id = $_POST['fine_id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $fine_amount = $_POST['fine_amount'];
    $fine_date_modified = $_POST['fine_date_modified'];

    // Check if the provided book_id exists in the book table
    $check_book_sql = "SELECT * FROM book WHERE book_id = '$book_id'";
    $result = $conn->query($check_book_sql);
    if ($result->num_rows == 0) {
        echo "Error: Book with ID $book_id does not exist.";
        exit();
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO fine (fine_id, book_id, member_id, fine_amount, fine_date_modified) VALUES ('$fine_id', '$book_id', '$member_id', '$fine_amount', '$fine_date_modified')";

    if ($conn->query($sql) === TRUE) {
        header("Location: feature_6.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>