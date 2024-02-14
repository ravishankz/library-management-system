<?php require_once "processFeature3.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
        }

        * {
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 2rem 10rem;
            background-color: #f4f4f4;
        }

        h2 {
            margin: 20px 0 !important;
            color: #800080;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="text"],
        form input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        form button {
            padding: 10px 20px;
            background-color: #800080;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #800099;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #32174d;
            color: #fff;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert.success { background-color: #32174d; }
        .alert.error { background-color: #f44336; }
    </style>
</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
    <div class="alert <?= $_SESSION['message_type']; ?>" role="alert">
        <?= $_SESSION['message']; ?>
    </div>

    <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
<?php endif; ?>

<?php
$categoryId = $_GET['category_id'];

$sql = "SELECT * FROM bookcategory WHERE category_id = '$categoryId'";

$result = $database->query($sql) or die($database->error);

$row = $result->fetch_row();
?>

<h2>~ Edit Book Category ~</h2>
<form method='post' action="processFeature3.php?update=true">
    <label for="id">Category ID:</label>
    <input type="text" id="category_id" name="category_id" value="<?= $row[0]; ?>" readonly><br><br>

    <label for="name">Category Name:</label>
    <input type="text" id="name" name="name" value="<?= $row[1]; ?>" required><br><br>

    <label for="date">Modified Date:</label>
    <input type="date" id="date" name="date" value="<?= $row[2]; ?>" required><br><br>

    <button type="submit">Update</button>
</form>
</body>
</html>
