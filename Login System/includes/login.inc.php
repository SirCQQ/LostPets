<?php

if (isset($_POST['login-submit'])) {

    require 'dbh.inc.php';
    $mail = $_POST['email'];
    $pwd = $_POST['pwd'];
    if (empty($mail)) {
            header("Location: ../?error=emplyEmail");
            exit();
        } else if (empty($pwd)) {
            header("Location: ../?error=emplypass");
            exit();
        } else {
        $sql = "SELECT * FROM users WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../?error=sqlerrorconnecting");
            exit();
        } else {
                mysqli_stmt_bind_param($stmt, 's', $mail);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                        echo $pwd;
                        $pwdCheck = password_verify($pwd, $row['user_password']);
                        if ($pwdCheck == false) {
                            header("Location: ../?error=wrongpwd");
                            exit();
                        } else if ($pwdCheck == true) {
                            session_start();
                            $_SESSION['userId'] = $row['user_id'];
                            $_SESSION['userEmail'] = $row['email'];

                            header("Location: ../?login=success");
                            exit();
                        } else {
                            header("Location: ../?error=SOMETHINKELSE");
                            exit();
                        }
                    } else {
                    header("Location: ../?error=nouser");
                    exit();
                }
            }
    }
} else {
    header("Location: ../");
    exit();
}
