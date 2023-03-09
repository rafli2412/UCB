<?php
include ("Server.php");

if ($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    if (isset($_POST['delete'])) {
        $inv = $_POST['invoice'];
        $query = "DELETE FROM datainfo WHERE invoice_id = '$inv' ";

        if ($conn->query($query) === TRUE) {
            header("Location: Input2.php?err=Data Has been Deleted.");
        } else {
            echo "Error: ";
        }
    }

    if (isset($_GET['id'])) {
        $inv = $_GET['ref'];
        $id = $_GET['id'];
        $query = "DELETE FROM descriptions WHERE no = $id ";

        if ($conn->query($query) === TRUE) {
            header("Location: Input-good.php?ref=$inv&err=Item has been deleted.");
        } else {
            echo "Error: ";
        }
    }

    if (isset($_GET['packing'])) {
        $inv = $_GET['ref'];
        $no = $_GET['packing'];
        
        $query = "DELETE FROM packing WHERE no_packing = $no ";

        if ($conn->query($query) === TRUE) {
            header("Location: Packing.php?ref=$inv&err=Item has been deleted.");
        } else {
            echo "Error: ";
        }
    }
}
?>