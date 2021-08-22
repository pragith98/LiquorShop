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
	<title>user</title>
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
		<h2 class='text-center'>Profile</h2>
		
	<?php
		//profile data
		echo "<h3>My Details</h3>";
		$query3="SELECT * FROM user WHERE user_id='$id'";
		$result3=mysqli_query($sql_connection,$query3);
		while($row=mysqli_fetch_assoc($result3)){
			echo "<table>";
			echo "<tr>";
			echo "<th>Name</th><td>".$row['user_first_name']." ".$row['user_last_name']."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>NIC</th><td>".$row['user_nic']."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Address</th><td>".$row['user_address_no'].", ".$row['user_address_street'].", ".$row['user_address_town']."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>TP</th><td>".$row['user_tp']."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Email</th><td>".$row['user_email']."</td>";
			echo "</tr>";
			echo "</table>";
		}
			
		echo "<hr>";
			
			
		//new notifications
		echo "<h3>New Notifications</h3>
		<div class='col-md'>
		<div style='border-radius: 25px;background-color:#ff9191'>
		<table style='table-layout:fixed;width:100%'>
			<tr>
				<th>Date/Time</th><th>Message</th>
			</tr>";
		
		//get notification from database
		$query4="select * from notification where notifi_status='New_adm' and notifi_cust_id='$id'";
		$result4=mysqli_query($sql_connection,$query4);
		while($row=mysqli_fetch_assoc($result4)){
			echo "<tr>";
			echo "<td>";
			echo $row['notifi_date'];
			echo "</td>";
			echo "<td>";
			echo $row['notifi_notice'];
			echo "</td>";
			$notifiid=$row['notifi_id'];
			echo "<td><a href='user.php?read=$notifiid' class='viewbtn'>Read</a></td>";
			echo "</tr>";
			echo "<tr><td colspan='2'><hr></td></tr>";
		}
		echo "</table>
		</div>
		</div>";
		
		//update notification table
		if(isset($_GET['read'])){
			$notifiid=$_GET['read'];
			$query5="update notification set notifi_status='Read_usr' where notifi_id='$notifiid'";
			$result5=mysqli_query($sql_connection,$query5);
			
			if($result5){
				echo '<script type="text/javascript">alert("Check your order staus!");window.location.href = "user.php";</script>';
			}
		}
		echo "<hr>";
			
			
		//my new orders
		echo "<h3>New Orders</h3>
		<div class='col-md'>
		<div style='border-radius: 25px;background-color:#e3e3e3'>
		<table style='table-layout:fixed;width:100%'>
		<tr>
		<th>Product Name</th><th>Quentity</th><th>Total Price</th><th>Order Placed Date/Time</th><th>Status</th>
		</tr>";
		
		//get new or ship order details from db
		$query4="SELECT orders.*,product.product_name FROM orders,product WHERE order_user_id='$id' and orders.order_status in('New','Shiped') and orders.order_product_id=product.product_id order by orders.order_id DESC";
		$result4=mysqli_query($sql_connection,$query4);
		while($row=mysqli_fetch_assoc($result4)){
			echo "<tr>";
			echo "<td>";
			echo $row['product_name'];
			echo "</td>";
			echo "<td>";
			echo $row['order_quentity'];
			echo "</td>";
			echo "<td>";
			echo "LKR ".$row['order_total_price']." .00";
			echo "</td>";
			echo "<td>";
			echo $row['order_date'];
			echo "</td>";
			echo "<td>";
			echo $row['order_status'];
			echo "</td>";
			
			
			//order control btns
			$order_id=$row['order_id'];
			$status =$row['order_status'];

			if($status=='New'){
			echo "<td><a href='user.php?cancel=$order_id' class='viewbtn'>Cancel</a></td>";
			}
			echo "<td><a href='user.php?received=$order_id' class='viewbtn'>Received</a></td>";
			echo "</tr>";
			//hr line
			echo "<tr><td colspan='5'><hr></td></tr>";	
		}
		echo "</table>
		</div>
		</div>";

		echo "<hr>";
		
		//update order table
		if(isset($_GET['cancel'])){
			$orderid=$_GET['cancel'];
			$query5="update orders set order_status='Canceld' where order_id='$orderid'";
			$result5=mysqli_query($sql_connection,$query5);
			
			if($result5){
				echo '<script type="text/javascript">alert("Your order canceld successful!");window.location.href = "user.php";</script>';
			}
		}
		if(isset($_GET['received'])){
			$orderid=$_GET['received'];
			$query5="update orders set order_status='Completed' where order_id='$orderid'";
			$result5=mysqli_query($sql_connection,$query5);
			
			if($result5){
				echo '<script type="text/javascript">alert("it\'s a pleasure to deal with you");window.location.href = "user.php";</script>';
			}
		}
		
	
		//orders history
		echo "<h3>Orders History</h3>
		<div class='col-md-9'>
		<div style='border-radius: 25px;background-color:#e3e3e3'>
		<table style='table-layout:fixed;width:100%' >
			<tr>
				<th>Product Name</th><th>Quentity</th><th>Total Price</th><th>Order Placed Date/Time</th><th>Status</th>
			</tr>";
		
		//get completed or cancel order details from db
		$query5="SELECT orders.*,product.product_name FROM orders,product WHERE order_user_id='$id' and orders.order_status in('Completed','Canceld') and orders.order_product_id=product.product_id order by orders.order_id DESC LIMIT 10";
		$result5=mysqli_query($sql_connection,$query5);
		while($row=mysqli_fetch_assoc($result5)){
			echo "<tr>";
			echo "<td>";
			echo $row['product_name'];
			echo "</td>";
			echo "<td>";
			echo $row['order_quentity'];
			echo "</td>";
			echo "<td>";
			echo "LKR ".$row['order_total_price']." .00";
			echo "</td>";
			echo "<td>";
			echo $row['order_date'];
			echo "</td>";
			echo "<td>";
			echo $row['order_status'];
			echo "</td>";
			echo "</tr>";
			
			//hr line
			echo "<tr><td colspan='5'><hr></td></tr>";
		}
		
		echo "</table>
		</div>
		</div>";

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
	
</body>
</html>

<?php
	mysqli_close($sql_connection);
?>

