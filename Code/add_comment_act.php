<?php
session_start();

include "connect.php";
include "./vars.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $text = $_POST['text'];

    if (empty($id_user) || empty($text)) {
        header("Location: faq.php?error=Všechna pole jsou povinná");
        exit();
    }

    $sql = "INSERT INTO GlobalComments (`id_user`, `text`) VALUES (?, ?)";
    $stmt = $connect->prepare($sql);

    if (!$stmt) {
        header("Location: faq.php?error=Chyba při přípravě dotazu");
        exit();
    }

    $stmt->bind_param("is", $id_user, $text);

    if ($stmt->execute()) {
        header("Location: faq.php");
    } else {
        header("Location: faq.php?error=Chyba při přidávání komentáře");
    }

    $stmt->close();
    $connect->close();
} else {
    header("Location: faq.php?error=Neplatný požadavek");
    exit();
}
?>