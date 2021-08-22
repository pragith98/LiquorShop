<?php
	include('connection.php');//get db connection from connection.php
	session_start();
	if(isset($_SESSION['userid'])){
		$id=$_SESSION['userid'];
	}

	
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
	<title>cart</title>
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
		<h2 class='text-center'>Cart</h2>
		
			<?php
				//get product cart details from db
				$query4="SELECT cart.*,product.product_name,product.product_brand FROM cart,product WHERE cart_user_id='$id' and cart.cart_product_id=product.product_id";
				$result4=mysqli_query($sql_connection,$query4);
				while($row=mysqli_fetch_assoc($result4)){
					$cartid=$row['cart_id'];
					echo "<div class='col-md-7'>";
					echo "<div style='border-radius: 25px'>";
					echo "<table style='table-layout:fixed;width:100%'>";
					echo "<tr>";
					echo "<td>";
					echo "<img src='images/bottle.jpg' style='width:50%; border-radius:5%'>";
					echo "</td>";
					echo "<td>";
					echo "<div>";
					echo "<h2>".$row['product_name']."</h2>";
					echo "<h3>Brand: ".$row['product_brand']."</h3>";
					echo "<h4>Quentity: ".$row['cart_quentity']."</h4>";
					echo "<h4>Total: LKR ".$row['cart_total_price']." .00</h4>";
					
					$productid=$row['cart_product_id'];
					$quentity=$row['cart_quentity'];
					$total=$row['cart_total_price'];
					
					echo "<a href='cart.php?remove=$cartid' class='viewbtn'>Remove</a>"; //get cartitem code
					echo "<a href='cart.php?order=$productid&quentity=$quentity&total=$total&cartid=$cartid' class='viewbtn'>order</a>";
					echo "</div>";
					echo "</td>";
					echo "</tr>";
					echo "<tr><td colspan='2'><hr></td></tr>";
					echo "</table>";
					echo "</div>";
					echo "</div>";
				} 
				
				//remove item from cart
				if(isset($_GET['remove'])){
					$cartremoveid=$_GET['remove'];
					$query5="DELETE FROM cart WHERE cart_id='$cartremoveid'";
					$result5=mysqli_query($sql_connection,$query5);
					echo '<script type="text/javascript">alert("Item Removed from Cart!");window.location.href = "cart.php";</script>';
					
				}
				
				//add to order
				if(isset($_GET['order'])){
					$productid=$_GET['order'];
					$quentity=$_GET['quentity'];
					$total=$_GET['total'];
					$query6="insert into orders (order_user_id,order_product_id,order_quentity,order_total_price,order_status) values ('$id','$productid','$quentity','$total','New')";
					$result6=mysqli_query($sql_connection,$query6);
					
					//remove item from cart
					if($result6){
						$cartid=$_GET['cartid'];
						$query5="DELETE FROM cart WHERE cart_id='$cartid'";
						$result5=mysqli_query($sql_connection,$query5);
						echo '<script type="text/javascript">alert("Your order placed successful!");window.location.href = "cart.php";</script>';
						
						//add notification
						$query7="insert into notification (notifi_cust_id,notifi_notice,notifi_status) values ('$id','You Have New Order','New')";
						$result7=mysqli_query($sql_connection,$query7);	
					}	
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



<?php

	
	
	
	
	mysqli_close($sql_connection);
	
?>

