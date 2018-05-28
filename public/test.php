<?php


function pre($thing) {
	echo "<pre>";
	print_r($thing);
	echo "</pre>";
} 

$user = 'root';
$password = 'troiswa';

$db = new PDO('mysql:host=localhost;dbname=classicmodels', $user, $password);
$db->exec('SET NAMES UTF8');


// get order
$orderId = $_GET['id'];
$sql = "SELECT * FROM orders WHERE orderNumber = $orderId";

$statement = $db->prepare($sql);
$statement->execute();
$order = $statement->fetch(\PDO::FETCH_ASSOC);

pre($order);

// get Customer
$customerId = $order['customerNumber'];

$sql = "SELECT * FROM customers WHERE custome	rNumber = $customerId";

$statement = $db->prepare($sql);
$statement->execute();
$customer = $statement->fetch(\PDO::FETCH_ASSOC);

pre($customer);

$sql = "SELECT * 
FROM orderdetails 
JOIN products ON products.productCode = orderdetails.productCode
WHERE orderNumber=$orderId";

