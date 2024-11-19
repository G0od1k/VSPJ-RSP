<?php
echo
    "<h3>" . $article["title"] . "</h3>" .
    "<span>Authors: ";

$authors_sql = "SELECT User.id AS user_id, User.name, User.email FROM WrittenBy JOIN User ON WrittenBy.id_user = User.id WHERE WrittenBy.id_article = " . $article["id"];
$authors_result = $connect->query($authors_sql);
while ($author = $authors_result->fetch_assoc()) {
    echo "<a href='#' class='author'>" . $author["name"] . "</a>";
}

echo "</span><p>" . $article["description"] . "</p><a href='article/" . $article["id"] . ".pdf'><button>Čist</button></a>";
?>