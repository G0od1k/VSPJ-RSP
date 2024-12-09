<?php
session_start();
?>

<header>
    <a href="index.php" class="logo">
        <img src="./icons/52news.svg" />
    </a>
    <input id="search" type="search" placeholder="Hledám" />
    <div class="right">
        <a href="faq.php"><button>FAQ</button></a>

        <?php
        if (isset($_SESSION['email'])) {
            include "user.php";

            echo "<a href='account.php'><button>" . $user["name"] . "</button></a>";
        } else {
            echo "<a href='login.php'><button>Přihlásit se</button></a>";
        }
        ?>
    </div>
</header>