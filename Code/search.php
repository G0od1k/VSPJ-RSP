<?php include "./vars.php" ?>

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
    <main>
        <div class="allArticles">
            <?php
            $sql = "SELECT *
            FROM Article AS a
            JOIN Release AS r ON a.id_release = r.id
            WHERE (a.title LIKE '%" . $_GET['q'] . "%'
                OR a.description LIKE '%" . $_GET['q'] . "%' OR a.id = '" . $_GET['q'] . "') AND r.date <= CURRENT_DATE;";

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