<?php

	include("connection.php");
	$conn =  getDatabaseConnection();
		

	//  function to create an item
	function createKey($txt) {
		global $conn ;
		$item = json_decode($txt) ;
		$stmt = $conn->prepare("insert into Game_Keys(KeyValue, SPrice, BPrice, GName, GDescription, SellerUN) values (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("siisss", $Key, $sell, $buy, $name, $des, $SellerUN);
		$Key = $item -> Key ;  
		$sell = $item -> sell ;
		$buy = $item -> buy ; 
		$name = $item -> name ;
		$des = $item -> des ;
		$SellerUN = $item -> SellerUN ;		
		$result = $stmt->execute();
		if (!$result) {$result = 0 ;}
		return $result ;
	}

	function usersellKey($txt) {
		global $conn ;
		$item = json_decode($txt) ;
		$stmt = $conn->prepare("insert into Game_Keys(KeyValue, GName, GDescription, SellerUN) values (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $Key, $name, $des, $SellerUN);
		$Key = $item -> Key ;   
		$name = $item -> name ;
		$des = $item -> des ;
		$SellerUN = $item -> SellerUN ;		
		$result = $stmt->execute();
		if (!$result) {$result = 0 ;}
		return $result ;
	}
	
	function getAllKeys()
	{
		global $conn ;
		$sql = "SELECT * FROM Game_Keys ORDER BY GName ASC";
		$result = mysqli_query($conn, $sql);
		//  convert to JSON
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows);
	}

	function getAllKeysByName($id)
	{
		global $conn ;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM Game_Keys where GName = ?";
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
	}

	function getKeyByID($id)
	{
		global $conn ;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM Game_Keys where KeyValue = ?";
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result) ;  //there is only 1 row
		return json_encode($row);
	}

	function getKeyByUser($id)
	{
		global $conn ;
		$sql = "SELECT * FROM Game_Keys WHERE SellerUN = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		$result = mysqli_stmt_execute($stmt);
		if (!$result) {$result = 0 ;}
		return $result ;
	}




	function deleteKeyById($id)
	{
		global $conn ;
		$sql = "DELETE from Game_Keys where KeyValue = ?" ;
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		$result = mysqli_stmt_execute($stmt);
		if (!$result) {$result = 0 ;}
		return $result ;
	}

	
    //update prosessing
	function UpdateKeyProcess($txt) {
		// $txt must contain the data for all fields.
		global $conn ;
		$item = json_decode($txt) ;
		$stmt = $conn->prepare("update Game_Keys SET Processing = ? where KeyValue=? ");
		$stmt->bind_param("is", $active, $id);
		$id = $item -> id;
		$active= $item -> active;
		$result = $stmt->execute();
		if (!$result) {$result = 0 ;}
		return $result ;
	} 
	//update prices
	function UpdateKeyPrices($txt) {
		// $txt must contain the data for all fields.
		global $conn ;
		$item = json_decode($txt) ;
		$stmt = $conn->prepare("update Game_Keys SET SPrice = ?, BPrice = ? where GName=? ");
		$stmt->bind_param("iis", $sell, $buy, $name);
		$name = $item -> name;
		$sell = $item -> sell ;
		$buy = $item -> buy ;
		$result = $stmt->execute();
		if (!$result) {$result = 0 ;}
		return $result ;
	} 
	
	//get sell price
	function getSellPriceByName($id)
	{
		global $conn ;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT SPrice FROM users WHERE GName= ? LIMIT 1" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result) ;  //there is only 1 row
		return json_encode($row);
	}

	//get buy price 
	function getBuyPriceByName($id)
	{
		global $conn ;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT BPrice FROM users WHERE GName= ? LIMIT 1" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result) ;  //there is only 1 row
		return json_encode($row);
	}

	//get process
	function getProcessById($id)
	{
		global $conn ;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT Processing FROM users WHERE GName= ? LIMIT 1" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result) ;  //there is only 1 row
		return json_encode($row);
	}




	

	//  function to update an item
	function UpdateUserCreditSell($txt) {
		// $txt must contain the data for all fields.
		global $conn ;
		$item = json_decode($txt) ;
		$stmt = $conn->prepare("update users SET Credit = Credit + ? where username=? ");
		$stmt->bind_param("is", $credit, $id);
		$id = $item -> id;
		$credit = $item -> credit ;
		$result = $stmt->execute();
		if (!$result) {$result = 0 ;}
		return $result ;
	}

	function UpdateUserCreditBuy($txt) {
		// $txt must contain the data for all fields.
		global $conn ;
		$item = json_decode($txt) ;
		$stmt = $conn->prepare("update users SET Credit = Credit - ? where username=? ");
		$stmt->bind_param("is", $credit, $id);
		$id = $item -> id;
		$credit = $item -> credit ;
		$result = $stmt->execute();
		if (!$result) {$result = 0 ;}
		return $result ;
	}
	
	//  function to delete a single user
	function deleteUserById($id)
	{
		global $conn;
		$sql = "DELETE from users where username = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		$result = mysqli_stmt_execute($stmt);
		if (!$result) {$result = 0 ;}
		return $result ;
	}

	function createUser($txt) {
		global $conn ;
        $item = json_decode($txt);

		$stmt = mysqli_stmt_init($conn);
		$sql = "INSERT INTO users (username, Password1, email, Phone_Num) VALUES (?, ?, ?, ?)";
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 'sssi', $name, $pwdhsh,  $email, $mphone);
		
		$name = $item -> Uname;		
		$email = $item -> email;
		$mphone = $item -> mphone;
		$pwd = $item -> pwd;
		$pwdhsh = password_hash($pwd, PASSWORD_DEFAULT);
		$result = mysqli_stmt_execute($stmt);
		return $result ;
	}

	function getUserById($id)
	{
		global $conn ;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM users WHERE username = ? LIMIT 1" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result) ;  //there is only 1 row
		return json_encode($row);
	}

	function getAllUsers()
	{
		global $conn ;
		$sql = "SELECT * FROM users";
		$result = mysqli_query($conn, $sql);
		//  convert to JSON
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows);
	}
	
?>

