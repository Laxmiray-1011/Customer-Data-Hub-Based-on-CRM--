<?php
ini_set ('display_errors', 'on');
 ini_set ('log_errors', 'on');
 ini_set ('display_startup_errors', 'on');
 ini_set ('error_reporting', E_ALL);
 require_once 'core.php';
/* include autoloader */
require_once 'dompdf/autoload.inc.php';
//set order id here
$orderId = $_GET['orderId'];
$sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due FROM orders WHERE order_id = $orderId";
$orderResult = $connect->query($sql); 
$orderData = $orderResult->fetch_array();
$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2]; 

$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
	INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql); 

/*  reference the Dompdf namespace */
use Dompdf\Dompdf;
/* instantiate and use the dompdf class */
$dompdf = new Dompdf();
//<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
$Sub_Amount =  $orderData['sub_total'];
$Total_Amount = $orderData['total_amount'];
$Discount = $orderData['discount'];
$Grand_Total = $orderData['grand_total'];
$Paid_Amount = $orderData['paid'];
$Due_Amount = $orderData['due'];
//$Payment_Type = $orderData[''];
//$Payment_Status = $orderData[''];


$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Example 2</title>
	<link rel="stylesheet" href="dompdf/mypdf.css">
</head>

<body>
	<header class="clearfix">
		<div id="logo">
			<img src="logo2.png">
		</div>
		<div id="company">
			<h2 class="name">Jay Laxmi Auto</h2>
			<div>Godbhaga Camp Bargarh</div>
			<div>9861106626</div>
			<div><a href="mailto:jaylaxmiauto@gmail.com">jaylaxmiauto@gmail.com</a>
			</div>
		</div>
	</header>
	<main> 
		<div id="details" class="clearfix">
			<div id="client">
				<div class="to">INVOICE TO:</div>
				<h2 class="name">'.$clientName.'</h2>
				<div class="address">'.$clientContact.'</div>
				<div class="email"><a href="mailto:john@example.com">john@example.com</a>
				</div>
			</div>
			<div id="invoice">
				<h1>INVOICE 3-2-1</h1>
				<div class="date">Date of Invoice: '.$orderDate.'</div>
				<div class="date">Due Date: '.$orderDate.'</div>
			</div>
		</div>
		<table border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th class="no">SLNO</th>
					<th class="desc" width="50%">PRODUCT</th>
					<th class="unit">UNIT PRICE</th>
					<th class="qty">QUANTITY</th>
					<th class="total">TOTAL</th>
				</tr>
			</thead>
			<tbody>';
				$x = 1;
				while($row = $orderItemResult->fetch_array()) {
					$html .= '<tr>
						<td class="no">'.$x.'</th>
						<td class="desc">'.$row[4].'</td>
						<td class="unit">'.$row[1].'</td>
						<td class="qty">'.$row[2].'</td>
						<td class="total">'.$row[3].'</td>
					</tr>';
				$x++;
				}		
			$html .='</tbody>			
				<tr>
					<td colspan="2"></td>
					<td colspan="2" style="text-align: right;">SUB AMOUNT</td>
					<td>'.$Sub_Amount.'</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2" style="text-align: right;">TOTAL AMOUNT</td>
					<td>'.$Total_Amount.'</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2" style="text-align: right;">DISCOUNT</td>
					<td>'.$Discount.'</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2" style="text-align: right;">PAID AMOUNT</td>
					<td>'.$Paid_Amount.'</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2" style="text-align: right;">DUE AMOUNT</td>
					<td>'.$Due_Amount.'</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2" style="text-align: right;">GRAND TOTAL</td>
					<td>'.$Grand_Total.'</td>
				</tr>			
		</table>
		<div id="thanks">Thank you</div>
	</main>
	<footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
</body>
</html>
';

//echo $html;

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream();


 /*
 Render the HTML as PDF */

/* Output the generated PDF to Browser */


?>