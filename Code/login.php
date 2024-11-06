<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="login_act.php" method="post" class="center">
        <h1>Přihlásit</h1>

        <label>
            <span>e-mail</span>
            <input type="text" name="email">
        </label>
        <label>
            <span>Heslo</span>
            <input type="password" name="password">
        </label>
        <input type="submit" value="Sign in">

        <?php if (isset($_GET['error'])) { ?>
            <p class="error">
                <?php echo $_GET['error']; ?>
            </p>
        <?php } ?>

    </form>
</body>

</html>