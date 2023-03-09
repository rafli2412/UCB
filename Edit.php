<?php
include 'Server.php';
include ("./connection/data-info-query.php");
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['ID'])) {
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit <?php if (isset($_GET['ref'])) { ?>
                    <?php echo $_GET['ref']; ?>
                    <?php } ?>
        </title>
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link rel="icon" href="./img/icon.png">
        <link rel="stylesheet" type="text/css" href="./css/style-data-info.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="grid">
            <div>
                <img class="logo" src="./img/logo.png">
                <ul>
                    <li><a href="Home2.php">Overview</a></li>
                    <li><a href="Input2.php">Input</a></li>
                    <li><a class="input" href="Data.php">Data</a></li>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']=="Yes") { ?>
                        <li><a href="Report.php">Report</a></li>
                    <?php } ?> 
                    <li><a href="Logout.php">Keluar</a></li>
                </ul>
            </div>
            <div class="grid2">
                <div class="top">
                    <?php if (isset($_GET['ref'])) { ?>
                        <div><?php echo $_GET['ref']; ?></div>
                    <?php } ?>
                </div>
                <form class="body" action="" method="POST">
                        <?php if (isset($_GET['success'])) { ?>
                            <div class="success"><?php echo $_GET['success']; ?></div>
                        <?php } ?>
                    <div class="body-top">
                        <div>
                            Invoice Number <br>
                            <input class="box1 invo" type="text" name="number" value="<?php echo $number;?>" placeholder="<?php echo $number;?>" required><br>
                            Buyer Name <br>
                            <input class="box1" type="text" name="buyer" value="<?php echo $buyer;?>" placeholder="<?php echo $buyer;?>" required><br>
                            Postal Code <br>
                            <input class="box1" type="text" name="postal" value="<?php echo $postal;?>" placeholder="<?php echo $postal;?>" required><br>
                        </div>
                        <div>
                            Company <br>
                            <input list="metrics" name="company" class="list2 invo" value="<?php echo $company; ?>" placeholder="<?php echo $company; ?>" required>
                            <datalist id="metrics" >
                                <option value="UCB">
                                <option value="PSP">
                            </datalist><br>
                            Phone <br>
                            <input class="box1" type="text" name="phone" value="<?php echo $phone;?>" placeholder="<?php echo $phone;?>" required><br>
                            Date <br>
                            <input type="date" id="date" name="date" class="box1 invo" value="<?php echo $date;?>" placeholder="<?php echo $date;?>" required><br>
                        </div>
                    </div>
                    <div class="body-mid">
                        <div>
                            Address <br>
                            <textarea name="address" class="box2" cols="10" rows="5" placeholder="<?php echo $address;?>" required><?php echo $address; ?></textarea>
                            <input type="submit" class="submit2" value="Edit" name="submit" formaction="input2-conn.php" method="POST"><br><br>
                        </div>
                        <div>
                            Country <br>
                            <input class="box1" type="text" name="country" value="<?php echo $country;?>" placeholder="<?php echo $country;?>" required><br>
                            Country Code <br>
                            <input class="box1 invo" type="text" name="code" value="<?php echo $code;?>" placeholder="<?php echo $code;?>" required><br><br>
                            <a href="Input-good.php?ref=<?php echo $inv; ?>" class="btn1-blue">Edit Item</a><br>
                            <?php if(isset($_SESSION['admin']) && $_SESSION['admin']=="Yes") { ?>
                                <input type="submit" class="delete" value="DELETE DATA" name="delete" formaction="delete-conn.php" method="POST" onclick="return  confirm('Do you want to DELETE this Data? ')"><br><br>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="body-bot">
                    </div>
                    <div>
                    <?php
                        $link = "Data-info.php?ref=".$inv;
                    ?>
                    <a href="<?php echo $link; ?>" class="btn2-green">Return to Data Info</a><br>
                    </div>
                    <input class="hidd" type="text" name="invoice" value="<?php echo $_GET['ref']; ?>">
                </form>
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