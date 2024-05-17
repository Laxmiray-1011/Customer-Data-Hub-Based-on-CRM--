<?php
$localhost = "182.50.133.86";
$username = "jaylaxmiauto";
$password = "jaylaxmiauto@123456";
$dbname = "account";
//$dbname = "account";
/* 'hostname' => '148.72.232.177',
	'username' => 'jaylaxmiauto',
	'password' => 'jaylaxmiauto@123456',
	'database' => 'account',
	'dbdriver' => 'mysqli', */
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>