<?php
session_start();
include('../config.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM user";
$result = $conn->query($query);

include('../includes/header.php');
?>

<div class="container">
    <h2>User Records</h2>
    <?php
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    } elseif (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td><a href='../scripts/update_user_form.php?user_id=" . $row["user_id"] . "' class='btn btn-primary'>Update</a> <a href='../scripts/delete_user.php?user_id=" . $row["user_id"] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>
