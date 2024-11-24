<?php
session_start();

include "connect.php";
include "user.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['email'])) {
    $id = $connect->real_escape_string($_POST['aid']);
    $user_id = $connect->real_escape_string($_POST['uid']);
    $text = $connect->real_escape_string($_POST['text']);

    $sql = "INSERT INTO `Review` (`id_user`, `id_article`, `text`) VALUES ('" . $user_id . "','" . $id . "','" . $text . "')";
    $connect->query($sql);

    if ($user["role"] == 2) {
        $sql = "UPDATE Article SET status = 3 WHERE id = " . $id;
        $connect->query($sql);
    }
}

header("Location: account.php");

?>