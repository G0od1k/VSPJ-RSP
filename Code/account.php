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
        <h1><?php echo $user["name"] ?></h1>
        <p>Role:
            <?php echo ["Čtenář", "Autor", "Redaktor", "Admin"][$user["role"]] ?>
        </p>
        <?php include "./modules/role" . $user["role"] . ".php" ?>
        <a href="logout.php"><button>Odhlásit</button></a>
    </main>
    <?php include "./modules/footer.php" ?>
</body>

</html>