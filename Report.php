<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['ID'])) {
    if(isset($_SESSION['admin'])) {
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>UCB Express - Data Buyer</title>
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link rel="icon" href="./img/icon.png">
        <link rel="stylesheet" type="text/css" href="./css/style-report.css">
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
                    <li><a href="Data.php">Data</a></li>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']=="Yes") { ?>
                        <li><a class="input" href="#">Report</a></li>
                    <?php } ?> 
                    <li><a href="Logout.php">Keluar</a></li>
                </ul>
            </div>
            <form class="grid2 bg-info" method="POST" action="">
                <div class="top">
                    Report
                </div>
                <?php if(isset($_GET['err'])) { ?>
                        <div class="danger"><?php echo $_GET['err']; ?></div>
                    <?php } ?> 
                <div class="mid">
                    <button type="submit" 
                    class="btn <?php if(isset($_GET['type']) && $_GET['type']=="time-period") {
                            echo "btn-primary";
                        } else {
                            echo "btn-outline-primary bg-light";
                        } ?>" formaction="Report.php?type=time-period" >Time Period</button>

                    <button type="submit" 
                    class="btn <?php if(isset($_GET['type']) && $_GET['type']=="period") {
                            echo "btn-primary";
                        } else {
                            echo "btn-outline-primary bg-light";
                        } ?> " formaction="Report.php?type=period">Period</button>
                </div>
                
                <?php if(isset($_GET['type']) && $_GET['type']=="time-period") { ?>
                    <div class="bot-tp">
                        <div>
                            <p class="text-white bg-secondary">Date Start</p>
                            <input type="date" name="date-start" class="box1">
                        </div>
                        <div>
                            <p class="text-white bg-secondary">Date End</p>
                            <input type="date" name="date-end" class="box1" min=>
                        </div>
                            <br>
                        <div class="bot-bot" >
                            <input type="submit" class="submit" value="P R I N T" formaction="report-conn.php" method="POST">
                        </div>
                    </div>
                <?php } else if(isset($_GET['type']) && $_GET['type']=="period") { ?>
                    <div class="bot-p">
                        <div>
                            <input type="submit" name="date" class="submit" value="Last Month" formaction="report-conn.php" method="POST">
                        </div>
                            <br>
                        <div>
                            <input type="submit" name="date" class="submit" value="Last Week" formaction="report-conn.php" method="POST">
                        </div>
                            <br>
                        <div>
                            <input type="submit" name="date" class="submit" value="Today" formaction="report-conn.php" method="POST">
                        </div>
                    </div>
                <?php } ?>
            </form>
        </div>
    </body>
</html>

<?php
    } else {
        header("Location: javascript://history.go(-1)");
    }
} else {
    header("Location: Login.php");
    exit();
}
?>