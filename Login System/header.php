<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/index.css">
    <script src="./js/index.js"></script>
    <title>Document</title>
</head>
<body>
  
    <header>
        <nav>

                <img class='logo' src='img/logo3.png' alt="logo">


        <?php
    if(isset($_SESSION['userId'])){
        ?>
    
    <form class="logout-form"action="includes/logout.inc.php" method="post">
        <button type="submit" name="logout-submit">Logout</button>
    </form>

    <?php
    
    }
    else{

        ?>
         <div class="login-form">
                <form action="includes/login.inc.php" method="POST">
                    <input type="email"     name="email" placeholder="Email...">
                    <input type="password"  name="pwd" placeholder="Password">
                   <div class="buttons">
                    <button type="submit" name="login-submit">Login</button>
                    
                </div>
                </form>
                <button onclick="fromRegister()">Sigup</button>
               <!-- <div class="second">
                
                <button onclick="fromRegister()">Sigup</button>
                </div> -->
      <?php          
    }
    ?>
            

    </div>
        </nav>
    </header>