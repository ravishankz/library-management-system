<?php
// Start the session at the beginning of the file
session_start();

// Set error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "library_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST['submit']) || isset($_POST['update']))) {
    // Sanitize and retrieve form data
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $birthday = $_POST["birthday"];
    $email = $_POST["email"];

    $member_id = $_POST["member_id"];

    // Check if the member ID already exists
    $checkQuery = "SELECT * FROM member WHERE member_id = '$member_id'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Member ID already exists, update the existing record
        $updateQuery = "UPDATE member SET first_name='$first_name', last_name='$last_name', birthday='$birthday', email='$email' WHERE member_id = '$member_id'";
        $conn->query($updateQuery) or die($conn->error);
        $_SESSION['message'] = "Record has been updated!";
    } else {
        // Member ID doesn't exist, insert a new record
        $insertQuery = "INSERT INTO member (member_id, first_name, last_name, birthday, email) VALUES ('$member_id', '$first_name', '$last_name', '$birthday', '$email')";
        $conn->query($insertQuery) or die($conn->error);
        $_SESSION['message'] = "Record has been saved!";
    }

    $_SESSION['msg_type'] = "warning";
    header("Location: members.php");
    exit();
}

if (isset($_GET['delete_member_id'])) {
    $member_id = $_GET['delete_member_id'];

    // avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM member WHERE member_id = ?");
    $stmt->bind_param("s", $member_id);
    $stmt->execute();

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    $stmt->close();

    header("Location: members.php");
    exit();
}

// Retrieve data 
$result = $conn->query("SELECT * FROM member");

// action is triggered
if (isset($_GET['edit_member_id'])) {
    $u_id = $_GET['edit_member_id'];
    $update = true;

    // Retrieve other details
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $birthday = $_GET['birthday'];
    $email = $_GET['email'];

}

// is the update action is triggered
if (isset($_POST['update'])) {
    $member_id = $_POST['member_id'];
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $birthday = $_POST['birthday'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // avoid SQL injection
    $stmt = $conn->prepare("UPDATE member SET first_name=?, last_name=?, birthday=?, email=? WHERE member_id = ?");
    $stmt->bind_param("sssss", $first_name, $last_name, $birthday, $email, $member_id);
    $stmt->execute();

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    $stmt->close();
    header("Location: members.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Form</title>

  <link rel="stylesheet" href="members.css">
  <script src="members.js"></script>


</head>

<body>

    <div class="container">
        <h2 style="text-align: center;">Member Registration</h2>
        <form action="members.php" method="post" onsubmit="return validateEmail() && validateMemberID()">
            <label for="member_id">Member ID:</label>
            <input type="text" id="member_id" name="member_id" pattern="M[0-9]{3}"
                title="Enter a valid Member ID (e.g., M001)" required
                value="<?php echo isset($_GET['edit_member_id']) ? $_GET['edit_member_id'] : ''; ?>">

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required
                value="<?php echo isset($_GET['first_name']) ? $_GET['first_name'] : ''; ?>">

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required
                value="<?php echo isset($_GET['last_name']) ? $_GET['last_name'] : ''; ?>">

            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required
                value="<?php echo isset($_GET['birthday']) ? $_GET['birthday'] : ''; ?>">

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                required title="Enter a valid email address"
                value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">

            <br><br>

            <button  class='submit' type="submit" name="<?php echo isset($_GET['edit_member_id']) ? 'update' : 'submit'; ?>">
                <?php echo isset($_GET['edit_member_id']) ? 'Update' : 'Submit'; ?>
            </button>
        </form>
    </div>

    <br>
    <div class="container-table">
        <h2>Member List</h2>
        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Email Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "library_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM member");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["member_id"] . "</td>";
        echo "<td>" . $row["first_name"] . "</td>";
        echo "<td>" . $row["last_name"] . "</td>";
        echo "<td>" . $row["birthday"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>";
        echo "<button class='edit' onclick='editMember(\"$row[member_id]\", \"$row[first_name]\", \"$row[last_name]\", \"$row[birthday]\", \"$row[email]\")'>Edit</button>&nbsp&nbsp";
        echo "<button class='delete' onclick='deleteMember(\"" . $row['member_id'] . "\")'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
}

$conn->close();
?>
            </tbody>
        </table>
    </div>



</body>
</html>