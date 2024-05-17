<?php 	

require_once 'core.php';

//$orderId = $_POST['orderId'];
$orderId = 9;

$sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due FROM orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2]; 
$subTotal = $orderData[3];
$vat = $orderData[4];
$totalAmount = $orderData[5]; 
$discount = $orderData[6];
$grandTotal = $orderData[7];
$paid = $orderData[8];
$due = $orderData[9];

//print_r($orderData);die();

$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
	INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);
 $table = '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
   
 <style>
 @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  
  margin: 0 auto; 
  
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
  border: 2px solid buttonshadow;
  border-radius: 5px;
}

header {
  padding: 10px 20px;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
  padding: 0 20px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
 /*  border-collapse: collapse; */
  border-spacing: 0;
  margin-bottom: 20px;
}


table th {
/*  background: #eeeeee none repeat scroll 0 0;*/
    border-bottom: 1px solid buttonshadow;
    border-right: 1px solid #777;
    border-top: 1px solid #777;
    padding: 5px 20px;
    text-align: left;
}


table td {
    color: #777;
    padding: 10px 20px;
    text-align: left;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

/* table td {
  text-align: right;
} */

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

/* table .no {
  color: #000000;
 
  background: #eeeeee;
} */

table .desc {
  text-align: left;
}

/* table .unit {
  background: #eeeeee;
}
 */
table .qty {
}

/* table .total {
  background: #eeeeee;
  color: #000000;
} */

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  color: #777;
  border-bottom: none;
  font-size: 14px;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #000;
/*  font-size: 1.4em;*/
  font-weight: 600;
  /* border-top: 1px solid #57B223; */


}


/* border-bottom: 2px solid buttonshadow;   */
table tfoot tr:first-child td {
    border-top: 1px solid buttonshadow; 
    /* color: #57b223; */
/*    font-size: 1.4em;*/
}




table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 3em;
  margin-bottom: 50px;
  text-align:center;
    color: #777;
    font-size: 20px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
  font-size: 18px;
}
    


 </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
        <h2 class="name">Company Name</h2>
        <div>455 Foggy Heights, AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>

    </header>
    <main>     
	  
	   <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">'.$clientName.'</h2>
          <div class="address">'.$clientContact.'</div>
          <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE 3-2-1</h1>
          <div class="date">Date of Invoice:'.$orderDate.'</div>
          <div class="date">Due Date: 30/06/2014</div>
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
		
		$table .= '<tr>
            <td class="no">'.$x.'</td>
            <td class="desc">'.$row[4].' </td>
            <td class="unit">'.$row[1].'</td>
            <td class="qty">'.$row[2].'</td>
            <td class="total">'.$row[3].'</td>
          </tr>';
		  $x++;
		} 
		  
        $table .= '</tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2" style="text-align: right;">Sub Amount</td>
            <td>'.$subTotal.'</td>
          </tr>
		  
		  <tr>
            <td colspan="2"></td>
            <td colspan="2" style="text-align: right;">Total Amount</td>
            <td>'.$subTotal.'</td>
          </tr>
		  
		  <tr>
            <td colspan="2"></td>
            <td colspan="2" style="text-align: right;">Discount</td>
            <td>'.$discount.'</td>
          </tr>	  
		  
		  <tr>
            <td colspan="2"></td>
            <td colspan="2" style="text-align: right;">Paid Amount</td>
            <td>'.$paid.'</td>
          </tr>
		  
		  <tr>
            <td colspan="2"></td>
            <td colspan="2" style="text-align: right;">Due Amount</td>
            <td>'.$due.'</td>
          </tr>
		  
         
          <tr>
            <td colspan="2"></td>
            <td colspan="2" style="text-align: right;">Grand Total</td>
            <td>'.$grandTotal.'</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you !</div>
      
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>';

$connect->close();

echo $table;