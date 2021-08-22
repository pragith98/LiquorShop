<?php
	include('connection.php');//get db connection from connection.php
	session_start();
	if(isset($_SESSION['userid'])){
		$id=$_SESSION['userid'];
	}
	$category=$_GET['category'];
	
	
	
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

	<div class="container">
		<div class="row container-fluid ">
		<h2 class='text-center'><?php echo $_GET['category']." Store";  ?></h2><br>
		
			<?php
				//products
				$query3="SELECT product_name,product_brand,product_id,product_price,product_image FROM product WHERE product_category='$category'";
				$result3=mysqli_query($sql_connection,$query3);
				while($row=mysqli_fetch_assoc($result3)){
					$p_id=$row['product_id'];
					echo "<div class='col-md-3' style='margin-bottom:30px'>";
					echo "<div class='card' style='width: 18rem;background-color:rgb(242, 243, 245)'>";
					echo "<img class='card-img-top' src='product_images/".$row['product_image']."' width='180px' height='200px'>";
					echo "<div class='card-body' style='height:120px'>";
					echo "<h4 class='card-title'>".$row['product_name']."</h4>";
					echo "<h5 class='card-title text-center'>".$row['product_brand']."</h5>";
					echo "<h4 class='card-title text-center'>"."LKR ".$row['product_price'].".00"."</h4>";
					echo "</div>";
					echo "<a href='productDetails.php?id=$p_id' class='viewbtn'>View Details</a>";
					echo "</div>";
					echo "</div>";
				}
				
			?>	
		
		
			
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

