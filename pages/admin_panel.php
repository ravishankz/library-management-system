<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: loginLog.php");
    exit();
}

include('../includes/header.php');

include('../configLog.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Panel</h2>
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
        <ul class="list-group">
            <li class="list-group-item"><a href="view_users.php">View Users</a></li>
            <li class="list-group-item"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <?php include('../includes/footer.php'); ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
