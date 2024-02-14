<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fine Form</title>
    
    <style>
        .forms {
            background-color: #f2f2f2;
            align-items: center;
            padding: 30px;
            margin: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px 0 rgba(0,0,0,0.2);
        }

        label {
            font-size: 21px;
            font-weight: bold;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: #2e2295;
        }

        input {
            width: 350px;
            padding: 10px;
            margin: 10px;
            margin-left: 20px;
            border: 1px solid #2e2295;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 40px;
            font-weight: bold;
            color: #2e2295;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        button {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #246187;
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-top: 20px;
            margin-left: 42px;
            border: 2px solid #246187;
        }

        button:hover {
            background-color: #2e2295;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

</head>

<body>
<h1> Assign Fine for a User...</h1>

<div class="forms">
    <form method="post" action="feature_6_process.php">
        <div>
            <center>
                <table>
                    <tr>
                        <td><label>Fine ID :</label></td>
                        <td><input type="text" name="fine_id"></td>
                    </tr>
                    <tr>
                        <td><label>Book ID :</label></td>
                        <td><input type="text" name="book_id"></td>
                    </tr>
                    <tr>
                        <td><label>Member ID :</label></td>
                        <td><input type="text" name="member_id"></td>
                    </tr>
                    <tr>
                        <td><label>Fine Amount :</label></td>
                        <td><input type="text" name="fine_amount"></td>
                    </tr>
                    <tr>
                        <td><label>Date Modified :</label></td>
                        <td><input type="date" name="fine_date_modified"></td>
                    </tr>
                </table>
            </center>

            <center>
                <div>
                    <table>
                        <tr>
                            <td><button type="submit" name="add_fine">+ ADD</button></td>
                            <td><button type="reset" class="btn">CLEAR</button></td>
                        </tr>
                    </table>
                </div>
            </center>
        </div>
    </form>

    <center>
        <h2>Existing Fines Table</h2>
        <table>
            <tr>
                <th>Fine ID</th>
                <th>Book ID</th>
                <th>Member ID</th>
                <th>Fine Amount</th>
                <th>Date Modified</th>
                <th>Action</th>
            </tr>
            <?php include 'feature_6_process.php'; ?>
        </table>
    </center>
</div>

<form method="post" action="feature_6_process.php">
    <input type="hidden" name="fine_id" value="<?php echo $fine_id; ?>">
    <label>Book ID:</label>
    <input type="text" name="book_id" value="<?php echo $book_id; ?>"><br>
    <label>Member ID:</label>
    <input type="text" name="member_id" value="<?php echo $member_id; ?>"><br>
    <label>Fine Amount:</label>
    <input type="text" name="fine_amount" value="<?php echo $fine_amount; ?>"><br>
    <label>Date Modified:</label>
    <input type="date" name="fine_date_modified" value="<?php echo $fine_date_modified; ?>"><br>
    <button type="submit" name="update">Update</button>
</form>




</body>
</html>
