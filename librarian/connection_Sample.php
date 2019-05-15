<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "dbname";

$link = mysqli_connect($servername,$username,"$password");
mysqli_select_db($link,$dbname);

?>    