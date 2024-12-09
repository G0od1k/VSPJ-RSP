<h2>Hledat Uživatele</h2>

<form method="get">
    <input type="text" name="q" placeholder="Hledat">
    <input type="submit">
</form>

<div class="allArticles">
    <?php
    $sql = "SELECT *
    FROM User
    WHERE name LIKE '%" . $_GET['q'] . "%'
        OR email LIKE '%" . $_GET['q'] . "%'
        OR id = '" . $_GET['q'] . "' LIMIT 20;";

    $result = $connect->query($sql);

    while ($user = $result->fetch_assoc()) {
        echo "<div class='user'>";

        echo "<h3>" . $user["name"] . "</h3>";
        echo "<a href='mailto:" . $user["email"] . "' >" . $user["email"] . "</a><br />";
        echo "<span>Role: " . $roles[$user["role"]] . "</span><br /><br />";
        echo "<a href='edit_user.php?id=" . $user["id"] . "'><button>Upravit</button></a>";

        echo "</div>";
    }
    ?>
</div>

<h2>Všechní Články</h2>

<form method="get">
    <input type="text" name="q" placeholder="Hledat">
    <input type="submit">
</form>

<div class="allArticles">
    <?php
    $sql = "SELECT *
    FROM Article
    WHERE title LIKE '%" . $_GET['q'] . "%'
        OR description LIKE '%" . $_GET['q'] . "%' OR id = '" . $_GET['q'] . "' LIMIT 8;";

    $result = $connect->query($sql);

    while ($article = $result->fetch_assoc()) {
        echo "<article>";

        include "./modules/article.php";

        echo "<hr>";

        $id = $article["id"];

        echo "<a href='edit_article.php?id=" . $id . "'><button>Upravit</button></a>";

        echo "</article>";
    }
    ?>
</div>