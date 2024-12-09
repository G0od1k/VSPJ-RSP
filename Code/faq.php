<?php include "./vars.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Účet</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "./modules/header.php" ?>
    <main>
        <form action="add_comment_act.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?php echo $_GET['error']; ?>
                </p>
            <?php } ?>
            <input type="number" name="id_user" value="<?php echo $user["id"] ?>" hidden>
            <textarea name="text" required></textarea>
            <input type="submit" value="Přidat komentář">
        </form>
        <hr>
        <?php
        $comments_sql = "SELECT * FROM `GlobalComments` JOIN User ON GlobalComments.id_user = User.id ORDER BY GlobalComments.id DESC";
        $comments_result = $connect->query($comments_sql);
        while ($comment = $comments_result->fetch_assoc()) {
            echo "<div class='review'><div>" . $comment["name"] . " · " . $roles[$comment["role"]] . "<br /><time datetime='" . $comment["datetime"] . "'>" . (new DateTime($comment["datetime"]))->format('H:i d.m.Y') . "</time></div><p>" . $comment["text"] . "</p></div>";
        }
        ?>
    </main>
    <?php include "./modules/footer.php" ?>
</body>

</html>