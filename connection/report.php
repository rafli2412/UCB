<?php
require('fpdf17/fpdf.php');
session_start();

include ("Server.php");

$date_s = $_GET['ds'];
$date_e = $_GET['de'];
$company = strval($_SESSION['company']);

$sqlquery = "SELECT * FROM  datainfo  
WHERE date BETWEEN '$date_s' AND '$date_e' AND company = '$company' ORDER BY date ";
$query = mysqli_query($conn, $sqlquery);

$report = mysqli_fetch_array($query);

$pdf = new FPDF('p', 'mm', 'A4');
$pdf->AddPage();

$pdf->Cell(139, 50, '', 0, 0);
if ($company=="UCB") {
    $pdf->Cell(50, 35, $pdf->Image('logo.png', $pdf->GetX(), $pdf->GetY(), 35, 35),0,1,"R");
} else {
    $pdf->Cell(50, 35, $pdf->Image('logo-psp.png', $pdf->GetX(), $pdf->GetY(), 35, 35),0,1,"R");
}
$pdf->SetFont('Courier', 'B', 14);
$pdf->Cell(189, 5, 'REPORT', 0,1, "C");

//spacing
$pdf->Cell(189, 5, '',0,1);//end of line

$pdf->SetFont('Courier','',10);
$pdf->Cell(50, 5, 'Period', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(19, 5, 'From ', 0, 0);
$pdf->SetFont('Courier','',10);
$pdf->Cell(115, 5, $date_s/*$report['tanggal awal]*/,0,1);//end of line

$pdf->SetFont('Courier','',10);
$pdf->Cell(55, 5, '', 0, 0);
$pdf->Cell(19, 5, 'To ', 0, 0);
$pdf->SetFont('Courier','',10);
$pdf->Cell(115, 5, $date_e/*$report['tanggal akhir]*/,0,1);//end of line

//spacing
$pdf->Cell(189, 3, '', 0, 1);//end of line

$pdf->SetFont('Courier','',10);
$pdf->Cell(50, 5, 'Currency', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->SetFont('Courier','',10);
$pdf->Cell(134, 5, "IDR",0,1);//end of line

//spacing
$pdf->Cell(189, 3, '', 0, 1);//end of line
$pdf->SetFont('Courier','B',12);
if ($company=="UCB") {
    $pdf->Cell(189, 5, 'PT. Unifarsa Cipta Bersama Aviasi', 0, 1);//end of line
} else {
    $pdf->Cell(189, 5, 'PT. Partner Sejati Platinum', 0, 1);//end of line
}
//spacing
$pdf->Cell(189, 3, '', 0, 1);//end of line

$pdf->SetFont('Courier','I',12);
$pdf->SetFillColor(66,203,245);
$pdf->Cell(25, 5, 'Date', 1, 0, 'C', "TRUE");
$pdf->Cell(49, 5, 'No. Invoice', 1, 0, 'C',"TRUE");
$pdf->Cell(65, 5, 'Buyer', 1, 0, 'C',"TRUE");
$pdf->Cell(20, 5, 'Country', 1, 0, 'C',"TRUE");
$pdf->Cell(35, 5, 'Total', 1, 1, 'C',"TRUE");//end of line

$query = mysqli_query($conn, $sqlquery/*select date, invoice, name, total from datainfo using(invoiceid) inner join descriptions where date between $dateAwal and $dateAkhir */);
$total = 0;
$row = 0;

while($item = mysqli_fetch_array($query)){
    $pdf->SetFont('Courier', '', 8);
    $pdf->Cell(25, 5, $item['date'], 1, 0);
    $pdf->Cell(49, 5, $item['invoice_id'], 1, 0);
    $pdf->Cell(65, 5, $item['buyer'], 1, 0);
    $pdf->Cell(20, 5, $item['code'], 1, 0);
    $pdf->Cell(35, 5, number_format($item['total']*0.1), 1, 1, 'R');//end of line
    $total += $item['total']*0.1;
    $row++;
}

//spacing
$pdf->cell(189, 5, '', 0,1);//end of line

$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(25, 10, 'Total Data : ', 0, 0);
$pdf->Cell(16, 10, $row, 0, 0);
$pdf->cell(115, 10, 'Total Harga', 0, 0, "R");
$pdf->cell(35, 10, number_format($total), 0, 1, 'R');//end of line

if ($company=="UCB") {
    $out = "Report_UCB.pdf";
} else {
    $out = "Report_PSP.pdf";
}
$pdf->output($out, "D");
?>