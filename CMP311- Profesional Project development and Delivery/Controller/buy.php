<?php
include("../Model/api.php") ;
include("cleaner.php");
//  set up the Item top be deleted
$key  =  $_GET["ItemID"];

//  set up the request
$request = new stdClass();
$request -> jsonrpc = "2.0" ;
$request -> method = "deleteKeyById" ;
$request -> params = $key ;
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



echo '<p>here is your New Game Key:'.$key.' </p>';
echo '<a href="../View/index.php" class="btn btn-primary">Back to main page</a>';
?>