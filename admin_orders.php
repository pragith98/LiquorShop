<?php
	include('connection.php');
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
		$signupBtn= "<a href='user.php'>Hi! ".$name."</a>";
		$loginBtn="<form method='post'><button class='navbutton' name='logout'><span class='glyphicon glyphicon-log-out' ></span> Log out</button></form>";
		
		$query8="select count(*) as notification from notification where notifi_status='New'";
		$result8=mysqli_query($sql_connection,$query8);
			while($row=mysqli_fetch_assoc($result8)){
				$notificount=$row['notification'];
			}
		$notifiBtn="<a href='admin.php'><span class='glyphicon glyphicon-bell' ></span>"." ". $notificount."</a>";
		
	}
	else{
		$signupBtn= "<a href='registration.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a>";
		$loginBtn= "<button onclick=\"document.getElementById('login').style.display='block'\" class='navbutton'><span class='glyphicon glyphicon-log-in' ></span> Login</button>";
		$cartBtn="";
		$notifiBtn="";
	}
	
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
				<a class="navbar-brand" href="admin.php">Seventh Shot - Admin</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><?php      echo $signupBtn;                  ?></li>
					<li><?php      echo $loginBtn;                  ?></li>
					<li><?php      echo $notifiBtn;                  ?></li>
					
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
			<li class="active"><a href="admin.php" style="color:white" >Home</a></li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white">Orders <span class="caret"></span></a>
				<ul class="dropdown-menu" >
					<li><a href="admin_orders.php?type=new">New</a></li>
					<li><a href="admin_orders.php?type=shiped">Shiped</a></li>
					<li><a href="admin_orders.php?type=history">History</a></li>
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white">Items <span class="caret"></span></a>
				<ul class="dropdown-menu" >
					<li><a href="item.php?type=view">View / Remove</a></li>
					<li><a href="item.php?type=add">Add New</a></li>
				</ul>
			</li>
			<li><a href="admin_user.php" style="color:white">Users</a></li>
			<li><a href="about.php" style="color:white">About us</a></li>
		</ul>
	</div>
	<hr>
		
	



 
 
	<!-- Content -->

	<div class="container">
		<div class="row container-fluid ">
		<h2 class='text-center'>Orders</h2>
		
		
		<?php

			$status=$_GET['type'];
			
			//new orders
			if($status=='new'){
				echo "<h3>New Orders</h3>";
				echo "<div class='col-md'>";
				echo "<div style='border-radius: 25px'>";
				echo "<table style='table-layout:fixed;width:100%'>";
				echo "<tr>";
				echo "<th>User ID</th><th>Product Name</th><th>Quentity</th><th>Total Price</th><th>Order Placed Date/Time</th><th>Status</th>";
				echo "</tr>";
				
				$query4="SELECT orders.*,product.product_name FROM orders,product WHERE orders.order_status='New' and orders.order_product_id=product.product_id order by orders.order_id DESC";
				$result4=mysqli_query($sql_connection,$query4);
				while($row=mysqli_fetch_assoc($result4)){
					
					$_SESSION['customerid']=$row['order_user_id'];
					
					echo "<tr>";
					echo "<td>";
					echo $row['order_user_id'];
					echo "</td>";
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

					$order_id=$row['order_id'];
					$status =$row['order_status'];

					echo "<td><a href='admin_orders.php?ship=$order_id' class='viewbtn'>Ship</a></td>";
					echo "<td><a href='admin_orders.php?cancel=$order_id' class='viewbtn'>Cancel</a></td>";
					echo "</tr>";
					
					echo "<tr><td colspan='5'><hr></td></tr>";
					
				}
				
				echo "</table>";
				echo "</div>";
				echo "</div>";
				echo "<hr>";
			}
			
			
			//update order table
			
			if(isset($_GET['cancel'])){
				$orderid=$_GET['cancel'];
				$query5="update orders set order_status='Canceld' where order_id='$orderid'";
				$result5=mysqli_query($sql_connection,$query5);
				
				if($result5){
					echo '<script type="text/javascript">alert("Your order canceld successful!");window.location.href = "admin_orders.php?type=new";</script>';
				
				//add notification
					$cust_id=$_SESSION['customerid'];
					
					$query7="insert into notification (notifi_cust_id,notifi_notice,notifi_status) values ('$cust_id','Your Order Canceld!','New_adm')";
					$result7=mysqli_query($sql_connection,$query7);
				}
			}
			
			
			if(isset($_GET['ship'])){
				$orderid=$_GET['ship'];
				$query5="update orders set order_status='Shiped' where order_id='$orderid'";
				$result5=mysqli_query($sql_connection,$query5);
				
				if($result5){
					echo '<script type="text/javascript">alert("Order Shiped");window.location.href = "admin_orders.php?type=new";</script>';

					//add notification
					$cust_id=$_SESSION['customerid'];
					
					$query7="insert into notification (notifi_cust_id,notifi_notice,notifi_status) values ('$cust_id','Your Order Shiped!','New_adm')";
					$result7=mysqli_query($sql_connection,$query7);
				}
			}

			//shiped orders
			if($status=='shiped'){
			echo "<h3>Shiped Orders</h3>";
			echo "<div class='col-md-9'>";
			echo "<div style='border-radius: 25px'>";
			echo "<table style='table-layout:fixed;width:100%'>";
			echo "<tr>";
			echo "<th>User ID</th><th>Product Name</th><th>Quentity</th><th>Total Price</th><th>Order Placed Date/Time</th><th>Status</th>";
			echo "</tr>";
			
			$query5="SELECT orders.*,product.product_name FROM orders,product WHERE orders.order_status='Shiped' and orders.order_product_id=product.product_id order by orders.order_id DESC";
			$result5=mysqli_query($sql_connection,$query5);
			while($row=mysqli_fetch_assoc($result5)){
				
				echo "<tr>";
				echo "<td>";
				echo $row['order_user_id'];
				echo "</td>";
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
				
				$order_id=$row['order_id'];
				$status =$row['order_status'];

				echo "<td><a href='admin_orders.php?cancelship=$order_id' class='viewbtn'>Cancel</a></td>";
				echo "</tr>";

				echo "<tr><td colspan='5'><hr></td></tr>";

			}
	
			echo "</table>";
			echo "</div>";
			echo "</div>"; 
			}
			
			if(isset($_GET['cancelship'])){
				$orderid=$_GET['cancelship'];
				$query5="update orders set order_status='Canceld' where order_id='$orderid'";
				$result5=mysqli_query($sql_connection,$query5);
				
				if($result5){
					echo '<script type="text/javascript">alert("Order Shiping canceld successful!");window.location.href = "admin_orders.php?type=shiped";</script>';
					
					//add notification
					$cust_id=$_SESSION['customerid'];
					
					$query7="insert into notification (notifi_cust_id,notifi_notice,notifi_status) values ('$cust_id','Your Order Canceld!','New_adm')";
					$result7=mysqli_query($sql_connection,$query7);
				}
			}


			//orders history
			if($status=='history'){
				echo "<h3>Orders History</h3>";
				echo "<div class='col-md-9'>";
				echo "<div style='border-radius: 25px'>";
				echo "<table style='table-layout:fixed;width:100%'>";
				echo "<tr>";
				echo "<th>UserID</th<th>Product Name</th><th>Quentity</th><th>Total Price</th><th>Order Placed Date/Time</th><th>Status</th>";
				echo "</tr>";
				
				$query5="SELECT orders.*,product.product_name FROM orders,product WHERE orders.order_status in ('Completed','Canceld') and orders.order_product_id=product.product_id order by orders.order_id DESC LIMIT 30";
				$result5=mysqli_query($sql_connection,$query5);
				while($row=mysqli_fetch_assoc($result5)){
					
					echo "<tr>";
					echo "<td>";
					echo $row['order_user_id'];
					echo "</td>";
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

					echo "<tr><td colspan='5'><hr></td></tr>";

				}
				
				echo "</table>";
				echo "</div>";
				echo "</div>"; 
			}

		?>	
		

		</div>	
	</div>


	<!-- Footer -->
	<footer class="page-footer font-small pt-4" style="background-color:rgb(34, 34, 34);color:white;">
		<div style="height:20px;"></div>
		<div class="container-fluid text-center ">
			<div class="row">
					<h5 class="text-uppercase">Seventh Shot</h5>
					<p>A project for Internet Application Development Course Unit</p>
			</div>
		</div>
		<div class="footer-copyright text-center py-3" style="background-color:black;color:gray">
			© 2020 Copyright: Seventh Shot 
		</div>

	</footer>
	<!-- Footer -->













</body>
</html>

<?php
	

	
	mysqli_close($sql_connection);
	
?>

