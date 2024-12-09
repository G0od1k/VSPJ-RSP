<?php
session_start();

include "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['email'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];


    if (empty($name) || empty($email) || !is_numeric($role) || $role < 0 || $role > 5) {
        header("Location: edit_user.php?id=$id&error=Neplatný vstup");
        exit();
    }


    $sql = "UPDATE User SET name = ?, email = ?, role = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);

    if (!$stmt) {
        header("Location: edit_user.php?id=$id&error=Chyba při přípravě dotazu");
        exit();
    }


    $stmt->bind_param("ssii", $name, $email, $role, $id);


    if ($stmt->execute()) {

        header("Location: account.php");
    } else {

        header("Location: edit_user.php?id=$id&error=Chyba při aktualizaci uživatele");
    }


    $stmt->close();
} else {

    header("Location: edit_user.php?error=Neplatný požadavek");
    exit();
}

$connect->close();
?>