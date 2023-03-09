<?php
require('fpdf17/fpdf.php');

//koneksi db
include ("Server.php");

//Nomor Invoice
$ref=strval($_GET['ref']);

//Pajak
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

//$query = mysqli_query($conn, "select * from invoice inner join clients using(clientID) where invoiceID = '".$_GET['invoiceID']."'");
$query = mysqli_query($conn, $sqlquery);

//hitung jumlah item
$total_row =  mysqli_num_rows($query);

$invo = mysqli_fetch_array($query);

if ($invo['invoice_id']==NULL && $invo['no']==NULL && $invo['description']==NULL) {
    header("Location: /Data-info.php?ref=$ref&err=Data aren't completed. Please fill the remaining blank column or Adding item by Editing the Data!");
    exit();
}

//A4 width : 219mm
//default margin : 10mm each side
//writeable horizontal : 219-(10*2) = 189mm
$pdf = new FPDF('p', 'mm', 'A4');
$pdf->AddPage();

//set font(family, style, size)
$pdf->SetFont('Courier', 'B', '14');

/*Cell untuk text
Cell (with, height, text, border, line, [align])*/

//image
//image(file name, pos x, pos y, width, height)
if ($invo['company'] == "UCB") {
    $pdf->Cell(30, 20, $pdf->Image('logo.png', $pdf->GetX(), $pdf->GetY(), 20, 20),"L,T",0);
} else if ($invo['company'] == "PSP") {
    $pdf->Cell(30, 20, $pdf->Image('logo-psp.png', $pdf->GetX(), $pdf->GetY(), 20, 20),"L,T",0);
}

if ($invo['company'] == "UCB") {
    $pdf->Cell(159, 20, 'PT. Unifarsa Cipta Bersama Aviasi', "T,R", 1);//end of line
} else {
    $pdf->Cell(159, 20, 'PT. PARTNER SEJATI PLATINUM', "T,R", 1);//end of line
}

$pdf->SetFont('Courier', '', '9');
$pdf->Cell(189, 3, 'Jalan Danau Sentarum nomor 33, Kelurahan Sungai Bangkong, Kecamatan Pontianak Kota. Kota Pontianak', "L,R", 1);//end of line
$pdf->Cell(189, 3, 'KALIMANTAN BARAT - 78116', "L,R", 1);//end of line

if ($invo['company'] == "UCB") {
    $pdf->Cell(189, 3, 'email : ucb.express.2021@gmail.com', "L,R", 1);//end of line
} else {
    $pdf->Cell(189, 3, 'email : ptpartnersejati@gmail.com', "L,R", 1);//end of line
}
//Dummy untuk spacing
$pdf->Cell(189, 5, '', "L,R", 1);//end of line

//Fill background
$pdf->SetFillColor(0,161,0);
$pdf->SetFont('Courier', 'B', '14');
$pdf->cell(189, 10, 'I N V O I C E', "L,R", 1, 'C', TRUE);

$pdf->cell(189, 5, "Nomor : ".$invo['invoice_id'], "L,B,R", 1, 'C');//end of line

//Dummy untuk spacing
$pdf->Cell(189, 3, '', "L,R", 1);//end of line

//Info pembeli
$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(40, 5, 'Nama pengirim ', "L", 0);
//indentasi
$pdf->Cell(5, 5, ':', 0, 0);
//isi
$pdf->SetFont('Courier', '', '10');
if ($invo['company'] == "UCB") {
    $pdf->Cell(144, 5, 'PT. Univarsa Cipta Bersama Aviasi', "R", 1);//end of line
} else {
    $pdf->Cell(144, 5, 'PT. Partner Sejati Platinum', "R", 1);//end of line
}

$pdf->SetFont('Courier', '', '10');
$pdf->Cell(45, 5, '', "L", 0);
$pdf->Cell(144, 5, 'Jalan Danau Sentarum nomor 33 Kelurahan Sei Bangkong,', "R", 1);//end of line

$pdf->SetFont('Courier', '', '10');
$pdf->Cell(45, 5, '', "L", 0);
$pdf->Cell(144, 5, 'Kecamatan Pontianak Kota, Kota Pontianak', "R", 1);//end of line

$pdf->SetFont('Courier', '', '10');
$pdf->Cell(45, 5, '', "L", 0);
$pdf->Cell(144, 5, 'Kalimantan Barat - 78116', "R", 1);//end of line

$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(40, 5, 'No HP ', "L", 0);
//indentasi
$pdf->Cell(5, 5, ':', 0, 0);
//isi
$pdf->SetFont('Courier', '', '10');
$pdf->Cell(144, 5, '+62 821 5835 8783', "R", 1);//end of line
$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(40, 5, 'Email ', "L", 0);
//indentasi
$pdf->Cell(5, 5, ':', 0, 0);
//isi
$pdf->SetFont('Courier', '', '10');

