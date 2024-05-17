<?php 

require_once 'php_action/core.php';

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

//header('location: http://localhost/stock/index.php');
header('location: http://jaylaxmiauto.in/invoice/dashboard.php');	


?>