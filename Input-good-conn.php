<?php
include ("Server.php");

if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    if(isset($_POST['submit'])) {
        $total = $_POST['total'];

        //Untuk Invoice
        $invoice = $_POST['invoice'];
        
        //echo "$invoice Rows\n";

        $sql_query = "UPDATE datainfo
        SET total = $total
        WHERE invoice_id = '$invoice' ";
    }

    if ($conn->query($sql_query) === TRUE) {
        header("Location: Data-info.php?ref=$invoice");
    } else {
        echo "Error: ";
    }
}

$conn->close();
?>