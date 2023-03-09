<?php
session_start();
include ("Server.php");

if ($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    if(isset($_POST['date-start']) && isset($_POST['date-end'])) {
        $date_s = $_POST['date-start'];
        $date_e = $_POST['date-end'];

        if ($date_s < $date_e) {
            header("Location: ./connection/report.php?ds=$date_s&de=$date_e");
        } else {
            header("Location: Report.php?type=time-period&err=Date are in Incorrect order.");
        }
        echo $date_s < $date_e;
    } else if (isset($_POST['date'])) {
        if($_POST['date']=="Last Month") {
            $date_e = date("Y-m-d", strtotime("today"));
            $date_s = date("Y-m-d", strtotime("-1 month"));
        } else if ($_POST['date']=="Last Week") {
            $date_e = date("Y-m-d", strtotime("today"));
            $date_s = date("Y-m-d", strtotime("-1 week"));
        } else if ($_POST['date']=="Today") {
            $date_e = date("Y-m-d", strtotime("now"));
            $date_s = date("Y-m-d", strtotime("now"));
        }

        if (isset($date_s) && isset($date_e)) {
            header("Location: ./connection/report.php?ds=$date_s&de=$date_e");
        } else {
            header("Location: Report.php?type=period&err=Date are in Incorrect order.");
        }
    }
}

$conn->close();
?>