<?php
require_once('library.php');
require_once('configuration.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bookreg.css">
    <title>Library Management System</title>
</head>
<body>

<nav class="navbar">
<h1>LIBRARY MANAGEMENT SYSTEM</h1>
<br><br><br>
</nav>
<nav class="navbar2"><br><br>
<h2>Register a Book</h2>
</nav>
    
   
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

    <h2>Display All Books</h2>

    <table>
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Book Category</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $sql = "SELECT * FROM book";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0){

                    while($row = $result->fetch_assoc()){
                      ?>  <tr>
                            <td> <?php echo $row['book_id'] ?> </td>
                            <td> <?php echo $row['book_name'] ?> </td>
                            <td> <?php echo $row['category_id'] ?> </td>

                            <td> <a href="book.php?edit=<?php echo $row['book_id'] ?>"><button class="b1">Edit</button></a>

                            <a href="book.php?delete=<?php echo $row['book_id'] ?>"><button class="b2">Delete</button></a>
                        </tr>
                    <?php }
                }else{
                    echo "result = 0";
                }

                $conn->close();
                ?>
        </tbody>
    </table>
</body>
</html>
