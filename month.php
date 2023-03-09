<?php


    $month = "";
    $x = $date[5].$date[6];
    //echo "$x\r\n";

    if ($x[0]=="0") {
        if ($x[1] == "1") {
            $month = "I";
        } else if ($x[1] == "2") {
            $month = "II";
        } else if ($x[1] == "3") {
            $month = "III";
        } else if ($x[1] == "4") {
            $month = "IV";
        } else if ($x[1] == "5") {
            $month = "V";
        } else if ($x[1] == "6") {
            $month = "VI";
        } else if ($x[1] == "7") {
            $month = "VII";
        } else if ($x[1] == "8") {
            $month = "VIII";
        } else if ($x[1] == "9") {
            $month = "IX";
        }
    } else {
        if ($x[1]=="0") {
            $month = "X";
        } else if ($x[1]=="1") {
            $month = "XI";
        } else if ($x[1]=="2") {
            $month = "XII";
        }
    }

    //echo $month;

?>