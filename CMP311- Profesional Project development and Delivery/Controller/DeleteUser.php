<?php
//  item11.php - create a new item using JSON-RPC
error_reporting(E_ALL);
include("cleaner.php"); 
//  set up the data to be inserted

$id = clean($_POST["UserID"]);

//  set up the request
$request = new stdClass();
$request -> jsonrpc = "2.0" ;
$request -> method = "deleteUserById" ;
$request -> params = $id ;
$request -> id = "510572" ;
$txt = json_encode($request) ;
echo $txt.'<br/><br/>' ;

//  set up for the curl
 $url = "https://mayar.abertay.ac.uk/~cmp311g22c04/simpleCP/Model/index.php";
//$url = "https:///mayar.abertay.ac.uk/~g510572/cmp306/jsonrpc/index.php" ;;
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
echo "fjewnf";

//  display the result of the call
echo $response ;	
echo '<a href="../View/Admin.php" class="btn btn-primary">Back to Admin page</a>';
?>