<?php

if (isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';

    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $numarTelefon = $_POST['numarTelefon'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];

    if (empty($nume) || empty($prenume) || empty($numarTelefon) || empty($email) || empty($pass) || empty($pass2)) {
        header("Location: ../index.php?error=emptyfield&nume=" . $nume . "&prenume=" . $prenume . "&numertelefon" . $numarTelefon .
            "&email=" . $email);
        exit();
    }

    //gresite toate 
    else if (
        !preg_match("/^[a-zA-Z]*$/", $nume) && !preg_match("/^[a-zA-Z]*$/", $prenume)
        && !preg_match("/^[0-9]*$/", $numarTelefon) && !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) { //toate 4 
        header("Location: ../index.php?error=invalidall");
        exit();
    }

    //gresite 3

    else if (
        !preg_match("/^[a-zA-Z]*$/", $nume) && !preg_match("/^[a-zA-Z]*$/", $prenume)
        && !preg_match("/^[0-9]*$/", $numarTelefon)
    ) { //nume prenume nrTel
        header("Location: ../index.php?error=invalidnumeprenumenrtel&email=" . $email);
        exit();
    } else if (
        !preg_match("/^[a-zA-Z]*$/", $nume) && !preg_match("/^[a-zA-Z]*$/", $prenume)
        && !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) { //nume,prenume email
        header("Location: ../index.php?error=invalidnumeprenumeemail&numertelefon" . $numarTelefon);
        exit();
    } else if (
        !preg_match("/^[a-zA-Z]*$/", $nume) && !preg_match("/^[0-9]*$/", $numarTelefon)
        && !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) { //nume nrTel email
        header("Location: ../index.php?error=invalidnumenrtelemail&prenume=" . $prenume);
        exit();
    } else if (
        !preg_match("/^[a-zA-Z]*$/", $prenume) && !preg_match("/^[0-9]*$/", $numarTelefon)
        && !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) { //prenume ,nrTel email
        header("Location: ../index.php?error=invalidprenumenrtelemail&nume=" . $nume);
        exit();
    }


    //gresie 2 
    else if (!preg_match("/^[a-zA-Z]*$/", $nume) && !preg_match("/^[a-zA-Z]*$/", $prenume)) { //nume,prenume
        header("Location: ../index.php?error=invalidnumeprenume&numertelefon" . $numarTelefon . "&email=" . $email);
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $nume) && !preg_match("/^[0-9]*$/", $numarTelefon)) { //nume,nrTel
        header("Location: ../index.php?error=invalidnumenrtel&prenume=" . $prenume . "&email=" . $email);
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $nume) && !filter_var($email, FILTER_VALIDATE_EMAIL)) { //nume email
        header("Location: ../index.php?error=invalidnumeemail&prenume=" . $prenume . "&numertelefon" . $numarTelefon);
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $prenume) && !preg_match("/^[0-9]*$/", $numarTelefon)) { //prenume nrTel
        header("Location: ../index.php?error=invalidprenumenrtel&&nume=" . $nume . "&email=" . $email);
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $prenume) && !filter_var($email, FILTER_VALIDATE_EMAIL)) { //prenume email
        header("Location: ../index.php?error=invalidprenumeemail&nume=" . $nume . "&numertelefon" . $numarTelefon);
        exit();
    } else if (!preg_match("/^[0-9]*$/", $numarTelefon) && !filter_var($email, FILTER_VALIDATE_EMAIL)) { //nrTel email
        header("Location: ../index.php?error=invalidnrtelemail&nume=" . $nume . "&prenume=" . $prenume);
        exit();
    }


    //gresite 1 

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=invalidemail&nume=" . $nume . "&prenume=" . $prenume . "&numertelefon" . $numarTelefon);
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $nume)) {
        header("Location: ../index.php?error=invalidname&prenume=" . $prenume . "&numertelefon" . $numarTelefon .
            "&email=" . $email);
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $prenume)) {
        header("Location: ../index.php?error=prenumeinvalid&nume=" . $nume . "&numertelefon" . $numarTelefon .
            "&email=" . $email);
        exit();
    } else if (!preg_match("/^[0-9]*$/", $numarTelefon)) {
        header("Location: ../index.php?error=invalidnrtel&nume=" . $nume . "&email=" . $email);
        exit();
    } else if ($pass != $pass2) {
        header("Location: ../index.php?error=passwordcheck&nume=" . $nume . "&prenume=" . $prenume . "&numertelefon" . $numarTelefon .
            "&email=" . $email);
        exit();
    }else {
        $sql = "SELECT email FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../index.php?error=emailexists&nume=" . $nume . "&prenume=" . $prenume . "&numertelefon" . $numarTelefon);
                exit();
            } else {
                $sql = "INSERT INTO users (name,prenume,email,nrtelefon,user_password ) VALUES (?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../?error=sqlerror");
                    exit();
                } else {
                    $hasedPwd = password_hash($pass, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $nume, $prenume, $email, $numarTelefon, $hasedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit();
}