<?php
//  user11.php - create a new user using JSON-RPC
error_reporting(E_ALL);
include("cleaner.php");
// get data from form 
$uname = clean($_POST["uname"]);
$email = clean($_POST["email"]);
$mphone = clean($_POST["mphone"]);
$pswd = clean($_POST["pswd"]);

//set up the data to be inserted
$item = new stdClass();
$item -> Uname = $uname;
$item -> email = $email;
$item -> mphone = $mphone;
$item -> pwd = $pswd;

//set up request 
$request = new stdClass();
$request -> jsonrpc = "2.0" ;
$request -> method = "createUser";
$request -> params = $item;
$request -> id = "510572" ;
$txt = json_encode($request) ;

//  set up for the curl    
$url = "https://mayar.abertay.ac.uk/~1903299/cmp306/coursework/Block1/model/index.php" ;
$ch = curl_init($url) ;
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
$headers = array (
	'Content-Type: application/json', 
	'Content-Length: ' . strlen($txt) ) ;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers) ;
curl_setopt($ch, CURLOPT_POSTFIELDS, $txt);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
//var_dump($response);

echo "The response is ". $response;

//curl_close($ch) ;
//if ($response) {
//      echo "Registration Succsessful. Enjoy your day.";
//      header("Location: ../View/index.php");
  
//}else {
//       echo "Registration failed try again.";
  //    header("Location: ../View/signup.php");
 // }
?>