<?php
	include('connection.php');//get db connection from connection.php
	session_start();
	if(isset($_SESSION['userid'])){
		$id=$_SESSION['userid'];
	}
	
	$p_id=$_GET['id'];
	
	
?>
<?php	
	//control navigation bar
	if(isset($_SESSION['userid'])){
		$query2="SELECT user_last_name FROM user WHERE user_id='$id'";
		$result2=mysqli_query($sql_connection,$query2);
			while($row=mysqli_fetch_assoc($result2)){
				$name=$row['user_last_name'];
			}
		//display control user name (last name)	
		$signupBtn= "<a href='user.php'>Hi! ".$name."</a>";
		$loginBtn="<form method='post'><button class='navbutton' name='logout'><span class='glyphicon glyphicon-log-out' ></span> Log out</button></form>";
		
		//display control cart item count
		$query3="select count(*) as cart_item from cart where cart_user_id='$id'";
		$result3=mysqli_query($sql_connection,$query3);
			while($row=mysqli_fetch_assoc($result3)){
				$cartCount=$row['cart_item'];
			}
		$cartBtn="<a href='cart.php'><span class='glyphicon glyphicon-shopping-cart' ></span>"." ". $cartCount."</a>";
		
		//display control notification count
		$query8="select count(*) as notification from notification where notifi_cust_id='$id' and notifi_status='New_adm'";
		$result8=mysqli_query($sql_connection,$query8);
			while($row=mysqli_fetch_assoc($result8)){
				$notificount=$row['notification'];
			}
		$notifiBtn="<a href='user.php'><span class='glyphicon glyphicon-bell' ></span>"." ". $notificount."</a>";
		
		
	}
	else{
		$signupBtn= "<a href='registration.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a>";
		$loginBtn= "<button onclick=\"document.getElementById('login').style.display='block'\" class='navbutton'><span class='glyphicon glyphicon-log-in' ></span> Login</button>";
		$cartBtn="";
		$notifiBtn="";
	}
	
	//log out
	if(isset($_POST["logout"])){
		session_unset();
		header('location:index.php');
	}
	
	
?>



<!DOCTYPE html>
<html>
<head>
	<title>products</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="Resources/bootstrap-3.4.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="Resources/css/mystyle.css">
	<link rel="stylesheet" href="Resources/css/login.css">
	<script src="Resources/jquery/jquery.min.js"></script>
	<script src="Resources/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
  

  
  
