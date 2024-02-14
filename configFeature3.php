<?php

$host = 'localhost';
$database = 'library_system';
$username = 'root';
$password = '';

// Create connection
$database = new mysqli($host, $username, $password, $database);

// Check connection
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}