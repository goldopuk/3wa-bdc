<?php

include '../bootstrap.php';

$orderNumber = $_GET['orderNumber'];

$totalHT = getTotalAmountHTForOrder($orderNumber);
$totalTTC = 1.2 * $totalHT;
$tvaAmount = 0.2 * $totalHT;

$orderDetails = getOrderDetails($orderNumber);

$customer = getCustomerByOrder($orderNumber);


include '../views/details.phtml';