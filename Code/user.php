<?php
include "connect.php";
$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM User WHERE email='" . $_SESSION['email'] . "'"));
?>