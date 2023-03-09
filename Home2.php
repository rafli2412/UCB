<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['ID'])) {

 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>UCB Express</title>
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link rel="icon" href="./img/icon.png">
        <link rel="stylesheet" type="text/css" href="./css/style2.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="grid">
            <div>
                <img class="logo" src="./img/logo.png">
                <ul>
                    <li><a class="overview" href="#overviw">Overview</a></li>
                    <li><a href="Input2.php">Input</a></li>
                    <li><a href="Data.php">Data</a></li>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']=="Yes") { ?>
                        <li><a href="Report.php">Report</a></li>
                    <?php } ?> 
                    <li><a href="Logout.php">Keluar</a></li>
                </ul>
            </div>
            <div class="grid2">
                <div class="top">
                    Welcome, <?php echo $_SESSION['name']; ?>
                </div>
                <div class="mid">
                    <div>
                        <?php if (isset($_GET['success1'])) { ?>
                            <center><div class="success"><?php echo $_GET['success1']; ?></div></center>
                        <?php } ?>
                        <form action="" method="POST">
                            <center>
                            Name <br>
                            <div class="box-val">
                                <?php echo $_SESSION['name']; ?>
                            </div> <br>
                            </center>
                            <center>Change Name</center>
                            <center><input class="box1" type="text" name="name" value="" placeholder="<?php echo $_SESSION['name']; ?>" required><br><br><br></center>
                            <center><input type="submit" class="submit2" value="C H A N G E  N A M E" name="name-change" formaction="profile-conn.php" method="POST"></center><br>
                        </form>
                    </div>
                    <div>
                        <form action="" method="POST">
                            <?php if (isset($_GET['error2'])) { ?>
                                <center><div class="err"><?php echo $_GET['error2']; ?></div></center>
                            <?php } ?>
                            <?php if (isset($_GET['success2'])) { ?>
                                <center><div class="success"><?php echo $_GET['success2']; ?></div></center>
                            <?php } ?>
                            <center>Change Password</center>
                            <div class="label1">
                                <input type="checkbox" onclick="show()">
                                Show Password
                            </div>
                            Old Password <br>
                            <input id="box1-pw1" class="box1-pw" type="password" name="old-password" value="" required><br>
                            New Password <br>
                            <input id="box1-pw2" class="box1-pw" type="password" name="new-password" value=""><br>
                            Confirm New Password <br>
                            <input id="box1-pw3" class="box1-pw" type="password" name="c-new-password" value=""><br><br>
                            <center><input type="submit" class="submit2" value="C H A N G E  P A S S W O R D" name="pw-change" formaction="profile-conn.php" method="POST"></center><br>
                        </form>
                    </div>
                </div>
                <div class="bot">
                </div>
            </div>
        </div>
        <script>
            function show() {
                var x = document.getElementById("box1-pw1");
                var y = document.getElementById("box1-pw2");
                var z = document.getElementById("box1-pw3");
                if (x.type == "password") {
                    x.type = "text";
                    y.type = "text";
                    z.type = "text";
                } else {
                    x.type = "password";
                    y.type = "password";
                    z.type = "password";
                }
            }
        </script>
    </body>
</html>

<?php
} else {
    header("Location: Login.php");
    exit();
}
?>