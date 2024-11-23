<h2>Články</h2>

<div class="allArticles">
    <?php
    $sql = "SELECT a.*
    FROM Article a
    LEFT JOIN ReviewBy rb ON a.id = rb.id_article
    WHERE a.status = 2
    AND rb.id_article IS NULL;";

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";
        include "./modules/article.php";
        echo "<hr><form method='POST' action='set_reviewer_act.php'><input type='hidden' name='aid' value='" . $article["id"] . "'><select name='uid'>";

        $sql = "SELECT u.id, u.name, COUNT(rb.id_article) AS article_count
            FROM User u
            LEFT JOIN ReviewBy rb ON u.id = rb.id_user
            WHERE u.role = 2
            GROUP BY u.id, u.name, u.email;";

        $result = $connect->query($sql);

        while ($rec = $result->fetch_assoc()) {
            echo "<option value='" . $rec["id"] . "' >" . $rec["name"] . " — " . $rec["article_count"] . "</option>";
        }

        echo "</select><input type='submit' /></form>";
        echo "</article>";
    }
    ?>
</div>