<?php
include("../model/api-item.php") ;
include("cleaner.php");
session_start();
// Set up the JSON first
$data -> vendor = "1903299" ; // student number
$trans = "gl";
$ran =  mt_rand(100000, 999999);
$action = (string) $ran;
$data -> transaction = $trans . $action ; // string of length 8
$data -> amount = $_SESSION["basket_cost"] ; // amount less than 100
$check = strlen($_POST["card_num"]);
if ($check != 16) { // checks if card number is valid
    header('Location:../view/Checkout.php');
}
$data -> card = clean($_POST["card_num"]); // 16 digit number
$request = json_encode($data) ;

// echo $request ;

$url = "https://mayar.abertay.ac.uk/~g510572/aberpay/v3/" ;
$ch = curl_init() ;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($request)) );
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$item = json_decode($response) ;

if ($item -> status = 1) {
    echo "your payment has been made Have a good day";
    updateItemBought( $_SESSION["basket"]);
}else{
    echo "your payment failed try again later";
}

$order -> taction = $trans . $action;
$order -> total = $_SESSION["basket_cost"];
$order -> status = $item -> status;

createTransaction($order);


echo '<a href="../view/index.php" class="btn btn-primary">Back to main page</a>';
?>