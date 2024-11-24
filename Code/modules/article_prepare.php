<?php

echo "<div class='art_header'>Status: <strong>" . [
    "Odmítnuto", # 0
    "Archivováno", # 1
    "Čeká na recenze", # 2
    "Vyžaduje úpravy", # 3
    "Schváleno", # 4
    "Čeká na vydání", # 5
][$article["status"]] . "</strong></div>";

include "./modules/article.php";

echo "<div class='reviews'>";

$reviews_sql = "SELECT * FROM `Review` JOIN User ON Review.id_user = User.id WHERE id_article = " . $article["id"];
$reviews_result = $connect->query($reviews_sql);
while ($review = $reviews_result->fetch_assoc()) {
    echo "<div class='review'><div>" . $review["name"] . " · " . $roles[$review["role"]] . "<br /><time datetime='" . $review["datetime"] . "'>" . (new DateTime($review["datetime"]))->format('H:i d.m.Y') . "</time></div><p>" . $review["text"] . "</p></div>";
}

echo "</div>";

?>