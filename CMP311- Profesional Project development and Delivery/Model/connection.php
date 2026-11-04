<?php
function getDatabaseConnection() {
		//  Database connections 
		$servername = "lochnagar.abertay.ac.uk";
		$username = "sqlcmp311g22c04";
		$password = "v6CPsJsxbKor";
		$database = "sqlcmp311g22c04";
		$conn = mysqli_connect($servername,$username,$password,$database);
		// Check connection
		if (mysqli_connect_errno()) {
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		exit();
		}
		return $conn ;
		}
?>