if ($invo['company'] == "UCB") {
    $pdf->Cell(144, 5, 'ucb.express.2021@gmail.com', "R", 1);//end of line
} else {
    $pdf->Cell(144, 5, 'ptpartnersejati@gmail.com', "R", 1);//end of line
}

//Dummy untuk spacing
$pdf->Cell(189, 5, '', "L,R", 1);//end of line

//Info pembeli
$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(40, 5, 'Nama pembeli ', "L", 0);
//indentasi
$pdf->Cell(5, 5, ':', 0, 0);
//isi
$pdf->SetFont('Courier', '', '10');
$pdf->Cell(144, 5, $invo['buyer'], "R", 1);//end of line

//$pdf->Cell(40, 5, 'Alamat', "L", 0);

if (strlen($invo['address'])>90) {
    $pdf->SetFont('Courier', 'B', '12');
    $height = strlen($invo['address']);
    $height = ceil($height/90);
    $pdf->Cell(40, 5, 'Alamat', "L", 0);
    $pdf->Cell(149, 5, ':', "R", 1);
    //isi
    $pdf->SetFont('Courier', '', '10');
    //$pdf->Cell(144, 5, $invo['address'], "R", 1);//end of line
    $pdf->Cell(45, 10*$height, "", "L", 0);
    $pdf->MultiCell(144, 5, $invo['address'], "R", "J");//end of line
} else {
    $pdf->SetFont('Courier', 'B', '12');
    $pdf->Cell(40, 5, 'Alamat', "L", 0);
    $pdf->Cell(5, 5, ':', 0, 0);
    //isi
    $pdf->SetFont('Courier', '', '10');
    $pdf->Cell(144, 5, $invo['address'], "R", 1);//end of line
}


/*$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(40, 5, 'Perusahaan', "L", 0);
//indentasi
$pdf->Cell(5, 5, ':', 0, 0);
//isi
$pdf->SetFont('Courier', '', '12');
$pdf->Cell(144, 5, $invo['address'], "R", 1);//end of line
*/

$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(40, 5, 'No HP', "L", 0);
//indentasi
$pdf->Cell(5, 5, ':', 0, 0);
//isi
$pdf->SetFont('Courier', '', '10');
$pdf->Cell(144, 5, $invo['phone'], "R", 1);//end of line

$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(40, 5, 'Kode pos', "L", 0);
//indentasi
$pdf->Cell(5, 5, ':', 0, 0);
//isi
$pdf->SetFont('Courier', '', '10');
$pdf->Cell(144, 5, $invo['postcode'], "R", 1);//end of line

$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(40, 5, 'Satuan', "L", 0);
//indentasi
$pdf->Cell(5, 5, ':', 0, 0);
//isi
$pdf->SetFont('Courier', '', '10');
$pdf->Cell(144, 5, $invo['metric']/*$var['tabel']*/, "R", 1);//end of line

//Dummy untuk spacing
$pdf->Cell(189, 5, '', "L,B,R", 1);//end of line

//Barang
//display item
$query = mysqli_query($conn, "SELECT * FROM descriptions WHERE invoice_id ='".$invo['invoice_id']."'");
$pajak = 0;
$harga = 0;
$no = 0;

if ($total_row <= 8) {

    $pdf->SetFont('Courier', 'B', '12');
    $pdf->cell(7, 10, "No.", 1, 0, 'C', TRUE);

    $pdf->cell(73, 10, 'Deskripsi', 1, 0, 'C', TRUE);

    $pdf->cell(30, 10, 'Quantity', 1, 0, 'C', TRUE);

    $pdf->cell(47, 10, 'Price per Kgs (Rp)', 1, 0, 'C', TRUE);//end of line

    $pdf->cell(32, 10, 'Harga (Rp)', 1, 1, 'C', TRUE);//end of line

    while($item = mysqli_fetch_array($query)){
        $total = 0;
        $no++;
        $total = $item['quantity'] * $item['prices'];
        $pdf->SetFont('Courier', '', '10');
        $pdf->cell(7, 5, $no, 1, 0, 'C');
        $pdf->Cell(73, 5, $item['description'], 1, 0);
        $pdf->Cell(30, 5, number_format(($item['quantity'])), 1, 0, 'R');
        $pdf->Cell(47, 5, number_format(($item['prices'])), 1, 0, 'R');
        $pdf->Cell(32, 5, number_format($total), 1, 1, 'R');//end of line
        //Kalkulasi pajak dan harga
        $pajak += ($total * $tax);
        $harga += $total;
    }

    for ($i=$total_row; $i<8; $i++) {
        $pdf->cell(7, 5, "", 1, 0, 'C');
        $pdf->Cell(73, 5, "", 1, 0);
        $pdf->Cell(30, 5, "", 1, 0, 'R');
        $pdf->Cell(47, 5, "", 1, 0, 'R');
        $pdf->Cell(32, 5, "", 1, 1, 'R');//end of line
    }

    //Subtotal
    $pdf->SetFont('Courier', 'B', '12');
    $pdf->cell(157, 6, 'Subtotal', "L, T, R", 0, 'R');
    $pdf->SetFont('Courier', '', '12');
    $pdf->cell(32, 6, number_format($harga), 1, 1, 'R');

    //Pajak
    $pdf->SetFont('Courier', 'B', '12');
    $pdf->cell(157, 6, 'PPn', "L, B, R", 0, 'R');
    $pdf->SetFont('Courier', '', '12');
    $pdf->cell(32, 6, number_format($pajak), 1, 1, 'R');

    //Total
    $pdf->SetFont('Courier', 'B', '12');
    $pdf->cell(157, 10, 'Total Harga', 1, 0, 'R');
    $pdf->cell(32, 10, number_format($harga + $pajak), 1, 1, 'R');
} else {
    $pdf->cell(189, 10, '', "L,R", 1);

    for ($i=1; $i<=10; $i++) {
        $pdf->cell(189, 5, '', "L,R", 1);
    }
    $pdf->cell(189, 7, '', "L,R", 1);
    $pdf->SetFont('Courier', 'B', '12');
}

