<?php
session_start();

include "connect.php";
include "user.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['email'])) {

    if (isset($_POST['release']) && $_POST['release'] !== '---') {

        $title = $connect->real_escape_string($_POST['title']);
        $desc = $connect->real_escape_string($_POST['desc']);
        $release = (int) $_POST['release'];

        $date = date("Y-m-d");
        $status = 1;
        $sql = "INSERT INTO Article (title, description, date, status, id_release) 
                VALUES ('$title', '$desc', '$date', $status, $release)";

        if ($connect->query($sql) === TRUE) {

            $articleId = $connect->insert_id;

            $sql = "INSERT INTO WrittenBy (id_user, id_article) 
                VALUES (" . $user["id"] . " , $articleId)";
            $connect->query($sql);

            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

                $fileName = "$articleId.pdf";
                $uploadDir = "article/";
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $filePath)) {
                    header("Location: account.php");
                } else {
                    header("Location: add_article.php?error=Chyba při nahrávání souboru.");
                    exit;
                }
            } else {
                header("Location: add_article.php?error=Žádný soubor nebyl nahrán nebo došlo k chybě při nahrávání.");
                exit;
            }

            header("Location: add_article.php?error=Článek byl úspěšně odeslán s ID $articleId.");
        } else {
            header("Location: add_article.php?error=Chyba: " . $sql . "\n" . $connect->error);
        }
    } else {
        header("Location: add_article.php?error=Vyberte prosím vydání.");
    }
}
?>