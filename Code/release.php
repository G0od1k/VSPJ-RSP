<?php include "./connect.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vydání</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include "./modules/header.php" ?>
    <main class="release">
        <?php
        $sql = "SELECT * FROM Release WHERE id = " . $_GET["id"];
        $release = $connect->query($sql)->fetch_assoc();
        ?>
        <div class="top">
            <img src="./img/<?php echo $release["id"] ?>.png" />
            <h1><?php echo $release["title"] ?></h1>
            <p>
                <?php echo $release["description"] ?>
            </p>
            <time
                datetime="<?php echo $release["date"] ?>"><?php echo (new DateTime($release["date"]))->format("d. m. Y") ?></time>
        </div>
        <h2>Články</h2>
        <div class="allArticles">
            <?php
            $sql = "SELECT * FROM `Article` WHERE id_release = " . $release["id"];
            $result = $connect->query($sql);

            while ($article = $result->fetch_assoc()) {
                echo "<article>" .
                    "<h3 href='#'>" . $article["title"] . "</h3>" .
                    "<span>Authors: ";

                $authors_sql = "SELECT User.id AS user_id, User.name, User.email FROM WrittenBy JOIN User ON WrittenBy.id_user = User.id WHERE WrittenBy.id_article = " . $article["id"];
                $authors_result = $connect->query($authors_sql);
                while ($author = $authors_result->fetch_assoc()) {
                    echo "<a href='#' class='author'>" . $author["name"] . "</a>";
                }

                echo "</span><p>" . $article["description"] . "</p><button>Čist</button>" .
                    "</article>";
            }
            ?>
        </div>
    </main>
    <?php include "./modules/footer.php" ?>
</body>

</html>