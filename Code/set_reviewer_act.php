<?php
session_start();

include "connect.php";
include "user.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['email'])) {
    $article_id = $connect->real_escape_string($_POST['aid']);
    $user_id = $connect->real_escape_string($_POST['uid']);

    $sql = "INSERT INTO ReviewBy (id_user, id_article) 
                VALUES (" . $user_id . " , $article_id)";
    $connect->query($sql);
}

header("Location: account.php");

?>