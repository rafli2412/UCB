<?php
session_start();

if (!isset($_SESSION['username']) && isset($_SESSION['ID'])) {
    header("location: Data2.php");
    exit;
}
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Unifarsa Cipta Bersama</title>
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link rel="icon" href="./img/icon.png">
        <link rel="stylesheet" type="text/css" href="./css/style.css" media="all">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet" media="all">
        <script src="./js/icon.js"></script>
    </head>
    <body>
        <img class="bg" src="./img/background.png">
        <div class="container">
            <div class="img">
                <img src="./img/BG.png">
            </div>
            <div class="login-container">
                <form method="POST" action="login-conn.php">
                    <img class="logo" src="./img/logo.png">
                    <h2>Welcome to UCB Express</h2>
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="err"><?php echo $_GET['error']; ?></div>
                    <?php } ?> <br>
                    <div class="input-div satu">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h5>Nama Pengguna</h5>
                            <input class="input" type="text" name="username" required>
                        </div>
                    </div>
                    <div class="input-div dua">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div>
                            <h5>Kata Sandi</h5>
                            <input class="input" type="password" name="password" required>
                        </div>
                    </div>
                    <br>
                    <input type="submit" class="btn" value="Log In" name="login">
                </form>
            </div>
        </div>
        <script type="text/javascript" src="./js/main.js"></script>
    </body>
</html>
