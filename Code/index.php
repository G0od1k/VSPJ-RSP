<?php include "./connect.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>52 news</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include "./modules/header.php" ?>
    <main>
        <div class="newest">
            <?php
            $sql = "SELECT * FROM Release ORDER BY date DESC LIMIT 1";
            $newest = $connect->query($sql)->fetch_assoc();
            ?>
            <img src="./img/<?php echo $newest["id"] ?>.png" />
            <h1>
                <a href="release.php?id=<?php echo $newest["id"] ?>"><?php echo $newest["title"] ?></a>
            </h1>
            <p>
                <?php echo $newest["description"] ?>
            </p>
            <h2>Články</h2>
            <ul>
                <?php
                $sql = "SELECT * FROM `Article` WHERE id_release = " . $newest["id"];
                $result = $connect->query($sql);

                while ($article = $result->fetch_assoc()) {
                    echo "<li>" .
                        "<a href='#'>" . $article["title"] . "</a> · ";

                    $authors_sql = "SELECT User.id AS user_id, User.name, User.email FROM WrittenBy JOIN User ON WrittenBy.id_user = User.id WHERE WrittenBy.id_article = " . $article["id"];
                    $authors_result = $connect->query($authors_sql);
                    while ($author = $authors_result->fetch_assoc()) {
                        echo "<a href='#' class='author'>" . $author["name"] . "</a>";
                    }
                    echo "</li>";
                }

                ?>
            </ul>
        </div>
        <div class="allArticles">
            <?php
            $sql = "SELECT * FROM Release ORDER BY date DESC";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $result->fetch_assoc();
                while ($release = $result->fetch_assoc()) {
                    echo "<article>" .
                        "<img src='./img/" . $release["id"] . ".png' />" .
                        "<h2><a href='release.php?id=" . $release["id"] . "'>" . $release["title"] . "</a></h2>" .
                        "</article>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </main>
    <?php include "./modules/footer.php" ?>
</body>

</html>