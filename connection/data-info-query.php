<?php
    $inv = strval($_GET['ref']);

    //Untuk table parent (datairtual)
    $query = "SELECT * FROM datainfo
    WHERE invoice_id = '$inv' ";

    $Data = mysqli_query($conn, $query);
    $row = $row = mysqli_fetch_array($Data);

    $number = "";
    for ($i=0; $i<strlen($inv); $i++) {
        if ($inv[$i]=="/") {
            break;
        }
        $number .= $inv[$i];
    }
    $company = $row['company'];
    $buyer = $row['buyer'];
    $postal = $row['postcode'];
    $phone = $row['phone'];
    $date = $row['date'];
    $address = $row['address'];
    $country = $row['country'];
    $code = $row['code'];
    $totalrecent = $row['total'];

    $id = $row['ID'];
    $query = "SELECT * FROM users
    WHERE ID = '$id' ";

    $Data = mysqli_query($conn, $query);
    $row2 = $row2 = mysqli_fetch_array($Data);
    $name = $row2['name'];

    //Untuk table child (description)
    
?>