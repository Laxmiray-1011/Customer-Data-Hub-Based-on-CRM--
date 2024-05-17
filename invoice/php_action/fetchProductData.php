<?php 	

require_once 'core.php';

 $sql = "SELECT product_id, product_name FROM product WHERE status = 1 AND active = 1";
$result = $connect->query($sql);

//$data = $result->fetch_all();
//$data = $result->fetch_all() ();
//$data = $result->fetch_array();
//$data = $result->fetch_assoc();

 while ($data1 = $result->fetch_assoc()) {
	 //$data=array();
	// print_r($data);die('test');
    $data[] = $data1;
} 

//if($result->num_rows > 0) { 
// $data = $result->fetch_array();
//}

 
$connect->close();

echo json_encode($data);