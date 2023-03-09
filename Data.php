<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['ID'])) {
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>UCB Express - Data Buyer</title>
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link rel="icon" href="./img/icon.png">
        <link rel="stylesheet" type="text/css" href="./css/style-data.css">
        <link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="./css/dataTables.bootstrap4.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
        <script src="./js/query-3.5.1.js"></script>
        <script src="./js/query.dataTables.min.js"></script>
        
    </head>

    <body>
        <div class="grid">
            <div>
                <img class="logo" src="./img/logo.png">
                <ul>
                    <li><a href="Home2.php">Overview</a></li>
                    <li><a href="Input2.php">Input</a></li>
                    <li><a class="input" href="#">Data</a></li>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']=="Yes") { ?>
                        <li><a href="Report.php">Report</a></li>
                    <?php } ?> 
                    <li><a href="Logout.php">Keluar</a></li>
                </ul>
            </div>
            <div class="grid2">
                <div class="top">
                    Data Buyer
                </div>
                <form class="mid-master">
                    <div class="mid-top">
                        <div class="container">

                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Buyer Name</th>
                                <th>Country</th>
                                <th>Date</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = strval($_SESSION['ID']);
                            $company = $_SESSION['company'];
                            $query = "SELECT * FROM datainfo WHERE ID='$id' ";
                            if(isset($_SESSION['admin'])) {
                                $query = "SELECT * FROM datainfo WHERE company='$company' ";
                            }
                            include 'Server.php';
                            $Data = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($Data)) {
                                $ref = "";
                                $ref = $row['invoice_id'];
                                $link = "Data-info.php?ref=".$ref;
                                echo "<tr>
                                    <td><a href=$link>".$row['invoice_id']."</a></td>
                                    <td>".$row['buyer']."</td>
                                    <td>".$row['country']."</td>
                                    <td>".$row['date']."</td>
                                    <td>".$row['total']."</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                        </table>
                        </div>

                        <script>
                        $(document).ready(function() {
                            $('#example').DataTable();
                        } );
                        </script>
                    </div>
                    <div class="mid-midd">
                    </div>
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