</head>
<body >


	<!-- Navigation bar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button> 
				<a class="navbar-brand" href="index.php">Seventh Shot</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><?php  echo $signupBtn;   ?></li> <!-- display signupBtn -->
					<li><?php  echo $loginBtn;    ?></li> <!-- display loginpBtn -->
					<li><?php  echo $cartBtn;     ?></li> <!-- display cartBtn -->
					<li><?php  echo $notifiBtn;   ?></li> <!-- display notificationBtn -->
				</ul>
			</div>
		</div>
	</nav>
	<div style="height:50px"></div>


	<!-- Header -->
	<div class="jumbotron text-center" style="background-image: url('images/cover.jpg');background-size: cover;margin-bottom: 0px;">
		<h1><font color="white">Seven<sup>th</sup> Shot</font></h1>
		<p><font color="white">Stay Home!!</font></p>
	</div>		

	<!-- menu bar -->
	<div>
		<ul class="nav-justified" style="background-color:black;">
			<li></li>
			<li class="active"><a href="index.php" style="color:white" >Home</a></li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white">Category <span class="caret"></span></a>
				<ul class="dropdown-menu" >
					<li><a href="product.php?category=Whiskey">Whiskey</a></li>
					<li><a href="product.php?category=Gin">Gin</a></li>
					<li><a href="product.php?category=Arrack">Arrack</a></li>
					<li><a href="product.php?category=Brandy">Brandy</a></li>
					<li><a href="product.php?category=Vodka">Vodka</a></li>
					<li><a href="product.php?category=Tequila">Tequila</a></li>
					<li><a href="product.php?category=Rum">Rum</a></li>
				</ul>
			</li>
			<li><a href="about.php" style="color:white">About us</a></li>
		</ul>
	</div>
	<hr>
		
	



 
 
	<!-- Content -->

	<div class="container-fluid container">
		<h2 class='text-center'>Product Details</h2><br>	
		<?php
			$query3="SELECT product_name,product_brand,product_category,product_price,product_size,product_abv,product_description,product_image FROM product WHERE product_id='$p_id'";
			$result3=mysqli_query($sql_connection,$query3);
			while($row=mysqli_fetch_assoc($result3)){
				$Name=$row['product_name'];
				$Brand=$row['product_brand'];
				$Category=$row['product_category'];
				$price=$row['product_price'];
				$Size=$row['product_size'];
				$ABV=$row['product_abv'];		
				$Description=$row['product_description'];
				$image=$row['product_image'];
			}
		?>
		
		<div class="row">
			<div class="col-md-6" >
				<div  style="border:0" class="thumbnail ">
					<img src="product_images/<?php   echo $image;       ?>">
				</div>
			</div>				
						
			<div class="col-md-5"  style="float:right">
				<div  style="border-radius: 25px" class="thumbnail ">
					<div>
						<table>
							<tr>
								<th>Name</td>
								<td> <?php  echo $Name;  ?> </td>
							</tr>
							<tr>
								<th>Brand</td>
								<td> <?php  echo $Brand;  ?> </td>
							</tr>
							<tr>
								<th>Category</td>
								<td> <?php  echo $Category;  ?> </td>
							</tr>
							<tr>
								<th>Price</td>
								<td> LKR. <?php  echo $price;  ?>.00 </td>
							</tr>
							<tr>
								<th>Size</td>
								<td> <?php  echo $Size;  ?> ml </td>
							</tr>
							<tr>
								<th>ABV</td>
								<td> <?php  echo $ABV;  ?> </td>
							</tr>
							<tr>
								<th>Description</td>
								<td> <?php  echo $Description;  ?> </td>
							</tr>
						</table>
					</div>
					<hr>
					<form method="post">
							Quentity
							<input type="number" name="quentity" min="1" max="3" step="1" value="1">
							<br>
							<button type="submit" class="cartbtn" name="addcart">Add to Cart</button>
					</form>
				</div>
			</div>
		</div>
	</div>




	<!-- Footer -->
	<footer class="page-footer font-small pt-4" style="background-color:rgb(34, 34, 34);color:white;">
		<div style="height:20px;"></div>
		<div class="container-fluid text-center text-md-left">
			<div class="row">
				<div class="col-md-6 mt-md-0 mt-3">
					<h5 class="text-uppercase">Seventh Shot</h5>
					<p>A project for Internet Application Development Course Unit.</p>
				</div>

				<div class="col-md-3 mb-md-0 mb-3">
					<h5 class="text-uppercase">Category</h5>
					<ul class="list-unstyled">
						<li>
							<a href="product.php?category=Whiskey">Whiskey</a>
						</li>
						<li>
							<a href="product.php?category=Gin">Gin</a>
						</li>
						<li>
							<a href="product.php?category=Arrack">Arrack</a>
						</li>
						<li>
							<a href="product.php?category=Brandy">Brandy</a>
						</li>
					</ul>
				</div>
				<div class="col-md-3 mb-md-0 mb-3">
					<h5 class="text-uppercase">Category</h5>
					<ul class="list-unstyled">
						<li>
							<a href="product.php?category=Vodka">Vodka</a>
						</li>
						<li>
							<a href="product.php?category=Tequila">Tequila</a>
						</li>
						<li>
							<a href="product.php?category=Rum">Rum</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="footer-copyright text-center py-3" style="background-color:black;color:gray">
			© 2020 Copyright: Seventh Shot 
		</div>

	</footer>











	<!-- login form -->
	<div id="login" class="modal">
	  <form class="modal-content animate" action="index.php" method="post">
		<div class="logincontainer">
			<span onclick="document.getElementById('login').style.display='none'" class="close" >x</span>
			<h1>Login</h1>
		</div>

		<div class="container">
			<font size="4px">Username</font><br>
			<input type="text" placeholder="Enter Username" name="username" required><br>
			<font size="4px">Password</font><br>
			<input type="password" placeholder="Enter Password" name="password" required><br>
			<button type="submit" name="log" class="logbutton">Login</button><br>
			Not a member? <a href="registration.php">Signup now</a>
		</div>
	  </form>
	</div>

</body>
</html>




<?php
	//add cart operation
	if(isset($_POST['addcart'])){
		//if not loged, redirect to login
		if(!isset($_SESSION['userid'])){
			echo '<script type="text/javascript">alert("Please login to your account!");document.getElementById("login").style.display="block";</script>';
		}else{
			$quentity=$_POST['quentity'];
			$total=$price*$quentity;
			$query4="INSERT INTO cart (cart_user_id,cart_product_id,cart_quentity,cart_total_price) VALUES('$id','$p_id','$quentity','$total')";
			$run=mysqli_query($sql_connection,$query4);
			echo '<script type="text/javascript">alert("Item added to Cart!");window.location.href = "index.php";</script>';
		}
	}
	


?>








<?php
	//login form controller
	if(isset($_POST["log"])){
		$username=$_POST["username"];
		$password=$_POST["password"];

		$query="SELECT user_id FROM user WHERE user_name='$username' and user_password='$password'";
		$result=mysqli_query($sql_connection,$query);

		if(mysqli_num_rows($result)==0){
			echo '<script type="text/javascript">alert("username or password incorrect!!");</script>';
		}else{
			while($row=mysqli_fetch_assoc($result)){
				$_SESSION['userid']=$row['user_id'];
				if($row['user_id']==1){
					echo '<script type="text/javascript">alert("login successful!");window.location.href = "admin.php";</script>'; 
				}else{
					echo '<script type="text/javascript">alert("login successful!");window.location.href = "index.php";</script>'; 	
				}
			}
		}
	}elseif(isset($_POST["register"])){
		header("Location: registration.php");
	}
	
	
	
	
	mysqli_close($sql_connection);
	
?>

