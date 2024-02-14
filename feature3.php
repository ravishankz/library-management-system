<?php require_once "processFeature3.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Registration</title>
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
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        h2{
            color:#800080;
            text-align:center;
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

    <h2>~ Category Registration ~</h2>
    <form method='post' action="processFeature3.php?create=true">
        <label for="category_id">Category Id:</label>
        <input type="text" id="category_id" name="category_id" required><br><br>
        
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="date">Modified Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        
        <button type="submit">Add</button>
        <button type="reset">Clear</button>
    </form>

    <?php
    $sql = "SELECT * FROM bookcategory";

    $result = $database->query($sql) or die($database->error);
    ?>
    
    <h2>~ Book Category Details ~</h2>
    <table>
        <thead>
        <tr>
            <th>Category Id</th>
            <th>Category Name</th>
            <th>Modified Date</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['category_id'] ?></td>
                    <td><?= $row['category_Name'] ?></td>
                    <td><?= $row['date_modified'] ?></td>
                    <td style="display: flex; gap: 10px; font-weight: bold">
                        <a href="editFeature3.php?category_id=<?= $row['category_id'] ?>">EDIT</a>
                        <a href="processFeature3.php?delete=true&category_id=<?= $row['category_id'] ?>">DELETE</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="7" style="text-align: center">No records are available!</td>
            </tr>
        <?php } ?>
        </thead>
        <tbody>
        </tbody>
    </table>
</body>
</html>
