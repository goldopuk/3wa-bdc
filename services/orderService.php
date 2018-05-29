<?php


function getConnection() {
	$user = 'root';
	$password = 'troiswa';

	$db = new PDO(
		'mysql:host=localhost;dbname=classicmodels', 
		$user, 
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
	);

	$db->exec('SET NAMES UTF8');

	return $db;
}

function getOrderList()
{
	$db = getConnection();

	$sql = 'SELECT * FROM ordersss ORDER BY orderNumber DESC';

	$statement = $db->prepare($sql);

	$statement->execute();

	return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getOrderDetails($orderNumber) {

	$db = getConnection();

	$sql = "
		SELECT *, (quantityOrdered * priceEach) AS totalPrice
		FROM orderdetails 
		JOIN products ON products.productCode = orderdetails.productCode
		WHERE orderNumber = $orderNumber"
	;

	$statement = $db->prepare($sql);

	$statement->execute();

	return $statement->fetchAll(PDO::FETCH_ASSOC);
}


function getCustomerByOrder($orderNumber) {

	$db = getConnection();

	$sql = "
		SELECT customers.*
		FROM customers
		JOIN orders ON orders.customerNumber = customers.customerNumber
		WHERE orderNumber = $orderNumber";
	;

	$statement = $db->prepare($sql);

	$statement->execute();

	return $statement->fetch(PDO::FETCH_ASSOC);
}




function getTotalAmountHTForOrder($orderNumber) {

	$db = getConnection();

	$sql = "
		SELECT SUM(quantityOrdered * priceEach) AS total
		FROM orderdetails 
		WHERE orderNumber = $orderNumber"
	;

	$statement = $db->prepare($sql);

	$statement->execute();

	return $statement->fetchColumn();
}

function getTotalAmountTTCForOrder($orderNumber) {

	$db = getConnection();

	$sql = "
		SELECT SUM(quantityOrdered * priceEach) AS total
		FROM orderdetails 
		WHERE orderNumber = $orderNumber"
	;

	$statement = $db->prepare($sql);

	$statement->execute();

	return $statement->fetchAll(PDO::FETCH_ASSOC);
}