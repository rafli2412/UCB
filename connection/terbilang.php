<?php
    //fungsi terbilang;
    $total = $harga + $pajak;
    //echo $total/10000;
    //echo $total%10000;
    $totalstr = strval($total);
    $totallen = strlen($totalstr);

    function InWord($int) {
        $arr = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", 
        "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", 
        "Seventeen", "Eightteen", "Nineteen");
        $arr2 = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty",
        "Seventy", "Eighty", "Ninety");
        $temp = "";
        if ($int<20) {
            $temp = "".$arr[$int];
        } else if ($int<100) {
            $temp = $arr2[$int/10] . InWord($int % 10);
        } elseif ($int<1000) {
            if ($int%100==0) {
                $temp = InWord($int/100) . " Hundred ";
            } else {
                $temp = InWord($int/100) . " Hundred and " . InWord($int%100);
            }    
        } elseif ($int<10000) {
            $temp = InWord($int/1000)." Thousand ".InWord($int%1000);
        } elseif ($int<1000000000) {
            if ($int < 100000) {
                $temp = InWord($int/1000)." Thousand ".InWord($int%1000);
            } elseif ($int < 1000000) {
                $temp = InWord($int/100000)." Hundred and ".InWord($int%100000);
            } elseif ($int<10000000) {
                $temp = InWord($int/1000000)." Million ". InWord($int%1000000);
            } elseif ($int<100000000) {
                $temp = InWord($int/1000000)." Million ". InWord($int%1000000);
            } else {
                $temp = InWord($int/100000000)." Hundred ". InWord($int%100000000);
            }
            //$temp = InWord($int/1000000). " Million ".InWord($int%1000000);
        } elseif ($int<10000000000) {
            $temp = InWord($int/1000000000). " Billion and ". InWord($int%1000000000);
        }
        return $temp;
    }

    $word = InWord($total);
    //echo $arr[1];

?>