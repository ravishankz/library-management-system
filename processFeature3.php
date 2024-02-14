<?php

require_once "configFeature3.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['create'])) {
    $categoryId = $_POST['category_id'];
    $name = $_POST['name'];
    $date = $_POST['date'];

    $sql = "INSERT INTO bookcategory (category_id,category_Name, date_modified) VALUES ('$categoryId', '$name', '$date')";

    try {
        $database->query($sql);

        $_SESSION['message'] = "Category added successfully.";
        $_SESSION['message_type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['message_type'] = "danger";
    }

    header("Location: feature3.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['update'])) {
    $categoryId = $_POST['category_id'];
    $name = $_POST['name'];
    $date = $_POST['date'];

    $sql = "UPDATE bookcategory SET category_name = '$name', date_modified = '$date' WHERE category_id = '$categoryId'";

    try {
        $database->query($sql);

        $_SESSION['message'] = "Category updated successfully.";
        $_SESSION['message_type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['message_type'] = "danger";
    }

    header("Location: feature3.php");
}

if (isset($_GET['delete'])) {
    $categoryId = $_GET['category_id'];

    $sql = "DELETE FROM bookcategory WHERE category_id = '$categoryId'";

    try {
        $database->query($sql);

        $_SESSION['message'] = "Category deleted successfully.";
        $_SESSION['message_type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['message_type'] = "danger";
    }

    header("Location: feature3.php");
}