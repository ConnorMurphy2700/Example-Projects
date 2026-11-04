<?php
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header('Cache-Control: post-check=0, pre-check=0', FALSE);
	header('Pragma: no-cache');
	session_start();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- The site uses Bootstrap v5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="../css.css">
</head>
<body>
	<div id="header" class="card text-center">
        <img src="../Image/banner_image2.jpg" />
        <div class="card-img-overlay">
            <h1 class="card-title">CMP311 Professional Project Development and Delivery - 2022-23</h1>
            <h2 class="card-title">Tayside PC Gamers - Comp4</h2>
        </div>
    </div>
	<nav>
		<ul>
			<?php
				if (isset($_SESSION['uid'])) {
					echo '<li><a href="index.php">Home</a></li>';
					echo '<li><a href="aboutus.php">About us</a></li>';
					echo '<li><a href="user.php">Your Donations</a></li>';
					echo '<li><a href="../Controller/logout.php">Log Out</a></li>';
				}
				else {
					echo '<li><a href="index.php">Home</a></li>';
					echo '<li><a href="aboutus.php">About us</a></li>';
					echo '<li><a href="login.php">Log in</a></li>';
					echo '<li><a href="signup.php">Sign up</a></li>';
				}

			?>
		</ul>
	<nav>
    		
    		<br/><!-- simple but effective way to get some space -->

            <div class="row">
                <!-- Display items -->
                <?php
                	include("../Model/api.php") ;
                    $search =  $_GET["ProdID"];
					$itemtxt = getKeyByID($search) ;
					$item = json_decode($itemtxt) ;
					echo '<div class="col-lg-4 col-md-4 col-sm-4">' ;
					echo '<div class="card">' ;
					echo '<div class="card-header">' ;
					echo $item -> GName ; 
					echo '</div>' ;
					echo '<div class="card-block">' ;
					echo '<p>'.$item -> GDescription.'</p>' ; 
					echo '<p>Purchase: '.$item -> SPrice.' Credits</p>' ; 
					echo '<p>Selling? We buy for: '.$item -> BPrice.' Credits</p>' ; 
					echo '</div>' ;
					echo '<a href="../index.php" class="btn btn-primary">Back to main page</a>' ;
					if (isset($_SESSION['uid'])) {
						echo'<a href="../Controller/buy.php?&ItemID='.$item -> KeyValue .'" class="btn btn-primary">BUY KEY</a>';
					}else{echo'<p>Please Login to add items to the Basket and proceed to Checkout.</p>';}
					
   					echo '</div>' ;     
				?>
			</div><!-- row -->    


        </div><!-- container -->
        
    <!-- Bootstrap Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</body>
</html>
   