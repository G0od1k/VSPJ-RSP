<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "db name";

$connect = mysqli_connect($servername, $username, $password, $dbname);

if (!$connect) {
    echo "Connection failed!";
}
?>