<?php
require_once('library.php');
require_once('configuration.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
</head>
<body>
    <h1>Library Management System</h1>

    <h2>Register a Book</h2>
    <form action="library.php" method="post">
        <label for="bookID">Book ID:</label>
        <input type="text" id="bookID" name="bookID" value='<?php echo $id ?>' required pattern="B\d{3}" title="Please enter Book ID in the format B001." ><br><br>
        <label for="bookName">Book Name:</label>
        <input type="text" id="bookName" name="bookName" value='<?php echo $name ?>' required><br><br>
        <label for="bookCategory">Book Category:</label>
        <select id="bookCategory" name="bookCategory" value='<?php echo $cat?>' required>
            <option value="C001">Sci-fi</option>
            <option value="C002">Adventure</option>
            </select><br><br>
            
            <?php if($update == true): ?>
            <input type="submit" name="update" value="UPDATE">

        <?php else: ?>
        <input type="submit" name="register" value="REGISTER">

        <?php endif; ?>
    </form>

    </body>
</html>