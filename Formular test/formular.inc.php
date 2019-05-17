<?php
if(isset($_POST['formular-submit'])){

    require 'dbForm.inc.php';

    $nume = $_POST['name'];
    $tip = $_POST['animal'];
    $detalii = $_POST['detalii'];
    $zona = $_POST['zona'];
    $recompensa = $_POST['recompensa'];
    $image = $_POST['img'];
        echo $nume."  ";
        echo $tip."  ";
        echo $detalii."  ";
        echo $zona."  ";
        echo $image."  ";

     if(empty($nume) || empty($tip)|| empty($zona)){
           header("Location: formular.html?error=emptyfields&name=".$nume."&animal=".$tip."&zona=".$zona);
           exit();
    }
    else if(!preg_match("/[a-zA-Z]+$/",$nume) && !preg_match("/[a-zA-Z]+$/",$tip)){
        header("Location: formular.html?error=invalidnameanimal&zona=".$zona);
        exit();
    }
    else if(!preg_match("/[a-zA-Z]+$/",$nume) && !preg_match("/[a-zA-Z]+$/",$zona)){
        header("Location: formular.html?error=invalidnamezona&animal=".$tip);
        exit();
    }
    else if(!preg_match("/[a-zA-Z]+$/",$tip) && !preg_match("/[a-zA-Z]+$/",$zona)){
        header("Location: formular.html?error=invalidanimalzona&name=".$nume);
        exit();
    }
    else if(!preg_match("/[a-zA-Z]+$/",$nume)){
        header("Location: formular.html?error=invalidname&animal=".$tip."&zona=".$zona);
        exit();
    }
    else if(!preg_match("/[a-zA-Z]+$/",$tip)){
        header("Location: formular.html?error=invalidanimal&name=".$nume."&zona=".$zona);
        exit();
    }
    else if(!preg_match("/[a-zA-Z]+$/",$zona)){
        header("Location: formular.html?error=invalidzonas&name=".$nume."&animal=".$tip);
        exit();
    }
    else if(!preg_match("/[0-9]+$/",$recompensa)){
        header("Location: formular.html?error=invalidzonas&name=".$nume."&animal=".$tip);
        exit();
    }
    else{
         $sql= "INSERT INTO pets (Pet_name, Pet_type, zona_lost, Recompensa) VALUES (?,?,?,?);";
         $stmt = mysqli_stmt_init($conn);
         if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "sssi", $nume, $tip, $zona, $recompensa);
            mysqli_stmt_execute($stmt);
            header("Location: ../?add=success");
            exit();
     }
    }

     mysqli_close($conn);

}