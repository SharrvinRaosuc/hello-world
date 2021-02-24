<?php
$hostname = "localhost";
$database = "newssystem";
$username = "root";
$password = "iknowyou";
$mysqli = new mysqli($hostname, $username, $password, $database);
if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
mysqli_set_charset($mysqli, "utf8");
?>