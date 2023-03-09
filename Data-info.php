<?php
include 'Server.php';
include ("./connection/data-info-query.php");
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['ID'])) {
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>No. <?php if (isset($_GET['ref'])) { ?>
                    <?php echo $_GET['ref']; ?>
                    <?php } ?>
        </title>
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="./css/style-data-info.css">
        <link rel="icon" href="./img/icon.png">
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
                <div class="body">
                    <?php if (isset($_GET['err'])) { ?>
                        <div class="err"><?php echo $_GET['err']; ?></div>
                    <?php } ?>
                    <div class="body-top">
                        <div>
                            Buyer Name <br>
                            <div class="box-val">
                                <?php echo $buyer; ?>
                            </div>
                            Postal Code <br>
                            <div class="box-val">
                                <?php echo $postal; ?>
                            </div>
                        </div>
                        <div>
                            Phone <br>
                            <div class="box-val">
                                <?php echo $phone; ?>
                            </div>
                            Date <br>
                            <div class="box-val">
                                <?php echo $date; ?>
                            </div>
                        </div>
                    </div>
                    <div class="body-mid">
                        <div>
                            Address <br>
                            <div class="box-val2">
                                <?php echo $address; ?>
                            </div>
                            <?php if(isset($_SESSION['admin'])) { ?>
                                Input From <br>
                                <div class="box-val-input">
                                    <?php echo $name; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div>
                            Country <br>
                            <div class="box-val">
                                <?php echo $country; ?>
                            </div> <br>
                            <a href="<?php echo "Edit.php?ref=$inv"; ?>" class="btn1">EDIT DATA</a><br>
                        </div>
                    </div>
                    <div class="body-bot">
                        <div>
                            <table class="tab" style="width:100%">
                                <tr>
                                    <th class="th1">No</th>
                                    <th class="th1">Description</th>
                                    <th class="th1">Satuan</th>
                                    <th class="th1">Quantity</th>
                                    <th>Price</th>
                                </tr>
                                <?php
                                    $inv = strval($_GET['ref']);
                                    $query = "SELECT *
                                    FROM descriptions
                                    WHERE invoice_id = '$inv' ";
                                    $Data = mysqli_query($conn, $query);
                                    $x=0;
                                    $total = 0;
                                    while($row = mysqli_fetch_array($Data)) {
                                        $x++;
                                        $total = $total + ($row['prices']*$row['quantity']);
                                        echo "<tr>
                                            <td>$x</td>
                                            <td>".$row['description']."</td>
                                            <td>".$row['metric']."</td>
                                            <td>".$row['quantity']."</td>
                                            <td>".number_format($row['prices'])."</td>
                                        </tr>";
                                    }
                                ?>
                                <tr class="row-bot">
                                    <td colspan="5">TOTAL</td>
                                </tr>
                                <tr class="row-bot">
                                    <td colspan="5"><?php echo number_format($total); ?></td>
                                </tr>
                            </table> <br>
                        </div>
                        <form class="body-bot-2" formaction="" method="POST">
                            <div>
                                PPN 
                                <input class="box1" type="text" name="tax">
                                % <br> <br>
                            </div>
                            <div>
                            </div>
                            <div>
                            </div>
                            <div>
                                <?php
                                    $link = "./connection/invoice.php?ref=$inv";
                                    $link2 = "./connection/kwitansi.php?ref=".$inv;
                                    $link3 = "Packing.php?ref=".$inv;
                                ?>
                                <input type="submit" name="submit" class="submit2" value="INVOICE" formaction="<?php echo $link; ?>" method="POST"><br>
                            </div>
                            <div>
                                <input type="submit" name="submit" class="submit2" value="KWITANSI" formaction="<?php echo $link2; ?>" method="POST"><br>
                            </div>
                            <div>
                                <input type="submit" name="submit" class="submit2" value="PACKING LIST" formaction="<?php echo $link3; ?>" method="POST" target="_blank"><br>
                            </div>
                        </form>
                    </div>
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