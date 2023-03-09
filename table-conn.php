<?php
include ("Server.php");

if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    if(isset($_POST['add-item'])) {
        include ("./connection/data-info-query.php");
        $description = $_POST['description'];
        $metrics = $_POST['metrics'];
        if ($_POST['quantity']==NULL) {
            $quantity = 1;
        } else {
            $quantity = $_POST['quantity'];
        }
        $prices = $_POST['prices'];
        //$total = $totalrecent + $_POST['total'];

        //Untuk Invoice
        $invoice = $_POST['invoice'];

        
        //echo "$invoice Rows\n";

        $sql_query = "INSERT INTO descriptions(invoice_id, description, metric, quantity, prices)
        VALUE ('$invoice', '$description', '$metrics', $quantity, $prices)";

        if ($conn->query($sql_query) === TRUE) {
            header("Location: Input-good.php?ref=$invoice");
        } else {
            header("Location: Input-good.php?ref=$invoice&err=Description or Prices is Empty.");
        }
    }

    if(isset($_POST['add-item-list'])) {
        $invoice = $_POST['invoice'];
        $description = $_POST['desc'];
        if ($_POST['quantity']==NULL) {
            $quantity = 1;
        } else {
            $quantity = $_POST['quantity'];
        }
        $weight = $_POST['weight'];

        $sql_query2 = "INSERT INTO packing(invoice_id, description, quantity, nw)
        VALUE ('$invoice', '$description', $quantity, $weight)";

        if ($conn->query($sql_query2) === TRUE) {
            header("Location: Packing.php?ref=$invoice");
        } else {
            header("Location: Packing.php?ref=$invoice&err=Error");
        }
    }

}

$conn->close();
?>