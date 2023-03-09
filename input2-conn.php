<?php
session_start();
include ("Server.php");
//$conn = mysqli_connect("localhost", "root", "", "test_db");

if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    if(isset($_POST['submit'])) {
        $company = $_POST['company'];
        $buyer = $_POST['buyer'];
        $postal = $_POST['postal'];
        $phone = $_POST['phone'];
        $date = $_POST['date'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $code = $_POST['code'];
        $total = 0;

        if (isset($_POST['invoice'])) {
            $invoice = $_POST['invoice'];

            //Untuk Invoice baru
            $invoice_new = $_POST['number'];
            $code = strtoupper($code);
            $year="";
            $month="";
            include "./connection/date.php";
            for ($i=0; $i<=3; $i++) {
                $year .= $date[$i];
            }
            $invoice_new .= "/".$company."-".$code."/".$month."/".$year;

            $sql_query = "UPDATE datainfo
            SET buyer = '$buyer', postcode = '$postal', phone = '$phone',
            date = '$date', address = '$address', country = '$country',
            code = '$code', company = '$company', invoice_id = '$invoice_new'
            WHERE invoice_id = '$invoice' ";

            if ($conn->query($sql_query) === TRUE) {
                header("Location: Edit.php?ref=$invoice_new&success=Data has been edited");
            } else {
                echo "Error: ";
            }

        } else {
        //Untuk Invoice
            $ID = $_SESSION['ID'];
            $invoice = $_POST['number'];
            $code = strtoupper($code);
            $invsql = "SELECT *
            FROM datainfo";
            $year="";
            $month="";
            for ($i=0; $i<=3; $i++) {
                $year .= $date[$i];
            }

            include "./connection/date.php";
            /*
            $result = mysqli_query($conn, $invsql);
            $invoice = mysqli_num_rows($result);
            $invoice++;
            */
            $invoice .= "/".$company."-".$code."/".$month."/".$year;
            

            $sql_query = "INSERT INTO datainfo(invoice_id, company, buyer, phone, postcode, address, 
            country, code, date, total, ID)
            VALUE ('$invoice', '$company', '$buyer', '$phone', '$postal', '$address', 
            '$country', '$code', '$date', $total, $ID)";

            
            if ($conn->query($sql_query) === TRUE) {
                header("Location: Input-good.php?ref=$invoice");
            } else {
                echo "Error: ";
            }
        }
    }
}

$conn->close();
?>