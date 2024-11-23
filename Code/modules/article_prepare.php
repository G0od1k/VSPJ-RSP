<?php

echo "<div class='art_header'>Status: <strong>" . [
    "Odmítnuto",
    "Archivováno",
    "Čeká na schválení",
    "Vyžaduje úpravy",
    "Schváleno",
    "Čeká na vydání",
][$article["status"]] . "</strong></div>";

include "./modules/article.php";

echo "<div class='reviews'>";

$reviews_sql = "SELECT * FROM `RSP_Review` JOIN RSP_User ON RSP_Review.id_user = RSP_User.id WHERE id_article = " . $article["id"];
$reviews_result = $connect->query($reviews_sql);
while ($review = $reviews_result->fetch_assoc()) {
    echo "<div class='review'><div>" . $review["name"] . " · " . $roles[$review["role"]] . "<br /><time datetime='" . $review["datetime"] . "'>" . (new DateTime($review["datetime"]))->format('H:i d.m.Y') . "</time></div><p>" . $review["text"] . "</p></div>";
}

echo "</div>";

?>