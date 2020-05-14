<?php
//call the FPDF library

require('fpdf/fpdf.php');
include_once'connectdb.php';
$id=$_GET['id'];
$select=$pdo->prepare("select * from tbl_invoice where invoice_id=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_OBJ);


//create pdf object
$pdf = new FPDF('P','mm','A4');


//add new page
$pdf->AddPage();
//$pdf->SetFillColor(123,255,234);

//set font to arial, bold, 16pt
$pdf->SetFont('Arial','B',16);

//Cell(width , height , text , border , end line , [align] )
$pdf->SetFont('Arial','B',13);
$pdf->Cell(192,4,'JEDEL ENTERPRISES',0,1,'C');
$pdf->SetFont('Arial','',5);
$pdf->Cell(192,2,'Address : #99 Bisig II, Sandico St., Abangan Sur, Marilao, Bulacan, PH',0,1,'C');
$pdf->SetFont('Arial','',5);
$pdf->Cell(192,2,'Phone Number: 347-4567-2314',0,1,'C');
$pdf->SetFont('Arial','',5);
$pdf->Cell(192,2,'E-mail Address : xina.torres@gmail.com',0,1,'C');
$pdf->Cell(50,5,'',0,1,'');
//$pdf->Cell(80,5,'Website : www.jedenenterprises.com',0,1,'');

$pdf->SetFont('Arial','B',11);
$pdf->Cell(192,5,'INVOICE',0,1,'C');
$pdf->Cell(50,5,'',0,1,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(96,5,'Invoice : '.$row->invoice_id,0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(96,5,'Date : '.$row->order_date,0,1,'L');




//Line(x1,y1,x2,y2);

$pdf->Line(5,50,205,50);
$pdf->Line(5,51,205,51);

$pdf->Ln(10); // line break


$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,8,'Bill To :',0,0,'');


$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,8,$row->customer_name,0,1,'');

$pdf->Cell(50,5,'',0,1,'');



$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(208,208,208);
$pdf->Cell(100,5,'PRODUCT',1,0,'C',true);   //190
$pdf->Cell(20,5,'QTY',1,0,'C',true);
$pdf->Cell(30,5,'PRICE',1,0,'C',true);
$pdf->Cell(40,5,'TOTAL',1,1,'C',true);


$select=$pdo->prepare("select * from tbl_invoice_details where invoice_id=$id");
$select->execute();

while($item=$select->fetch(PDO::FETCH_OBJ)){
  $pdf->SetFont('Arial','B',8);
$pdf->Cell(100,5,$item->product_name,1,0,'L');   
$pdf->Cell(20,5,$item->qty,1,0,'C');
//$pdf->Cell(30,8,'PHP '.number_format($item->price, 2, '.', ''),1,0,'R');
$pdf->Cell(5, 5, ' PHP ', 'L,B', 0, 'L');
$pdf->Cell(25, 5, number_format($item->price, 2, '.', ', '), 'R,B', 0, 'R');
//$pdf->Cell(40,8,'PHP '.number_format($item->price*$item->qty, 2, '.', ''),1,1,'R');
$pdf->Cell(5, 5, ' PHP ', 'L,B', 0, 'L');
$pdf->Cell(35, 5, number_format($item->price*$item->qty, 2, '.', ', '), 'R,B', 1, 'R');

    
}







$pdf->SetFont('Arial','B',8);
$pdf->Cell(100,5,'',0,0,'L');   //190
$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(30,5,'SubTotal',1,0,'C',true);
$pdf->Cell(5, 5, ' PHP ', 'L,B', 0, 'L');
$pdf->Cell(35, 5, number_format($row->subtotal, 2, '.', ', '), 'R,B', 1, 'R');




$pdf->SetFont('Arial','B',8);
$pdf->Cell(100,5,'',0,0,'L');   //190
$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(30,5,'Tax',1,0,'C',true);
$pdf->Cell(5, 5, ' PHP ', 'L,B', 0, 'L');
$pdf->Cell(35, 5, number_format($row->tax, 2, '.', ', '), 'R,B', 1, 'R');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(100,5,'',0,0,'L');   //190
$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(30,5,'Discount',1,0,'C',true);
//$pdf->Cell(40,8,'PHP '.number_format($row->discount, 2, '.', ''),1,1,'R');
$pdf->Cell(5, 5, ' PHP ', 'L,B', 0, 'L');
$pdf->Cell(35, 5, number_format($row->discount, 2, '.', ', '), 'R,B', 1, 'R');
//$pdf->SetFont('Arial','B',14);
$pdf->Cell(100,5,'',0,0,'L');   //190
$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(30,5,'Grand Total',1,0,'C',true);
//$pdf->Cell(40,8,'PHP '.number_format($row->total, 2, '.', ''),1,1,'R');
$pdf->Cell(5, 5, ' PHP ', 'L,B', 0, 'L');
$pdf->Cell(35, 5, number_format($row->total, 2, '.', ', '), 'R,B', 1, 'R');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(100,5,'',0,0,'L');   //190
$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(30,5,'Paid',1,0,'C',true);
//$pdf->Cell(40,8,'PHP '.number_format($row->paid, 2, '.', ''),1,1,'R');
$pdf->Cell(5, 5, ' PHP ', 'L,B', 0, 'L');
$pdf->Cell(35, 5, number_format($row->paid, 2, '.', ', '), 'R,B', 1, 'R');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(100,5,'',0,0,'L');   //190
$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(30,5,'Due',1,0,'C',true);
//$pdf->Cell(40,8,'PHP '.number_format($row->due, 2, '.', ''),1,1,'R');
$pdf->Cell(5, 5, ' PHP ', 'L,B', 0, 'L');
$pdf->Cell(35, 5, number_format($row->due, 2, '.', ', '), 'R,B', 1, 'R');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(100,5,'',0,0,'L');   //190
$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(30,5,'Payment Type',1,0,'C',true);
$pdf->Cell(40,5,$row->payment_type,1,1,'C');


$pdf->Cell(50,10,'',0,1,'');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(32,10,'Important Notice :',0,0,'',true);


$pdf->SetFont('Arial','',8);
$pdf->Cell(148,8,'No item will be replaced or refunded if you dont have the invoice with you. You can refund within 2 days of purchase.',0,0,'');
//output the result
$pdf->Output();
?>
