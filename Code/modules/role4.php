<h2>Schválení Články</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT * FROM Article WHERE status = 4";

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";

        include "./modules/article_prepare.php";

        echo "</article>";
    }
    ?>
</div>

<h2>Vdýchni Články</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT * FROM Article WHERE status < 4";

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";

        include "./modules/article_prepare.php";

        echo "</article>";
    }
    ?>
</div>