<?php
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header('Cache-Control: post-check=0, pre-check=0', FALSE);
	header('Pragma: no-cache');
?>
<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

    	<!-- Bootstrap CSS -->
   	 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- local CSS -->
		<link rel="stylesheet" href="tools.css?v=2.0" />
		
    	<title>CMP306 - Web Services Development</title>
	</head> 
        
	<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		    <div class="container-fluid">
  		
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
    	
    	      <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="Register.php">Register</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="Login.php">Log In</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="../controller/logout.php">Log out</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="Admin.php">Admin</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="payment_gateway_report.php">Payment Gateway Report</a>
					</li>
					<li class="nav-item">
					<?php
						session_start();
                        if (!isset($_SESSION["uid"])) {
							header('Location: index.php');
						}
						if (!isset($_SESSION["basket"])) {
							header('Location: product.php?ProdID='.$_SESSION["prod"].'');
						}


						if (isset($_SESSION['uid'])) {
							echo '<p>'.$_SESSION['uid'].'is logged in</p>' ;

						}
						else {
							echo '<p>No one is logged in</p>' ;
						}
					?>
					</li>

				</ul>
               </div>
         </nav>
        </div>



	    <!-- overall container for page -->
	    <div class="container">
	    
	    	<!-- header row -->
    		<div id="header" class="card text-center">
    			<img src="../image/title01.jpg" />
    			<div class="card-img-overlay">
            		<h1 class="card-title">CMP306 Web Services Development - 2022-23</h1>
            		<h2 class="card-title">Connor Murphy -- 1903299</h2>
            		<h3>This site if part of a student assessment - All images are copyright B&Q (diy.co.uk)</h3>
        		</div>
    		   <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="card">
               <div class="card-header">
                <h1>your basket includes</h1>
               </div>
               <?php
                    echo '<p style="color:black;">your current basket contains product  ' . $_SESSION["basket_item"] .' </p>';
					echo '<br>';
					echo '<p style="color:black;">the total price is '. $_SESSION["basket_cost"] .'</p>' ;   
                ?>
              </div>  
					</div>
                <!-- enter payment details -->
             <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="card">
               <div class="card-header">
                <h1>Please enter your card Details </h1>
               </div>
               <form action="../controller/pay.php" method="post">
               <input type="string" class="form-control" id="card_num" placeholder="cardnumber" name="card_num" required>
               <input type="string" class="form-control" id="epdate" placeholder="Expiry Date" name="epdate" required>
               <input type="password" class="form-control" id="csc" placeholder="csc" name="csc" required>
                <input type="submit">   
				</form>     
              </div>  
                </div>  
           
        </div><!-- container -->
        
    <!-- Bootstrap Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</body>
</html>