<?php
//  Item15.php - delete an Item record using the JSON-RPC
error_reporting(E_ALL);
include("cleaner.php");
//  set up the Item top be deleted
$item = new stdClass() ;
$item -> name = clean($_POST["name"]);
$item -> sell = clean($_POST["sell"]);
$item -> buy = clean($_POST["buy"]);

//  set up the request
$request = new stdClass();
$request -> jsonrpc = "2.0" ;
$request -> method = "UpdateKeyPrices" ;
$request -> params = $item ;
$request -> id = "510572" ;
$txt = json_encode($request) ;
echo $txt.'<br/><br/>' ;

//  set up for the curl
// $url = "localhost/mayar.abertay.ac.uk/cmp306/jsonrpc/index.php" ;
$url = "https://mayar.abertay.ac.uk/~cmp311g22c04/simpleCP/Model/index.php";    
$ch = curl_init($url) ;
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
$headers = array (
	'Content-Type: application/json', 
	'Content-Length: ' . strlen($txt) ) ;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers) ;
curl_setopt($ch, CURLOPT_POSTFIELDS, $txt);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch) ;

//  display the result of the call
echo $response ;	
echo '<a href="../View/Admin.php" class="btn btn-primary">Back to Adimin page</a>';
?>