<?php
session_start();

include "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['email'])) {
    $articleId = (int) $_POST['id'];


    $title = $connect->real_escape_string($_POST['title']);
    $desc = $connect->real_escape_string($_POST['desc']);
    $status = ($_POST['status'] ? $_POST['status'] : 2);

    $sql = "UPDATE Article SET `title` = '$title', `description` = '$desc', `status` = $status WHERE id = $articleId";

    if ($connect->query($sql) === TRUE) {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            $fileName = "$articleId.pdf";
            $uploadDir = "article/";
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $filePath)) {
                header("Location: account.php");
                exit;
            } else {
                header("Location: edit_article.php?id=$articleId&error=Chyba při nahrávání souboru.");
                exit;
            }
        }

        header("Location: account.php");
        exit;
    } else {
        header("Location: edit_article.php?id=$articleId&error=Chyba při aktualizaci článku.");
    }
}
?>