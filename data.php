<?php
include('connection.php');

$name= $_GET['name'];
$filename= $_GET['file'];
$date = date("D M d, Y G:i");


$sqlget="SELECT * FROM registration WHERE NAME='".$name."'";
$sqldata= mysqli_query($dbcon, $sqlget) or die('ERROR!!');
while($row=mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
	//echo $row['NAME'].'<br/>';
require("fpdf/fpdf.php");
	
$pdf = new FPDF();
$pdf-> AddPage();
$image1 = "images/ictp-logo.png";

$pdf->Image('images/header.png',0,0,210,0);
$pdf->Image('images/footer.png',0,258,210,0);
//$pdf->Image('images/ieee3.png',30,10,0,0);

$pdf->SetFont("Arial","",12);
$pdf->Cell(40,50,  "",0,10,'L');


$pdf->SetFont("Arial","",12);
$pdf->Cell(40,8,  "Name:",0,0,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,8,  $row['NAME'],0,1,'L');



$pdf->SetFont("Arial","",12);
$pdf->Cell(40,8,  "Affiliation/ Institution:",0,0,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,8,  $row['AFF_INS'],0,1,'L');



$pdf->SetFont("Arial","",12);
$pdf->Cell(40,8,  "Type:",0,0,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,8,  $row['TYPE'],0,1,'L');

$pdf->SetFont("Arial","",12);
$pdf->Cell(40,8,  "Email:",0,0,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,8,  $row['EMAIL'],0,1,'L');

$pdf->SetFont("Arial","",12);
$pdf->Cell(40,8,  "Phone:",0,0,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,8,  $row['PHONE'],0,1,'L');

$pdf->SetFont("Arial","",12);
$pdf->Cell(40,8,  "Category:",0,0,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,8,  $row['CATEGORY'],0,1,'L');

$pdf->SetFont("Arial","",12);
$pdf->Cell(40,8,  "Paper ID:",0,0,'L');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,8,  $row['PAPERID'],0,1,'L');

$pdf->SetFont("Arial","",12);
$pdf->Cell(40,8,  "Uploaded file name:",0,0,'L');
$pdf->SetFont("Arial",'B',12);
$pdf->Cell(0,8, '"'.$filename.'"',0,1,'L');

$pdf->SetFont("Arial","",12);
$pdf->Cell(40,80,  "",0,10,'L');

$pdf->SetFont("Arial","",12);
$pdf->Cell(40,8,  "Please keep this page.",0,1,'L');
$pdf->Cell(40,8,  "Executed time: ". $date,0,1,'L');


$pdf-> output();

}
?>