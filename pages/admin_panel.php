<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('../includes/header.php');

include('../config.php');
?>

<div class="container">
    <h2>Admin Panel</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <ul>
        <li><a href="view_users.php">View Users</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<?php include('../includes/footer.php'); ?>
