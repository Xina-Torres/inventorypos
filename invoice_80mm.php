<?php
//call the FPDF library
require('fpdf/fpdf.php');
include_once'connectdb.php';


$id=$_GET['id'];
$select=$pdo->prepare("select * from tbl_invoice where invoice_id=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_OBJ);



//create pdf object
$pdf = new FPDF('P','mm',array(80,200));

//add new page
$pdf->AddPage();

//set font to arial, bold, 16pt
$pdf->SetFont('Arial','B',8);
//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(60,3,'JEDEL ENTEPRISES',0,1,'C');

$pdf->SetFont('Arial','B',4.5);

$pdf->Cell(60,1.5,'#99, Bisig II, Abangan Sur, Marilao, Bulacan, Philippines',0,1,'C');
$pdf->Cell(60,1.5,'Phone Number: 347-4567-2314',0,1,'C');
$pdf->Cell(60,1.5,'E-mail Address : xina.torres@gmail.com',0,1,'C');
$pdf->Cell(50,2,'',0,1,'');

//Line(x1,y1,x2,y2);

//$pdf->Line(7,,72,38);
//$pdf->Ln(1); // line 

$pdf->SetFont('Arial','B',5);
$pdf->Cell(60,3,'INVOICE',0,1,'C');
$pdf->Cell(50,2,'',0,1,'');

$pdf->SetFont('Arial','B',5);
$pdf->Cell(10,2,'Bill To :',0,0,'');
$pdf->SetFont('Arial','',5);
$pdf->Cell(40,2,$row->customer_name,0,1,'');


$pdf->SetFont('Arial','B',5);
$pdf->Cell(10,2,'Invoice no :',0,0,'');
$pdf->SetFont('Arial','',5);
$pdf->Cell(40,2,$row->invoice_id,0,1,'');



$pdf->SetFont('Arial','B',5);
$pdf->Cell(10,2,'Date :',0,0,'');
$pdf->SetFont('Arial','',5);
$pdf->Cell(40,2,$row->order_date,0,1,'');
$pdf->Cell(50,5,'',0,1,'');


/////////


$pdf->SetX(7);
$pdf->SetFont('Courier','B',6);

$pdf->Cell(36,3,'PRODUCT',1,0,'C');   //70
$pdf->Cell(6,3,'QTY',1,0,'C');
$pdf->Cell(11,3,'PRC',1,0,'C');
$pdf->Cell(12,3,'TOTAL',1,1,'C');


$select=$pdo->prepare("select * from tbl_invoice_details where invoice_id=$id");
$select->execute();

while($item=$select->fetch(PDO::FETCH_OBJ)){
    $pdf->SetX(7);
  $pdf->SetFont('Helvetica','',4.5);
$pdf->Cell(36,2.5,$item->product_name,1,0,'L');   
$pdf->Cell(6,2.5,$item->qty,1,0,'C');
$pdf->Cell(11,2.5,$item->price,1,0,'C');
$pdf->Cell(12,2.5,number_format($item->price*$item->qty, 2, '.', ', '),1,1,'R');  
    
}




/////////




$pdf->SetX(7);
$pdf->SetFont('courier','B',5);
$pdf->Cell(20,3,'',0,0,'L');   //190
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,2.5,'SUBTOTAL',1,0,'C');
$pdf->SetFont('Helvetica','',4.5);
$pdf->Cell(20,2.5,number_format($row->subtotal, 2, '.', ', '),1,1,'R');


$pdf->SetX(7);
$pdf->SetFont('courier','B',5);
$pdf->Cell(20,3,'',0,0,'L');   //190
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,2.5,'TAX(12%)',1,0,'C');
$pdf->SetFont('Helvetica','',4.5);
$pdf->Cell(20,2.5,number_format($row->tax, 2, '.', ', '),1,1,'R');

$pdf->SetX(7);
$pdf->SetFont('courier','B',5);
$pdf->Cell(20,3,'',0,0,'L');   //190
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,2.5,'DISCOUNT',1,0,'C');
$pdf->SetFont('Helvetica','',4.5);
$pdf->Cell(20,2.5,number_format($row->discount, 2, '.', ', '),1,1,'R');


$pdf->SetX(7);
$pdf->SetFont('courier','B',5);
$pdf->Cell(20,3,'',0,0,'L');   //190
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,2.5,'GRAND TOTAL',1,0,'C');
  $pdf->SetFont('Helvetica','',4.5);
$pdf->Cell(20,2.5,number_format($row->total, 2, '.', ', '),1,1,'R');


$pdf->SetX(7);
$pdf->SetFont('courier','B',5);
$pdf->Cell(20,3,'',0,0,'L');   //190
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,2.5,'PAID',1,0,'C');
$pdf->SetFont('Helvetica','',4.5);
$pdf->Cell(20,2.5,number_format($row->paid, 2, '.', ', '),1,1,'R');


$pdf->SetX(7);
$pdf->SetFont('courier','B',5);
$pdf->Cell(20,3,'',0,0,'L');   //190
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,2.5,'DUE',1,0,'C');
$pdf->SetFont('Helvetica','',4.5);
$pdf->Cell(20,2.5,number_format($row->due, 2, '.', ', '),1,1,'R');


$pdf->SetX(7);
$pdf->SetFont('courier','B',5);
$pdf->Cell(20,3,'',0,0,'L');   //190
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,2.5,'PAYMENT TYPE',1,0,'C');
$pdf->SetFont('Helvetica','',4.5);
$pdf->Cell(20,2.5,$row->payment_type,1,1,'C');



$pdf->Cell(20,2,'',0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Courier','B',5);
$pdf->Cell(25,3,'Important Notice :',0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Arial','',5);
$pdf->Cell(75,3,'No item will be replaced or refunded if you dont have the invoice with you. ',0,2,'');

$pdf->SetX(7);
$pdf->SetFont('Arial','',5);
$pdf->Cell(75,3,'You can refund within 2 days of purchase. ',0,1,'');




$pdf->Output();
?>
