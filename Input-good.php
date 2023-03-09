<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['ID'])) {
    include 'Server.php';
    include ("./connection/data-info-query.php");
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>UCB Express - Input Data</title>
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="./css/style-input2.css">
        <link rel="icon" href="./img/icon.png">
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
                    Input Data - Good(s)
                </div>
                <form class="mid-master" action="" method="POST">
                    <div class="mid-bot2">
                        <input class="hidd" type="text" name="invoice" value="<?php echo $_GET['ref']; ?>">
                        <?php if (isset($_GET['err'])) { ?>
                            <div class="err"><?php echo $_GET['err']; ?></div>
                        <?php } ?>
                        <h3>Nomor Invoice</h1>
                        <br>
                        <?php if (isset($_GET['ref'])) { ?>
                            <div class="success"><?php echo $_GET['ref']; ?></div>
                        <?php } ?> <br>
                    </div>
                    <div class="mid-bot">
                    <div>
                            <label for="">Description of Good(s)</label><br>
                            <input class="box1" type="text" name="description"><br>
                        </div>
                        <div>
                            <label for="">Satuan</label><br>
                            <input list="metrics" name="metrics" class="list">
                            <datalist id="metrics" >
                                <option value="Kilogram(s)">
                                <option value="gram(s)">
                            </datalist>
                        </div>
                        <div>
                            <label for="">Quantity</label><br>
                            <input class="box1" type="text" name="quantity"><br>
                        </div>
                        <div>
                            <label for="">Prices</label><br>
                            <input class="box1" type="text" name="prices"><br>
                        </div>
                    </div>
                    <div class="mid-bot2">
                    <input type="submit" class="submit" value="Add Item" name="add-item" formaction="table-conn.php"><br><br>
                    <table class="tab" style="width:100%">
                            <tr>
                                <?php
                                    $inv = strval($_GET['ref']);
                                    $query = "SELECT *
                                    FROM descriptions
                                    WHERE invoice_id = '$inv' ";
                                    $Data = mysqli_query($conn, $query);
                                    if ($rowtest = mysqli_fetch_array($Data)) { ?>
                                        <th class="th1"></th>
                                    <?php }
                                ?>
                                <th class="th1">No</th>
                                <th class="th1">Description</th>
                                <th class="th1">Satuan</th>
                                <th class="th1">Quantity</th>
                                <th>Price</th>
                            </tr>
                            <?php
                                $x=0;
                                $total = 0;
                                $query = "SELECT *
                                FROM descriptions
                                WHERE invoice_id = '$inv' ";
                                $Data = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_array($Data)) {
                                    $x++;
                                    $total = $total + ($row['prices']*$row['quantity']); ?>
                                    <tr>
                                        <td class="td1"><a class="delete2" href="delete-conn.php?id=<?php echo "".$row['no']."&ref=$inv"; ?> " onclick="return  confirm('Do you want to DELETE this item(s)? ')">X</a></td>
                                        <td class="td1"><?php echo $x; ?></td>
                                        <td class="td1"><?php echo "".$row['description'].""; ?></td>
                                        <td class="td1"><?php echo "".$row['metric'].""; ?></td>
                                        <td class="td1"><?php echo "".$row['quantity'].""; ?></td>
                                        <td class="td1"><?php echo "".number_format($row['prices']).""; ?></td>
                                    </tr>
                                <?php }
                            ?>
                            <tr class="row-bot">
                                <td colspan="5">TOTAL</td>
                            </tr>
                            <tr class="row-bot">
                                <td colspan="5"><?php echo number_format($total); ?></td>
                            </tr>
                        </table>
                        <input class="hidd" type="text" name="total" value="<?php echo $total; ?>">
                        <br>
                        <input type="submit" class="submit" value="Done" name="submit" formaction="Input-good-conn.php" method="POST"><br><br>
                    </div>
                        <?php if (isset($_GET['success'])) { ?>
                        <div class="success"><?php echo $_GET['success']; ?></div>
                        <?php } ?> <br>
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