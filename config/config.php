<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "database1";
$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);
if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
}
echo "";
?>
