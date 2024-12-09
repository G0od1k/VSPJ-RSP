<?php
session_start();

include "connect.php";
include "user.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user["role"] != 4) {
        header("Location: account.php");
        exit();
    }

    $title = $_POST['title'];
    $description = $_POST['description'] ?? '';
    $date = $_POST['date'];

    if (empty($title) || empty($date)) {
        header("Location: create_release.php?error=Všechna povinná pole musí být vyplněna");
        exit();
    }

    $sql = "INSERT INTO Release (title, description, date) VALUES (?, ?, ?)";
    $stmt = $connect->prepare($sql);

    if (!$stmt) {
        header("Location: create_release.php?error=Chyba při přípravě dotazu");
        exit();
    }

    $stmt->bind_param("sss", $title, $description, $date);

    if ($stmt->execute()) {
        header("Location: account.php");
    } else {
        header("Location: create_release.php?error=Chyba při vytváření vydání");
    }

    $stmt->close();
    $connect->close();
} else {
    header("Location: create_release.php?error=Neplatný požadavek");
    exit();
}
?>