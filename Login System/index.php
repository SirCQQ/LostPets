<?php
require 'header.php';

?>

<main>
    <?php
    if (isset($_SESSION['userId'])) {
        
        ?>
        <p class='show-me'> You are logged in!</p> 

        <?php
    } else {
        ?>
        <div id="register" class="hidden">
            <?php
        if ($_GET['signup'] == 'success') {
            echo '<p class="success">Singup successful!</p>';
        } else if ($_GET['error'] == 'emptyfield') {
            echo '<p class="error">Not all fields are completed! </p>';
        
        } else if ($_GET['error'] == 'invalidall') {
            echo '<p class="error">All fields are invalid! </p>';

        } else if ($_GET['error'] == 'invalidnumeprenumenrtel') {

            echo '<p class="error">Last name , first name and phone number are invalid! </p>';
        
        } else if ($_GET['error'] == 'invalidnumeprenumeemail') {

            echo '<p class="error">Last name, first name and email are invalid! </p>';
        
        } else if ($_GET['error'] == 'invalidnumenrtelemail') {

            echo '<p class="error">Last name, phone number and email are invalid! </p>';
        
        } else if ($_GET['error'] == 'invalidprenumenrtelemail') {

            echo '<p class="error">First name, phone number and email are invalid! </p>';

        } else if ($_GET['error'] == 'invalidnumeprenume') {

            echo '<p class="error">First and last name are invalid! </p>';
        
        } else if ($_GET['error'] == 'invalidnumenrtel') {

            echo '<p class="error">Last name and phone number are invalid! </p>';

        } else if ($_GET['error'] == 'invalidnumeemail') {

            echo '<p class="error">Last name and email are invalid! </p>';

        } else if ($_GET['error'] == 'invalidprenumenrtel') {

            echo '<p class="error">First name and phone number are invalid! </p>';
        
        } else if ($_GET['error'] == 'invalidprenumeemail') {

            echo '<p class="error">First name and email are invalid! </p>';

        } else if ($_GET['error'] == 'invalidnrtelemail') {

            echo '<p class="error">Phone number and email are invalid! </p>';

        } else if ($_GET['error'] == 'invalidemail') {

            echo '<p class="error">Invalid email! </p>';

        } else if ($_GET['error'] == 'invalidname') {

            echo '<p class="error">Invalid last name! </p>';

        } else if ($_GET['error'] == 'prenumeinvalid') {

            echo '<p class="error">Invalid first name! </p>';

        } else if ($_GET['error'] == 'invalidnrtel') {

            echo '<p class="error">Invalid phone number! </p>';

        }else if ($_GET['error'] == 'passwordcheck') {

            echo '<p class="error">Passwords does not match! </p>';

        }
        else if ($_GET['error'] == 'sqlerror') {

            echo '<p class="error">Server error! </p>';
            
        }
        else if ($_GET['error'] == 'emailexists') {

            echo '<p class="error">Email already exists! </p>';
            
        }
        ?>
    <form   action="includes/signup.inc.php" method="POST">
        <input type="text" name="nume" placeholder="Nume" >
        <br>
        <input type="text" name="prenume" placeholder="Prenume" >
        <br>
        <input type="text" name="numarTelefon" placeholder="Numer de telefon" >
        <br>
        <input type="email" name="email" placeholder="Email" >
        <br>
        <input type="password" name="pass" placeholder="Password" >
        <br>
        <input type="password"  name="pass2" placeholder="Confirm Password" >
        <br>
        <a>Alege o poza pentru profil</a>
        <br>
        <input class="file" type="file" name="profilePhoto" accept="image/*"><br>
        <input class="file2" type="submit" name="signup-submit" value="Register">
    </form>
    </div> 
    <?php
    
    }
    ?>
</main>

<?php

require 'footer.php';
?>