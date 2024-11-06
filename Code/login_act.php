<?php

session_start();

include "connect.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

    }

    $email = validate($_POST['email']);

    $pass = validate($_POST['password']);

    if (empty($email)) {

        header("Location: login.php?error=Uživatelské jméno je povinné");

        exit();

    } else if (empty($pass)) {

        header("Location: login.php?error=Heslo je povinné");

        exit();

    } else {

        $sql = "SELECT * FROM User WHERE email='$email' AND password='$pass'";

        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) === 1) {

            $article = mysqli_fetch_assoc($result);

            echo "Logged in!";

            $_SESSION['email'] = $article['email'];


            header("Location: index.php");

            exit();

        } else {


            header("Location: login.php?error=Nesprávné uživatelské jméno nebo heslo");

            exit();

        }

    }

} else {

    header("Location: login.php");

    exit();

} ?>