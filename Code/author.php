<?php include "./connect.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Účet</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "./modules/header.php" ?>
    <?php
    $sql = "SELECT * FROM User WHERE id = " . $_GET["id"];
    $user = $connect->query($sql)->fetch_assoc();
    ?>
    <main>
        <h1><?php echo $user["name"] ?></h1>
        <h2>Vydání články</h2>

        <div class="allArticles">
            <?php
            $sql = "SELECT Article.id, Article.title, Article.description, Article.date, Article.status
            FROM Article
            JOIN WrittenBy ON Article.id = WrittenBy.id_article
            JOIN User ON WrittenBy.id_user = User.id
            AND User.id = " . $user["id"];
            WHERE Article.status = 5

            $result = $connect->query($sql);

            while ($article = $result->fetch_assoc()) {
                echo "<article>";
                include "./modules/article.php";
                echo "</article>";
            }
            ?>
        </div>
    </main>
    <?php include "./modules/footer.php" ?>
</body>

</html>