<?php
//  managing the Item table with JSON-RPC
include("api.php") ; // contains the CRUD procedures
include("library.php") ;  //  general methods for JSON-TPC error checking

// read the contents of the POST data and convert this to JSON
$body = file_get_contents('php://input') ;
$request = json_decode($body);

//  check the POST data is in JSON format
if ($request == null) {
	$response = new stdClass();
	$response -> jsonrpc = "2.0" ;
	$response -> error -> code = -32700 ;
	$response -> error  -> message = "Parse Error" ;
	$response -> id = null ;
}
//  check the JSON is a valid request object
else if (!jsonRpcFormatCheck($request)){
	$response = new stdClass();
	$response -> jsonrpc = "2.0" ;
	$response -> error -> code = -32600 ;
	$response -> error  -> message = "Invalid Request" ;
	$response -> id = $request -> id ;
}
// There are other checks that can be included here
// Check for the correct methods
// Check for the correct parameters
else {
	// the data passed to the API is in valid JSON-API format
	
	$method = $request -> method ;
	$params = $request -> params ;
	$response = new stdClass();
	$response -> jsonrpc = "2.0" ;
	$response-> id = $request -> id ;
	switch ($method) {
		case "getAllKeys":
			$resjson = getAllKeys() ; 
       		$resobj = json_decode($resjson) ;
       		$response -> result = $resobj ;
        	break;
    	case "getKeyByID":
       		$resjson = getKeyByID($params) ;
       		$resobj = json_decode($resjson) ;
       		$response -> result = $resobj ;
        	break;
		case "getKeyByUser":
			$resjson = getKeyByUser($params) ;
			$resobj = json_decode($resjson) ;
			$response -> result = $resobj ;
			 break;
    	case "createKey":
        	$txt = json_encode($params) ;
        	$response -> result =  createKey($txt) ; 
        	break;
        case "usersellKey":
        	$txt = json_encode($params) ;
        	$response -> result =  usersellKey($txt) ; 
        	break;
    	case "deleteKeyById": 
        	$response -> result = deleteKeyById($params) ;
        	break;
    	case "UpdateKeyProcess":
    		$txt = json_encode($params) ;
        	$response -> result = UpdateKeyProcess($txt) ;
       		break;
		case "UpdateKeyPrices":
			$txt = json_encode($params) ;
			$response -> result = UpdateKeyPrices($txt) ;
			  break;
        case "getSellPriceByName":
              $resjson = getSellPriceByName($params) ;
              $resobj = json_decode($resjson) ;
              $response -> result = $resobj ;
               break;       
        case "getBuyPriceByName":
           $resjson = getBuyPriceByName($params) ;
           $resobj = json_decode($resjson) ;
           $response -> result = $resobj ;
           break; 
        case "getProcessById":
            $resjson = getProcessById($params) ;
            $resobj = json_decode($resjson) ;
            $response -> result = $resobj ;
            break; 


		case "createUser":
			$txt = json_encode($params) ;
			$response -> result = createUser($txt) ; 
			break;
        case "deleteUserById":
			$txt = json_encode($params) ;
			$response -> result = deleteUserById($txt) ;
		    break;
		case "getUserById":
			$resjson = getUserById($params) ;
			$resobj = json_decode($resjson) ;
			$response -> result = $resobj ;
		    break;

        case "getAllUsers":
            $resjson = getUserById($params) ;
            $resobj = json_decode($resjson) ;
            $response -> result = $resobj ;
            break;
            case "UpdateUserCreditBuy":
                $txt = json_encode($params) ;
                $response -> result = UpdateUserCreditBuy($txt) ;
                break;
                case "UpdateUserCreditSell":
                    $txt = json_encode($params) ;
                    $response -> result = UpdateUserCreditSell($txt) ;
                    break;    
		default:
    		// method not found
        	$response -> error -> code = -32601 ;
        	$response -> error -> message = "Method not found" ;
        	break ;
	} 
}
echo json_encode($response)  ; 
?>