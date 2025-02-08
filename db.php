<?php
$servername = "localhost";  // You can also use 'localhost'
$username = "root";         // Default username for MySQL
$password = "";             // Leave empty if no password is set for 'root'
$dbname = "banu";         // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// if (basename($_SERVER['PHP_SELF']) != 'login.php' && !isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }
?>