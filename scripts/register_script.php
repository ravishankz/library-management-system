<?php
// Start session
session_start();

// Include database connection
include('../config.php');

// Function to sanitize input data
function sanitizeData($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $userId = sanitizeData($_POST['userId']);
    $firstName = sanitizeData($_POST['firstName']);
    $lastName = sanitizeData($_POST['lastName']);
    $username = sanitizeData($_POST['username']);
    $password = sanitizeData($_POST['password']);
    $email = sanitizeData($_POST['email']);

    // Server-side validation
    if (!preg_match('/^U\d{3}$/', $userId)) {
        $_SESSION['error'] = "User ID must be in the format 'U001'.";
        header("Location: ../register.php");
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long.";
        header("Location: ../register.php");
        exit();
    }

    // Check if username and email already exist
    $checkUsernameQuery = "SELECT * FROM user WHERE username='$username'";
    $checkEmailQuery = "SELECT * FROM user WHERE email='$email'";
    $resultUsername = $conn->query($checkUsernameQuery);
    $resultEmail = $conn->query($checkEmailQuery);

    if ($resultUsername->num_rows > 0) {
        $_SESSION['error'] = "Username already exists.";
        header("Location: ../register.php");
        exit();
    }

    if ($resultEmail->num_rows > 0) {
        $_SESSION['error'] = "Email already exists.";
        header("Location: ../register.php");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into database
    $insertQuery = "INSERT INTO user (user_id, first_name, last_name, username, password, email) VALUES ('$userId', '$firstName', '$lastName', '$username', '$hashedPassword', '$email')";
    
    if ($conn->query($insertQuery) === TRUE) {
        $_SESSION['success'] = "User registered successfully.";
        header("Location: ../pages/register.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $insertQuery . "<br>" . $conn->error;
        header("Location: ../pages/register.php");
        exit();
    }
} else {
    // Redirect to register page if form is not submitted
    header("Location: ../register.php");
    exit();
}
?>
