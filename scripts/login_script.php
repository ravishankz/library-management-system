<?php
// Start session
session_start();

// Include database connection
include('../config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = htmlspecialchars(stripslashes(trim($_POST['username'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));

    // Retrieve user data from the database
    $query = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, create session
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Login successful.";
            header("Location: ../pages/admin_panel.php");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: ../pages/login.php");
            exit();
        }
    } else {
        // User not found
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: ../pages/login.php");
        exit();
    }
} else {
    // Redirect to login page if form is not submitted
    header("Location: ../pages/login.php");
    exit();
}
?>
