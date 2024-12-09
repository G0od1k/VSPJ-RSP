<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include "./modules/header.php" ?>
    <?php
    if ($user["role"] != 4) {
        header("Location: account.php");
        exit();
    }
    ?>
    <main>
        <h1>Vytvořit nové vydání</h1>

        <form action="create_release_act.php" method="post">
            <label>
                <span>Název:</span>
                <input type="text" name="title" placeholder="Zadejte název vydání" required>
            </label>
            <label>
                <span>Popis:</span>
                <textarea name="description" placeholder="Zadejte popis vydání"></textarea>
            </label>
            <label>
                <span>Datum:</span>
                <input type="date" name="date" required>
            </label>
            <input type="submit" value="Vytvořit vydání">
        </form>
    </main>
    <?php include "./modules/footer.php" ?>
</body>

</html>