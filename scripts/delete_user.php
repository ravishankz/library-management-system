<?php

session_start();

include('../config.php');

if (isset($_GET['user_id'])) {
    $userId = htmlspecialchars(stripslashes(trim($_GET['user_id'])));
    
    $deleteQuery = "DELETE FROM user WHERE user_id='$userId'";
    
    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION['success'] = "User deleted successfully.";
        header("Location: ../pages/view_users.php");
        exit();
    } else {
        $_SESSION['error'] = "Error deleting user: " . $conn->error;
        header("Location: ../pages/admin_panel.php");
        exit();
    }
} else {
    header("Location: ../pages/admin_panel.php");
    exit();
}
?>
