<?php
require('fpdf17/fpdf.php');

//koneksi db
include ("Server.php");

//Nomor Invoice
$ref=strval($_GET['ref']);

if (isset($_POST['submit'])) {
    if ($_POST['tax']!=NULL && is_numeric($_POST['tax'])) {
        $tax=0.01*($_POST['tax']);
    } else {
        $tax=0;
    }
}

//ambil data dari db
$sqlquery = "SELECT * FROM  datainfo INNER JOIN descriptions USING (invoice_id)
WHERE invoice_id = '$ref' ";
$query = mysqli_query($conn, $sqlquery);

$receipt = mysqli_fetch_array($query);

if ($receipt['invoice_id']==NULL && $receipt['no']==NULL && $receipt['description']==NULL) {
    header("Location: /Data-info.php?ref=$ref&err=Data aren't completed. Please fill the remaining blank column or Adding item by Editing the Data!");
    exit();
}

$pdf = new FPDF('p', 'mm', 'A4');
$pdf->AddPage();

//indentasi
$pdf->Cell(10, 20, '', 0, 0);
$pdf->SetFont('Courier', 'B', '20');
if ($receipt['company']=="UCB") {
    $pdf->Cell(20, 20, $pdf->Image('logo.png', $pdf->GetX(), $pdf->GetY(), 20, 20),0,0);
} else {
    $pdf->Cell(20, 20, $pdf->Image('logo-psp.png', $pdf->GetX(), $pdf->GetY(), 20, 20),0,0);
}

if ($receipt['company']=="UCB") {
    $pdf->Cell(159, 20, 'PT. Unifarsa Cipta Bersama Aviasi', 0, 1);//end of line
} else {
    $pdf->Cell(159, 20, 'PT. PARTNER SEJATI PLATINUM', 0, 1);//end of line
}
//Dummy cell
$pdf->Cell(189, 2, '', 0, 1);//end of line

$pdf->SetFont('Courier', '', '8');
//indentasi
$pdf->Cell(5,5, '', 0, 0);
$pdf->Cell(184, 5, 'Jalan Danau Sentarum nomor 33, Kelurahan Sungai Bangkong, Kecamatan Pontianak Kota. Kota Pontianak',0,1);//end of line

//indentasi
$pdf->Cell(5,5, '', 0, 0);
$pdf->Cell(184, 5, 'Pontianak Kota, Kota Pontianak, KALIMANTAN BARAT',0,1);//end of line

//indentasi
$pdf->Cell(5,5, '', 0, 0);
$pdf->Cell(184, 5, 'KALIMANTAN BARAT - 78116',0,1);//end of line

//indentasi
$pdf->Cell(5,5, '', "B", 0);
if ($receipt['company']=="UCB") {   
    $pdf->Cell(184, 5, 'email : ucb.express.2021@gmail.com',"B",1);//end of line
} else {
    $pdf->Cell(184, 5, 'email : ptpartnersejati@gmail.com',"B",1);//end of line
}

//Dummy cell
$pdf->Cell(189, 1, '', 0, 1);//end of line

$pdf->SetFont('Courier', '', '15');
$pdf->SetTextColor(255,0,0);
$pdf->Cell(189, 10, 'KWITANSI', 1, 1, 'C');//end of line

$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Courier', 'B', '12');
$pdf->cell(189, 5, "Nomor : ".$receipt['invoice_id'], "L,B,R", 1, 'C');//end of line

//Dummy cell
$pdf->Cell(189, 1, '', 0, 1);//end of line


