<?php include "./vars.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upravit článek</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "./modules/header.php"; ?>

    <?php
    $sql = "SELECT * FROM User WHERE id = " . $_GET["id"];
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found!";
        exit();
    }
    ?>

    <main class="article">
        <h1>Upravit článek</h1>
        <form action="edit_user_act.php" method="post" enctype="multipart/form-data">
            <input type="number" name="id" hidden value="<?php echo htmlspecialchars($user['id']); ?>" required>
            <label>
                <span>Jméno:</span>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </label>
            <label>
                <span>Email:</span>
                <textarea name="email" required><?php echo htmlspecialchars($user['email']); ?></textarea>
            </label>
            <label>
                <span>Role:</span>
                <select name="role">
                    <?php
                    for ($i = 0; $i < count($roles); $i++) {
                        echo "<option value='" . $i . "'" . ($i == $user['role'] ? "selected" : "") . ">" . $roles[$i] . "</option>";
                    }
                    ?>
                </select>

            </label>
            <input type="submit" value="Aktualizovat uživatele">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        </form>
    </main>

    <?php include "./modules/footer.php"; ?>
</body>

</html>