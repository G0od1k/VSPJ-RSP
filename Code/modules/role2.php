<h2>Články</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT
        a.id,
        a.title,
        a.description,
        a.date,
        a.status
    FROM
        Article a
    JOIN
        ReviewBy rb ON a.id = rb.id_article
    WHERE
        rb.id_user = " . $user['id'];

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";

        include "./modules/article_prepare.php";

        echo "<hr>";

        include "./modules/add_review.php";

        echo "</article>";
    }
    ?>
</div>