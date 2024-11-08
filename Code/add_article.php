<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include "./modules/header.php" ?>
    <?php
    if ($user["role"] != 1) {
        header("Location: account.php");
        exit();
    }
    ?>
    <main class="article">
        <form action="#">
            <input type="file" name="file" />
            <label>
                <span>Název</span><input type="text" name="title" /></label>
            <!-- <label>
                <span>Spoluautoři</span><input type="text" />
            </label> -->
            <label>
                <span>Popis</span><textarea name="desc"></textarea>
            </label>
            <label>
                <span>Vyberte </span>
                <select name="release">
                    <option>---</option>
                    <?php
                    $sql = "SELECT * FROM RSP_Release WHERE date > NOW()";
                    $result = $connect->query($sql);

                    if ($result->num_rows > 0) {
                        while ($release = $result->fetch_assoc()) {
                            echo "<option value='" . $release["id"] . "'>" . $release["title"] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </select>
            </label>
            <input type="submit" value="Odeslat" />
        </form>
    </main>
    <?php include "./modules/footer.php" ?>
</body>

</html>