<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['ID'])) {
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>UCB Express - Input Data</title>
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link rel="icon" href="./img/icon.png">
        <link rel="stylesheet" type="text/css" href="./css/style-input2.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="grid">
            <div>
                <img class="logo" src="./img/logo.png">
                <ul>
                    <li><a  href="Home2.php">Overview</a></li>
                    <li><a class="input" href="#">Input</a></li>
                    <li><a href="Data.php">Data</a></li>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']=="Yes") { ?>
                        <li><a href="Report.php">Report</a></li>
                    <?php } ?> 
                    <li><a href="Logout.php">Keluar</a></li>
                </ul>
            </div>
            <div class="grid2">
                <div class="top">
                    Input Data
                </div>
                <form class="mid-master" action="" method="POST">
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="success"><?php echo $_GET['success']; ?></div>
                    <?php } ?>
                    <?php if (isset($_GET['err'])) { ?>
                        <div class="err"><?php echo $_GET['err']; ?></div>
                    <?php } ?>
                    <div class="mid-top">
                        <div>
                            <label for="">Invoice NUMBER</label><br>
                            <input class="box1 invo" type="text" name="number" placeholder="ex: 001, 451, 020" required><br>
                            <label for="">Buyer Name</label><br>
                            <input class="box1" type="text" name="buyer" required><br>
                            <label for="">Postal Code</label><br>
                            <input class="box1" type="text" name="postal"><br>
                        </div>
                        <div>
                            <label for="">Company</label><br>
                            <input list="metrics" name="company" class="list2 invo" required>
                            <datalist id="metrics" >
                                <option value="UCB">
                                <option value="PSP">
                            </datalist><br>
                            <label for="">Phone</label><br>
                            <input class="box1" type="text" name="phone"><br>
                            <label for="">Date</label><br>
                            <input type="date" id="date" name="date" class="box1 invo" required><br>
                        </div>
                    </div>
                    <div class="mid-midd">
                        <div>
                            <label for="">Address</label><br>
                            <textarea name="address" class="box2" cols="10" rows="5"></textarea>
                            <input type="submit" class="submit2" value="Add Data" name="submit" formaction="input2-conn.php" method="POST"><br><br>
                        </div>
                        <div>
                            <label for="">Country</label><br>
                            <input class="box1" type="text" name="country"><br>
                            <label for="">Country Code</label><br>
                            <input class="box1 invo" type="text" name="code" placeholder="ex: USA, IND" required><br>
                        </div>
                    </div>
                        <?php if (isset($_GET['success'])) { ?>
                        <div class="hidd"><?php echo $_GET['success']; ?></div>
                        <?php } ?>
                        <?php if (isset($_GET['err'])) { ?>
                            <div class="hidd"><?php echo $_GET['err']; ?></div>
                        <?php } ?>
                         <br>
                    </div>
                </form>
                </div>
                <div class="bot">
                
                </div>
            </div>
        </div>
    </body>
</html>

<?php
} else {
    header("Location: Login.php");
    exit();
}
?>