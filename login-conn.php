<?php
session_start();
include "Server.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['username']);
    $uname = strtolower($uname);
    $pass = validate($_POST['password']);
    $pass = md5($pass);

    $sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['username'] === $uname && $row['password'] === $pass) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['ID'] = $row['ID'];
            $_SESSION['admin'] = $row['admin'];
            $_SESSION['company'] = $row['company'];
            header("Location: Home2.php");
            exit();
        } else {
            header("Location: Login.php?error=Username or Password are Incorrect.");
            exit();
        }
    } else {
        header("Location: Login.php?error=Username or Password are Incorrect.");
        exit();
    }

} else {
    header("Location: Login.php");
    exit();
}