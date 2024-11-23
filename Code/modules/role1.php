<a href="add_article.php"><button>Nabídnout článek</button></a>

<h2>Nový články</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT Article.id, Article.title, Article.description, Article.date, Article.status
        FROM Article
        JOIN WrittenBy ON Article.id = WrittenBy.id_article
        JOIN User ON WrittenBy.id_user = User.id
        WHERE (Article.status = 2 OR Article.status = 3)
        AND User.id = " . $user["id"];

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