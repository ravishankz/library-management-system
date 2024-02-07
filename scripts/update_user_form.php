<?php

session_start();

include('../config.php');

if (!isset($_GET['user_id'])) {
    $_SESSION['error'] = "User ID not provided.";
    header("Location: ../view_users.php");
    exit();
}

$userId = htmlspecialchars(stripslashes(trim($_GET['user_id'])));

$query = "SELECT * FROM user WHERE user_id='$userId'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    $_SESSION['error'] = "User not found.";
    header("Location: ../view_users.php");
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Details</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include('../includes/header.php'); ?>
    
    <div class="container">
        <h2>Update User Details</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="update_user.php" method="POST">
            <input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo $user['first_name']; ?>" required>
            <br>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo $user['last_name']; ?>" required>
            <br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            <br>
            <button type="submit">Update</button>
        </form>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
