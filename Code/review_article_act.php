<?php
session_start();

include "connect.php";
include "user.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_SESSION['email'])) {
    $id = $connect->real_escape_string($_GET['id']);

    $sql = "UPDATE Article SET status = 2 WHERE id = " . $id;
    $connect->query($sql);

    $sql = "DELETE FROM ReviewBy WHERE id_article = " . $id;
    $connect->query($sql);
}

header("Location: account.php");

?>