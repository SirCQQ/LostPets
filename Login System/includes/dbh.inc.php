<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$bDName = "lostpets";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $bDName);

if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
}
