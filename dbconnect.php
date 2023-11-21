<?php
// Define database connection variables
$servername = 'localhost';
$username = 'giginetn_user';
$password = 'Iamthatiam1!';
$dbname = 'giginetn_gigi';

// Create a PDO database connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