//indentasi + isi
$pdf->Cell(189, 2, '', "L,T,R", 1);//end of line
$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(40, 5, 'Nama pembeli ', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->SetFont('Courier', '', '10');
$pdf->Cell(139, 5, $receipt['buyer'],"R",1);//end of line

//Spacing
$pdf->Cell(189, 5, '', "L,R", 1);//end of line

$query2 = mysqli_query($conn, "SELECT * from descriptions WHERE invoice_id ='".$receipt['invoice_id']."'");
$pajak = 0;
$harga = 0;

while($item = mysqli_fetch_array($query2)){
    $total = 0;
    $total = $item['quantity'] * $item['prices'];
    $pajak += $total * $tax;
    $harga += $total;
}

$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(40, 5, 'Uang Sejumlah ', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->SetFont('Courier', 'B', '10');
$pdf->Cell(10, 5, 'Rp ', 0, 0, 'L');
$pdf->Cell(129, 5, number_format($harga + $pajak),"R",1);//end of line

//Spacing
$pdf->Cell(189, 5, '', "L,R", 1);//end of line

include('terbilang.php');
//echo $word[74];
//echo strlen($word);


if (strlen($word)>60) {
    $height = strlen($word);
    $height = ceil($height/60);
    $pdf->SetFont('Courier', 'B', '12');
    $pdf->Cell(5, 5, '', "L", 0);
    $pdf->Cell(40, 5, 'Terbilang ', 0, 0);
    $pdf->Cell(144, 5, ':', "R", 1);
    $pdf->SetFont('Courier', 'I', '12');

    $pdf->Cell(5, 5*$height, "", "L", 0);
    $pdf->MultiCell(184, 5, $word." Rupiah","R", "J");//end of line
} else {
    $pdf->SetFont('Courier', 'B', '12');
    $pdf->Cell(5, 5, '', "L", 0);
    $pdf->Cell(40, 5, 'Terbilang ', 0, 0);
    $pdf->Cell(5, 5, ':', 0, 0);
    $pdf->SetFont('Courier', 'I', '10');
    $pdf->Cell(139, 5, $word." Rupiah","R",1);//end of line
}

//Spacing
$pdf->Cell(189, 5, '', "L,R", 1);//end of line

$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(40, 5, 'Untuk Pembayaran ', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->SetFont('Courier', '', '12');
$pdf->Cell(30, 5, "Invoice Nomor ",0,0);
$pdf->Cell(5,5, ": ",0,0);
$pdf->SetFont('Courier', '', '12');
$pdf->Cell(62, 5, $receipt['invoice_id'],0,0);
$pdf->Cell(42, 5, "10-12-2021"/*$var['table']*/, "R",1);//end of line

//Spacing
$pdf->Cell(189, 15, '', "L,R", 1);

//End
//indentasi
$date = $receipt['date'];
include("date.php");
$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(184, 5, 'Pontianak, '.$daterev/*$var['tanggal']*/, "R", 1);//end of line

$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(5, 5, '', "L", 0);
if ($receipt['company']=="UCB") {  
    $pdf->Cell(184, 5, 'PT. Univarsa Cipta Bersama', "R", 1);//end of line
} else {
    $pdf->Cell(184, 5, 'PT. Partner Sejati Platinum', "R", 1);//end of line
}

$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(105, 5, 'Regards,', 0, 0);
$pdf->SetFont('Courier', 'B', '10');
$pdf->SetDrawColor(255,0,0);
if ($receipt['company']=="UCB") {  
    $pdf->SetFont('Courier', 'B', '8');
} else {
    $pdf->SetFont('Courier', 'B', '9');

}
$pdf->Cell(74, 5, 'Please transfer payment to :', "L,T,R", 0, "C");
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(5, 5, '', "R", 1);//end of line

$pdf->Cell(110, 5, '', "L", 0);
$pdf->SetDrawColor(255,0,0);
if ($receipt['company']=="UCB") {  
    $pdf->Cell(74, 5, 'Account : 146-000-01117111', "L,R", 0, "C");
} else {
    $pdf->Cell(74, 5, 'Account : 146-003-5888333', "L,R", 0, "C");
}
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(5, 5, '', "R", 1);//end of line

$pdf->Cell(110, 5, '', "L", 0);
$pdf->SetDrawColor(255,0,0);
if ($receipt['company']=="UCB") {  
    $pdf->Cell(74, 5, 'Name : PT. Unifarsa Cipta Bersama Aviasi', "L,R", 0, "C");
} else {
    $pdf->Cell(74, 5, 'Name : PT. Partner Sejati Platinum', "L,R", 0, "C");
}
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(5, 5, '', "R", 1);//end of line

$pdf->Cell(110, 5, '', "L", 0);
$pdf->SetDrawColor(255,0,0);
$pdf->Cell(74, 5, 'Bank : PT. Bank Mandiri (Persero) Tbk', "L,R", 0, "C");
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(5, 5, '', "R", 1);//end of line

$pdf->Cell(110, 5, '', "L", 0);
$pdf->SetDrawColor(255,0,0);
$pdf->Cell(74, 5, 'KCP Sidas Pontianak', "L,B,R", 0, "C");
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(5, 5, '', "R", 1);//end of line

$pdf->SetFont('Courier', 'U', '12');
$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(184, 5, 'DEKI YUANDA', "R", 1);//end of line
$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(184, 5, 'General Manager', "R", 1);//end of line

//Dummy Line
$pdf->Cell(189, 15, '', "L,B,R", 1);//end of line

$out = "Kwitansi ".$ref.".pdf";
$pdf->Output($out, 'D');
?>