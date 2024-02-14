<?php

session_start();

include('../configLog.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = htmlspecialchars(stripslashes(trim($_POST['userId'])));
    $firstName = htmlspecialchars(stripslashes(trim($_POST['firstName'])));
    $lastName = htmlspecialchars(stripslashes(trim($_POST['lastName'])));
    $username = htmlspecialchars(stripslashes(trim($_POST['username'])));
    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));

    $updateQuery = "UPDATE user SET first_name='$firstName', last_name='$lastName', username='$username', email='$email' WHERE user_id='$userId'";
    
    if ($conn->query($updateQuery) === TRUE) {
        $_SESSION['success'] = "User details updated successfully.";
        header("Location: ../pages/view_users.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating user details: " . $conn->error;
        header("Location: ../pages/view_users.php");
        exit();
    }
} else {
    header("Location: ../pages/view_users.php");
    exit();
}
?>
