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
			<h2 class="card-title">About Us</h2>
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
	    <!-- overall container for page -->
	    <div class="container">
   			<div class="row">
                <!-- Display items -->
                <?php
                	include("../Model/api.php") ;
					$itemtxt = getAllKeys();
					$item = json_decode($itemtxt) ;
					for ($i=0 ; $i<sizeof($item) ; $i++) {
						echo '<div class="col-lg-4 col-md-4 col-sm-4">' ;
						echo '<div class="card">' ;
						echo $item[$i] -> GName ;
						echo '<div class="card-block">' ;
						echo '<p>Buy Price '.$item[$i] -> BPrice.'</p>' ; 
						echo '<p>Sell Price '.$item[$i] -> SPrice.'</p>' ; 
						echo '<p>Seller'.$item[$i] -> SellerUN.'</p>' ;
                        echo '<p>Key'.$item[$i] -> KeyValue.'</p>' ;
						echo '</div>' ;
						echo '</div>' ;
						echo '</div>' ;
					}
				?>
			</div><!-- row -->	
    		<br/><!-- simple but effective way to get some space -->

            <div class="row">
                <!-- create a new Key -->
             <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="card">
               <div class="card-header">
                <h1>Create new Key</h1>
               </div>
               <form action="../Controller/CreateItem.php" method="post">
                Key: <input type="text" name="Key"><br>
                Sell Price: <input type="int" name="sell"><br>
                Buy Price: <input type="int" name="buy"><br>
                Game Name: <input type="text" name="name"><br>
                Game Des: <input type="text" name="description"><br>
                <input type="submit">   
				</form>     
              </div>  
                </div>  
              <!-- delete a key -->
              <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="card">
               <div class="card-header">
                <h1>Delete Key</h1>
               </div>
               <form action="../Controller/DeleteKey.php" method="post">
                Product Key: <input type="text" name="key"><br>
                <input type="submit"> 
				</form>       
              </div> 
			</div><!-- row -->

            <!-- update a key -->
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="card">
               <div class="card-header">
                <h1>Update prices</h1>
               </div>
               <form action="../Controller/UpdateItem.php" method="post">
                Game Name:<input type="text" name="name"><br>
                The new sell price: <input type="int" name="sell"><br>
                The new buy price: <input type="int" name="buy"><br>
                <input type="submit">
			   </form>        
              </div> 
			</div><!-- row -->
            </div><!-- container -->
     

      
            <div class="container">
        <div class="row">
                <!-- Display items -->
                <?php
					$itemtxt = getAllUsers();
					$item = json_decode($itemtxt) ;
					for ($i=0 ; $i<sizeof($item) ; $i++) {
						$newArray[] = $item[$i] -> id;
						echo '<div class="col-lg-4 col-md-4 col-sm-4">' ;
						echo '<div class="card">' ;
						echo $item[$i] -> username ;
						echo '<div class="card-block">' ;
						echo '<p>Email;'.$item[$i] -> email.'</p>' ; 
                        echo '<p>Phone number;'.$item[$i] -> Phone_Num.'</p>' ; 
						echo '<p>Credit'.$item[$i] -> Credit.'</p>' ; 
						echo '</div>' ;
						echo '</div>' ;
						echo '</div>' ;
					}
				?>
			</div><!-- row -->	
    		<br/><!-- simple but effective way to get some space -->

            <!-- delete a User -->
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="card">
               <div class="card-header">
                <h1>Delete User</h1>
               </div>
               <form action="../Controller/DeleteUser.php" method="post">
                User Name: <input type="text" name="UserID"><br>
                <input type="submit"> 
				</form>       
              </div> 
			</div><!-- row -->
        </div><!-- container -->

        <div id="footer" class="card text-center">
		<p>Tayside PC Gamers <br>
		info@taysidePCGamers.org <br><br>
		With help from Simple Coding Partners </p>
        </div>

        
    <!-- Bootstrap Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</body>
</html>