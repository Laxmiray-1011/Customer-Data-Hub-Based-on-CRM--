<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$productName 		= $_POST['productName'];
  // $productImage 	= $_POST['productImage'];
  $quantity 			= $_POST['quantity'];
  $rate 					= $_POST['rate'];
  $brandName 			= $_POST['brandName'];
  $categoryName 	= $_POST['categoryName'];
  $productStatus 	= $_POST['productStatus'];
  $productCode = $_POST['productcode'];
  //$product_code = $_POST['productcode'];

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;


//print_r($_POST);die("rakesh"); 

/*
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {

*/

				
				$sql = "INSERT INTO product (product_code,product_name, product_image, brand_id, categories_id, quantity, rate, active, status) 
				VALUES ('$productCode','$productName','$url', '$brandName', '$categoryName', '$quantity', '$rate', '$productStatus', 1)";




				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
						//header("location: http://jaylaxmiauto.in/invoice/product.php");
					//Header('Location: '.$_SERVER['PHP_SELF']);
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}


	//die("rakesh"); 
				

		/*	}	else {
				return false;
			}		
		} 
	} */	
	

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POSTINSERT 
/*INTO product (product_code,product_name, product_image, brand_id, categories_id, quantity, rate, active, status) VALUES ('Product Code: ','Product Code: ','../assests/images/stock/280685dbebce152f20.png', '33', '30', '2', '323', '1', 1)*/
//location.reload(); 