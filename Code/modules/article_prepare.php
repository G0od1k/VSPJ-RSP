<?php

include "vars.php";

echo "<div class='art_header'>Status: <strong>" . $statuses[$article["status"]] . "</strong></div>";

include "./modules/article.php";

echo "<div class='reviews'>";

$reviews_sql = "SELECT * FROM `Review` JOIN User ON Review.id_user = User.id WHERE id_article = " . $article["id"];
$reviews_result = $connect->query($reviews_sql);
while ($review = $reviews_result->fetch_assoc()) {
    echo "<div class='review'><div>" . $review["name"] . " · " . $roles[$review["role"]] . "<br /><time datetime='" . $review["datetime"] . "'>" . (new DateTime($review["datetime"]))->format('H:i d.m.Y') . "</time></div><p>" . $review["text"] . "</p></div>";
}

echo "</div>";

?>