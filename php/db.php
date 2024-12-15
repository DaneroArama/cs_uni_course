<?php
$servername = "mysql-daneroarama.alwaysdata.net"; // Alwaysdata server
$username = "your_username"; // Replace with your Alwaysdata username
$password = "ABC!@#$%^DEF"; // Your Alwaysdata password
$dbname = "daneroarama_users"; // Your Alwaysdata database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>