<?php

if (isset($date)) {
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

    //month in word
    if ($x[0]=="0") {
        if ($x[1] == "1") {
            $monthword = "Jan";
        } else if ($x[1] == "2") {
            $monthword = "Feb";
        } else if ($x[1] == "3") {
            $monthword = "Mar";
        } else if ($x[1] == "4") {
            $monthword = "Apr";
        } else if ($x[1] == "5") {
            $monthword = "May";
        } else if ($x[1] == "6") {
            $monthword = "Jun";
        } else if ($x[1] == "7") {
            $monthword = "Jul";
        } else if ($x[1] == "8") {
            $monthword = "Aug";
        } else if ($x[1] == "9") {
            $monthword = "Sep";
        }
    } else {
        if ($x[1]=="0") {
            $monthword = "Oct";
        } else if ($x[1]=="1") {
            $monthword = "Nov";
        } else if ($x[1]=="2") {
            $monthword = "Dec";
        }
    }

    //date DD-"MONTH"-YY
    $daterev = $date[8].$date[9]."-$monthword-".$date[0].$date[1].$date[2].$date[3];
    //echo $daterev;
}
    //echo $month;

?>