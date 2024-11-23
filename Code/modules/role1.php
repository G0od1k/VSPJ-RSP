<a href="add_article.php"><button>Nabídnout článek</button></a>

<h2>Nový články</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT
            a.id,
            a.title,
            a.description,
            a.date,
            a.status,
            r.id AS release_id,
            r.title AS release_title,
            r.date AS release_date
        FROM
            Article a
        JOIN
            Release r ON a.id_release = r.id
        JOIN
            WrittenBy wb ON a.id = wb.id_article
        WHERE
            wb.id_user = " . $user["id"] . "
            AND r.date > NOW();
    ";

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";

        include "./modules/article_prepare.php";

        if ($article["status"] == 3) {
            echo "<a href='edit_article.php?id=" . $article["id"] . "'><button>Upravit</button></a>";
        }
        echo "</article>";
    }
    ?>
</div>

<h2>Vydání články</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT Article.id, Article.title, Article.description, Article.date, Article.status
        FROM Article
        JOIN WrittenBy ON Article.id = WrittenBy.id_article
        JOIN User ON WrittenBy.id_user = User.id
        WHERE Article.status = 5
        AND User.id = " . $user["id"];

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";
        include "./modules/article.php";
        echo "</article>";
    }
    ?>
</div>