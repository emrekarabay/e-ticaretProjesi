<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";

try {

    $conn = new PDO("mysql:host=$servername;dbname=kodlinekurs", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected successfully" . "<br>";

} catch (PDOException $e) {
    die($e->getMessage());
}

