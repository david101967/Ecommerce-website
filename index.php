<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "MySQL";

try {
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";

    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
