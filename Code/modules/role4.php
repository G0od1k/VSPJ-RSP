<h2>Schválení Články</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT * FROM Article WHERE status = 4";

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";

        include "./modules/article_prepare.php";

        echo "<hr>";

        $id = $article["id"];

        echo "<a href='archive_article_act.php?id=" . $id . "'><button>Archivovat</button></a>";
        echo "<a href='release_article_act.php?id=" . $id . "'><button>Přidat do vydáni</button></a>";

        include "./modules/add_review.php";

        echo "</article>";
    }
    ?>
</div>

<h2>Všechní Články</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT * FROM Article WHERE status < 4";

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";

        include "./modules/article_prepare.php";

        echo "<hr>";

        $id = $article["id"];

        echo "<a href='archive_article_act.php?id=" . $id . "'><button>Archivovat</button></a>";
        echo "<a href='approve_article_act.php?id=" . $id . "'><button>Schválit</button></a>";

        include "./modules/add_review.php";

        echo "</article>";
    }
    ?>
</div>

<h2>Čeká na vydání</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT a.*
    FROM Article a
    JOIN Release r ON a.id_release = r.id
    WHERE r.date > CURDATE() AND a.status = 5;";

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";

        include "./modules/article_prepare.php";

        echo "<hr>";

        $id = $article["id"];

        echo "<a href='review_article_act.php?id=" . $id . "'><button>Odeslat na recenze znovu</button></a>";
        echo "<a href='archive_article_act.php?id=" . $id . "'><button>Archivovat</button></a>";
        echo "<a href='approve_article_act.php?id=" . $id . "'><button>Schválit</button></a>";

        include "./modules/add_review.php";

        echo "</article>";
    }
    ?>
</div>