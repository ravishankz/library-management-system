<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-image: url('bg.jpg');
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        margin-top: 50px;
        margin-bottom: 20px;
        font-size: 48px;
        font-weight: bold;
        color: #FFFFFF;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 1);
    }

    p {
        text-align: center;
        margin-bottom: 50px;
    }

    .button-container {
        text-align: center;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 0 auto;
        max-width: 500px;
    }

    .btn {
        margin-bottom: 10px;
        font-size: 18px;
        border-radius: 20px;
        padding: 10px 20px;
        width: 100%;
        max-width: 350px;
    }
</style>

</head>
<body>

<div class="container">
    <h1>Library Management System</h1><br><br>

    <div class="button-container">
        <button class="btn btn-primary" onclick="window.location.href = 'index.php';">Login and User Registration</button>
        <button class="btn btn-primary" onclick="window.location.href = 'page2.php';">Books Registration</button>
        <button class="btn btn-primary" onclick="window.location.href = 'page3.php';">Book Category Registration</button>
        <button class="btn btn-primary" onclick="window.location.href = 'members.php';">Library Member Registration</button>
        <button class="btn btn-primary" onclick="window.location.href = 'page5.php';">Assign Fine for a User</button>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
