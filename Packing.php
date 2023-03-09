<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['ID'])) {
    include 'Server.php';
    include ("./connection/data-info-query.php");
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Packing List</title>
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
                    <li><a href="Home2.php">Overview</a></li>
                    <li><a href="#">Input</a></li>
                    <li><a class="input" href="Data.php">Data</a></li>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']=="Yes") { ?>
                        <li><a href="Report.php">Report</a></li>
                    <?php } ?> 
                    <li><a href="Logout.php">Keluar</a></li>
                </ul>
            </div>
            <div class="grid2">
                <div class="top">
                    Packing List
                </div>
                <form class="mid-master" action="" method="POST">
                    <div class="mid-bot2">
                        <a href="Data-info.php?ref=<?php echo $_GET['ref']; ?>" class="btn1-back">&lt</a>
                        <input class="hidd" type="text" name="invoice" value="<?php echo $_GET['ref']; ?>">
                        <?php if (isset($_GET['err'])) { ?>
                            <div class="err"><?php echo $_GET['err']; ?></div>
                        <?php } ?>
                        <h3>Nomor Invoice</h1>
                        <br>
                        <?php if (isset($_GET['ref'])) { ?>
                            <div class="packing"><?php echo $_GET['ref']; ?></div>
                        <?php } ?> <br>
                    </div>
                    <div class="mid-bot-packing">
                        <div>
                            <label for="">Description</label><br>
                            <input list="desc" name="desc" class="list">
                            <datalist id="desc" >
                                <?php
                                    $inv = strval($_GET['ref']);
                                    $query = "SELECT * FROM descriptions
                                    WHERE invoice_id = '$inv' ";
                                    $Data = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($Data)) { ?>
                                        <option value="<?php echo $row['description']; ?>">
                                    <?php }
                                ?>
                            </datalist>
                        </div>
                        <div>
                            <label for="">Quantity (Box)</label><br>
                            <input class="box1" type="text" name="quantity"><br>
                        </div>
                        <div>
                            <label for="">N.W</label><br>
                            <input class="box1" type="text" name="weight"><br>
                        </div>
                    </div>
                    <div class="mid-bot2">
                    <input type="submit" class="submit" value="Add Item List" name="add-item-list" formaction="table-conn.php"><br><br>
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
                                <th class="th1">Quantity (Box)</th>
                                <th class="th1">N.W (Kgs)</th>
                                <th>Total</th>
                            </tr>
                            <?php
                                $x=0;
                                $total = 0;
                                $query = "SELECT *
                                FROM packing
                                WHERE invoice_id = '$inv' ";
                                $Data = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_array($Data)) {
                                    $x++; ?>
                                    <tr>
                                        <td class="td1"><a class="delete2" href="delete-conn.php?packing=<?php echo "".$row['no_packing']."&ref=$inv"; ?> " onclick="return  confirm('Do you want to DELETE this item(s)? ')">X</a></td>
                                        <td class="td1"><?php echo $x; ?></td>
                                        <td class="td1"><?php echo "".$row['description'].""; ?></td>
                                        <td class="td1"><?php echo "".$row['quantity'].""; ?></td>
                                        <td class="td1"><?php echo "".$row['nw'].""; ?></td>
                                        <td class="td1"><?php echo "".($row['quantity']*$row['nw']).""; ?></td>
                                    </tr>
                                <?php }
                            ?>
                            
                        </table>
                        <input class="hidd" type="text" name="total" value="<?php echo $total; ?>">
                        <br>
                        <input type="submit" class="submit" value="P R I N T  P A C K I N G  L I S T" name="submit" formaction="./connection/paking-list.php?ref=<?php echo $inv; ?>" method="POST"><br><br>
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