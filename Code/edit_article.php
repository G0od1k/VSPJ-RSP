<?php
include "./vars.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upravit článek</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "./modules/header.php"; ?>

    <?php
    $sql = "SELECT * FROM Article WHERE id = " . $_GET["id"];
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();

    if (!$article) {
        echo "Article not found!";
        exit();
    }
    ?>

    <main class="article">
        <h1>Upravit článek</h1>
        <form action="edit_article_act.php" method="post" enctype="multipart/form-data">
            <input type="number" name="id" hidden value="<?php echo htmlspecialchars($article['id']); ?>" required>
            <label>
                <span>Název:</span>
                <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
            </label>
            <label>
                <span>Popis:</span>
                <textarea name="desc" required><?php echo htmlspecialchars($article['description']); ?></textarea>
            </label>
            <label>
                <span>Aktuální soubor:</span>
                <?php
                $filePath = "article/" . $_GET["id"] . ".pdf";
                if (file_exists($filePath)) {
                    echo "<a href='$filePath' target='_blank'>Download Current File</a>";
                } else {
                    echo "No file uploaded.";
                }
                ?>
            </label>
            <label>
                <span>Nahradit soubor:</span>
                <input type="file" name="file">
            </label>
            <?php
            if ($user['role'] == 5) {
                echo "<select name='status'>";
                for ($i = 0; $i < count($statuses); $i++) {
                    echo "<option value='" . $i . "'" . ($i == $article['status'] ? "selected" : "") . ">" . $statuses[$i] . "</option>";
                }
                echo "<input type='submit' />";
                echo "</select>";
            }
            ?>
            <input type="submit" value="Aktualizovat článek">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        </form>
    </main>

    <?php include "./modules/footer.php"; ?>
</body>

</html>