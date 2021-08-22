<?php
	include('connection.php');//get db connection from connection.php
	session_start();
?>



<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="Resources/bootstrap-3.4.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="Resources/css/mystyle.css">
	<link rel="stylesheet" href="Resources/css/register.css">
	<link rel="stylesheet" href="Resources/css/login.css">
	<script src="Resources/jquery/jquery.min.js"></script>
	<script src="Resources/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
  

  
  
</head>
<body >


	<!-- Navigation bar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Seventh Shot</a>
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
		<div class="row">

			<div class="col-md-6" >
				<div  style="border:0" class="thumbnail ">
					<img src="images/bottle.jpg">
				</div>
			</div>
			<div class="col-md-5"  style="float:right">
				<div style="border-radius: 25px" class="thumbnail ">
					<form method="post">
						
						<h2>Register</h2><br>
						<p>Please fill in this form to create an account.</p>
						<b>User Name <sup>*</sup></b><br>
						<input type="text" placeholder="Enter user Name" name="username" required style="width:100%"><br>
						<b>Password <sup>*</sup></b><br>
						<input type="password" placeholder="Enter Password" name="password" required style="width:100%"><br>
						<b>First Name <sup>*</sup></b><br>
						<input type="text" placeholder="Enter Your First Name" name="f_name" required style="width:100%"><br>
						<b>Last Name <sup>*</sup></b><br>
						<input type="text" placeholder="Enter Your Last Name" name="l_name" required style="width:100%"><br>
						<b>Address <sup>*</sup></b><br>
						<input type="text" placeholder="Enter No." name="no" required style="width:20%">
						<input type="text" placeholder="Enter Street" name="street" required style="width:79%">
						<input type="text" placeholder="Enter City" name="town" required><br>
						<b>NIC No. <sup>*</sup></b><br>
						<input type="text" placeholder="Enter Your NIC No." name="nic" required style="width:100%"><br>
						<b>Telephone No. <sup>*</sup></b><br>
						<input type="text" placeholder="Enter Your Telephone No." name="tp" required style="width:100%"><br>
						<b>Email</b><br>
						<input type="text" placeholder="Enter Your Email" name="email" style="width:100%"><br>
						<button type="submit" class="registerbtn" name="register">Register</button>
					
					</form>
					If you already have an account
					<button onclick="document.getElementById('login').style.display='block'" class="navbutton"> Login</button>
					
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
	//registration part
	if(isset($_POST["register"])){
		$fname=$_POST["f_name"];
		$lname=$_POST["l_name"];
		$username=$_POST["username"];
		$password=$_POST["password"];
		$nic=$_POST["nic"];
		$no=$_POST["no"];
		$street=$_POST["street"];
		$town=$_POST["town"];
		$tp=$_POST["tp"];
		$email=$_POST["email"];
		
		//age validation
		$today=date("Y");
		$year=substr($nic,0,2);
		$age=$today-("19".$year);
		
		//username validation
		$user_name_validation=mysqli_query($sql_connection,"SELECT * FROM user WHERE user_name='$username'");

		if(mysqli_num_rows($user_name_validation)>0){
			echo '<script type="text/javascript">alert("Registration failed. username already exists!");document.getElementById("registration.php").style.display="block";</script>';
		}elseif($age<23){
			echo '<script type="text/javascript">alert("Registration failed. you must older than 21 years old!");document.getElementById("registration.php").style.display="block";</script>';
		}else{
			$query="INSERT INTO user (user_first_name,user_last_name,user_name,user_password,user_nic,user_address_no,user_address_street,user_address_town,user_tp,user_email) VALUES('$fname','$lname','$username','$password','$nic','$no','$street','$town','$tp','$email')";
			$run=mysqli_query($sql_connection,$query);

			if(!$run){
				echo '<script type="text/javascript">alert("Registration failed!");document.getElementById("registration.php").style.display="block";</script>';
			}else{
				echo '<script type="text/javascript">alert("Registration succesfully!");document.getElementById("login").style.display="block";</script>';
			}
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
	}
	
	
	
	
	mysqli_close($sql_connection);
	
?>