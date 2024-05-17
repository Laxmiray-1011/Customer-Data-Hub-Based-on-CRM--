<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

	$orderDate 						= date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName 					= $_POST['clientName'];
  $clientContact 				= $_POST['clientContact'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $vatValue 						=	$_POST['vatValue'];
  $totalAmountValue     = $_POST['totalAmountValue'];
  $discount 						= $_POST['discount'];
  $grandTotalValue 			= $_POST['grandTotalValue'];
  $paid 								= $_POST['paid'];
  $dueValue 						= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];

	

 $sql="SELECT * FROM course where course_id = '".$clientName."'";
$result = $connect->query($sql);
$data = $result->fetch_row();
/*
$sql="SELECT `order_id` FROM `orders` ORDER BY order_id DESC LIMIT 1";
$result = $connect->query($sql);
$billnumber = $result->fetch_row();
$billnumber_value = $billnumber[0];
$one = 1;
$billnumberup = 0;
$billnumberup = $billnumber_value + $one;
 */
$billdescription = "
	Sub Amount = '".$subTotalValue."'
	Total Amount = '".$totalAmountValue."'
	Discount = '".$discount."'
	Grand Total = '".$grandTotalValue."'
	Paid Amount = '".$paid."'
	Due Amount = '".$dueValue."'";



	$sql = "INSERT INTO orders (order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status, order_status) VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1)";
	
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	
		
		
		if($clientName == $data['0']){
	
	//order_id 	order_date 	client_name 	client_contact 	sub_total 	vat 	total_amount 	discount 	grand_total 	paid 	due 	payment_type 	payment_status 	order_status
	
	//11 			2017-10-05 	dhirajray 			9861106626 	2650.00 	0 		2650.00 			0 			2650.00 	1150 	1500 		2 					2 				1
	
	//`billerid`, `lastbilldue`, `billnumber`, `billamount`, `totalpayment`, `balancedue`, `billdescription`, 				`billdate`, 	`regdate`, 			`status`
		//367 		2000 		101 			5000 			3000 				testing bill prakash pradhan 			2017-10-06 	2017-10-06 11:49:34 	Active
	 	//367 		500 		102 			3000 			2500 				testing second prakash pradhan bill 	2017-10-07 	2017-10-06 11:50:41 	Active
	/* $billdescription = "
	Sub Amount = '".$subTotalValue."'
	Total Amount = '".$totalAmountValue."'
	Discount = '".$discount."'
	Grand Total = '".$grandTotalValue."'
	Paid Amount = '".$paid."'
	Due Amount = '".$dueValue."'"; */
	//mysql_escape_string($billdescription)
	
	//$billdescriptionup = mysql_real_escape_string($billdescription);
	$billdescription = "work in progress";
	
 $sql="INSERT INTO `payment`(`billerid`, `lastbilldue`, `billnumber`, `billamount`, `totalpayment`,`billdescription`, `billdate`, `regdate`, `status`) VALUES ('$clientName','$dueValue','$order_id','$grandTotalValue','$paid','$billdescription','$orderDate','$orderDate','Active')";
$connect->query($sql);
	
}

		$orderStatus = true;
	}

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

				$connect->query($orderItemSql);		

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);