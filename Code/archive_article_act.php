<?php
session_start();

include "connect.php";
include "user.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_SESSION['email'])) {
    if ($user["role"] != 3 && $user["role"] != 4) {
        header("Location: account.php");
        exit();
    }

    $id = $connect->real_escape_string($_GET['id']);

    $sql = "UPDATE Article SET status = 1, id_release = NULL WHERE id = " . $id;
    $connect->query($sql);
}

header("Location: account.php");

?>