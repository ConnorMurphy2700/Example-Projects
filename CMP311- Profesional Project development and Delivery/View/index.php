<?php
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header('Cache-Control: post-check=0, pre-check=0', FALSE);
	header('Pragma: no-cache');
	session_start();
?>

<!Doctype html>

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

	<br/><!-- creating space -->

	<div class="row">
                <!-- Display items -->
                <?php
                	include("../Model/api.php") ;
					$keysText = getAllkeys() ;
					$keys = json_decode($keysText) ;
					for ($i=0 ; $i<sizeof($keys) ; $i++) {
						echo '<div class="col-lg-4 col-md-4 col-sm-4">' ;
						echo '<div class="card">' ;
						echo '<div class="card-header">' ;
						echo $keys[$i] -> GName ; // game name
						echo '</div>' ;
						echo '<div class="card-block">' ;
						//echo '<img class="img-fluid" src="../image/'.$keys[$i]->image.'" />' ;
						echo '<p>'.$keys[$i] -> GDescription.'</p>' ; // game description
						echo '<p>Purchase: '.$keys[$i] -> SPrice.' Credits</p>' ; // buy price
						echo '<p>Selling? We buy for: '.$keys[$i] -> BPrice.' Credits</p>' ; // sell price
						echo '</div>' ;
						echo '<div class="card-footer">' ;
						echo '<p>'.$keys[$i] -> SellerUN.'</p>' ; // seller name
						echo '<a href="product.php?ProdID='.$keys[$i] -> KeyValue.'" class="btn btn-primary" id="product">More Details</a>' ;
						echo '</div>' ;
						echo '</div>' ;
						echo '</div>' ;
					}

					if (isset($_SESSION['uid'])) {
					echo 'session found';
					}
				?>
	</div><!-- row -->

	<div id="footer" class="card text-center">
		<p>Tayside PC Gamers <br>
		info@taysidePCGamers.org <br><br>
		With help from Simple Coding Partners </p>
		<div class="cookie-banner2" >
			<table>
				<tr>
					<th>TPCG.COM PRIVACY POLICY </th>
				</tr>
				<tr>
					<td>If you sign up to use this website’s services, we may keep personal information about you. This will include your name, home address, email, and phone number.</td>
					<td><img src="../Image/Stamp.jpg" alt="A Wax Stamp" style="width:60px;height:60px;"></td>    
				</tr>
				<tr>
					<td>We would like to use your information to provide better services to you, and adverts from 3rd parties. Opt in here.</td>
					<td><img src="../Image/Timer.png" alt="An hour glass" style="width:60px;height:60px;"></td>    
				</tr>
				<tr>
					<td>We would like to collect all order information to help us to predict global trends. Opt in here</th>
				</tr>
				<tr>
					<td>If you have any questions or comments about this privacy policy, or the data collected, email gdpr@website.com</th>
				</tr>
				<tr>
					<td>Your data is stored safely and securely. If we do lose your data we will be fined by the Information Commissioner</th>
				</tr>
				<tr>
					<td>Order information is kept to meet legal requirements. Your personal Information will be deleted if you do not use this website for a Month</th>
				</tr>
			</table> 
		</div>
    </div>
</body>
</html>