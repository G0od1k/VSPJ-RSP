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
        echo "<article><div class='art_header'>Status: <strong>" . [
            "Odmítnuto",
            "Archivováno",
            "Čeká na schválení",
            "Vyžaduje úpravy",
            "Schváleno",
        ][$article["status"]] . "</strong></div>" .
            "<h3 href='#'>" . $article["title"] . "</h3>" .
            "<span>Authors: ";

        $authors_sql = "SELECT User.id AS user_id, User.name, User.email FROM WrittenBy JOIN User ON WrittenBy.id_user = User.id WHERE WrittenBy.id_article = " . $article["id"];
        $authors_result = $connect->query($authors_sql);
        while ($author = $authors_result->fetch_assoc()) {
            echo "<a href='#' class='author'>" . $author["name"] . "</a>";
        }

        echo "</span><p>" . $article["description"] . "</p><div class='reviews'>";

        $reviews_sql = "SELECT * FROM `Review` WHERE id_article = " . $article["id"];
        $reviews_result = $connect->query($reviews_sql);
        while ($review = $reviews_result->fetch_assoc()) {
            echo "<p>" . $review["text"] . "</p>";
        }

        echo "</div>";
        if ($article["status"] == 2) {
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
        WHERE Article.status = 4
        AND User.id = " . $user["id"];

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