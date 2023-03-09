<?php

$sname = "localhost";
$uname = "root";
$password = "";
$db = "UCB";

$conn = mysqli_connect($sname, $uname, $password, $db);

if (!$conn) {
    echo "Connection Failed!";
}