//Dummy untuk spacing
$pdf->Cell(189, 10, '', "L,R", 1);//end of line

//End
//indentasi
$date = $invo['date'];
include("date.php");
$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(184, 5, 'Pontianak, '.$daterev/*$var['tanggal']*/, "R", 1);//end of line

$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(5, 5, '', "L", 0);
if ($invo['company'] == "UCB") {
    $pdf->Cell(184, 5, 'PT. Unifarsa Cipta Bersama Aviasi', "R", 1);//end of line
} else {
    $pdf->Cell(184, 5, 'PT. PARTNER SEJATI PLATINUM', "R", 1);//end of line
}

$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(184, 5, 'Regards,', "R", 1);//end of line

$pdf->Cell(189, 25, '', "L,R", 1);//end of line

$pdf->SetFont('Courier', 'U', '12');
$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(184, 5, 'DEKI YUANDA', "R", 1);//end of line
$pdf->SetFont('Courier', 'B', '12');
$pdf->Cell(5, 5, '', "L", 0);
$pdf->Cell(184, 5, 'General Manager', "R", 1);//end of line

//Dummy Line
$pdf->Cell(189, 15, '', "L,B,R", 1);//end of line

//Item lebih dari 8
if ($total_row>8) {
    $pdf->Cell(189, 15, '', 0, 1);//end of line

    $pdf->SetFont('Courier', 'B', '12');
    $pdf->cell(7, 10, "No.", 1, 0, 'C', TRUE);

    $pdf->cell(73, 10, 'Deskripsi', 1, 0, 'C', TRUE);

    $pdf->cell(30, 10, 'Quantity', 1, 0, 'C', TRUE);

    $pdf->cell(47, 10, 'Price per Kgs (Rp)', 1, 0, 'C', TRUE);//end of line

    $pdf->cell(32, 10, 'Harga (Rp)', 1, 1, 'C', TRUE);//end of line

    while($item = mysqli_fetch_array($query)){
        $total = 0;
        $no++;
        $total = $item['quantity'] * $item['prices'];
        $pdf->SetFont('Courier', '', '10');
        $pdf->cell(7, 5, $no, 1, 0, 'C');
        $pdf->Cell(73, 5, $item['description'], 1, 0);
        $pdf->Cell(30, 5, number_format(($item['quantity'])), 1, 0, 'R');
        $pdf->Cell(47, 5, number_format(($item['prices'])), 1, 0, 'R');
        $pdf->Cell(32, 5, number_format($total), 1, 1, 'R');//end of line
        //Kalkulasi pajak dan harga
        $pajak += ($total * $tax);
        $harga += $total;
    }

    //Subtotal
    $pdf->SetFont('Courier', 'B', '12');
    $pdf->cell(157, 6, 'Subtotal', "L, T, R", 0, 'R');
    $pdf->SetFont('Courier', '', '12');
    $pdf->cell(32, 6, number_format($harga), 1, 1, 'R');

    //Pajak
    $pdf->SetFont('Courier', 'B', '12');
    $pdf->cell(157, 6, 'PPn', "L, B, R", 0, 'R');
    $pdf->SetFont('Courier', '', '12');
    $pdf->cell(32, 6, number_format($pajak), 1, 1, 'R');

    //Total
    $pdf->SetFont('Courier', 'B', '12');
    $pdf->cell(157, 10, 'Total Harga', 1, 0, 'R');
    $pdf->cell(32, 10, number_format($harga + $pajak), 1, 1, 'R');
}

$out = $ref.".pdf";
$pdf->Output($out, 'D');
?>