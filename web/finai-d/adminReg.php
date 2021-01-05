<?php
require_once 'assets/php/bankerReg.php';
?>
<!DOCTYPE html>
<!--
@Author: Gerardo Julio V. Ancheta Jr.
Group 11
Team members: Lochlann O Neill, Keith Bullman, Daniels Pikurs, Gerardo Ancheta Jr. 
Module: Year 03 Group Project
Date: 21/11/2020 
Fin-Ai Web app
adminReg.php
-->
<html lang="en">
	<head>
		<title>Fin-Ai Register</title>
		<meta charset="utf-8">
		<!--===============================================================================================-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="assets/css/registerStyles.css"/>
		<!--===============================================================================================-->
		<link rel="icon" type="image/png" href="img/finAi-logo.png" alt="Fin-Ai Logo"/>
		<!--===============================================================================================-->
	</head>
	<body>
		<div class="logo">
			<a href="index.html"><img src="img/finAi-logo.png" alt="Fin-Ai Logo" width="100px" height="50px"/></a>
		</div>	
			<div class="container">
				<h1>REGISTRATION</h1>	
					<hr>
					<p style="text-align:center">Please fill in this form to create an account.</p>
<!--===============================================================================================-->
<!-- BANKER REGISTARATION -->
<!--===============================================================================================-->
				<div id="bankerForm">					
					<form role="form" action="adminReg.php" method="post" name="bankerReg">
						<hr>
						<h3>BANKER REGISTRATION</h3>
							<div>
								<label for="username"><b>Username</b></label>
								<input type="text" placeholder="Enter Username" name="admin_username" id="username" autocomplete="off">
							</div>
							<div>	
								<label for="emailInput"><b>Email</b></label>				
								<input type="text" placeholder="Enter Email: example@gmail.com" name="admin_email" id="emailInput" autocomplete="off">
							</div>
							<div>
								<div class="tooltip"><label for="password"><b>Password</b></label>
									<span class="tooltiptext">Must contain: One number, One uppercase,  
															lowercase letter and at least 8 characters
									</span>
								</div>
											
								<label for="passwordInfo"></label>
								
								<input type="password" placeholder="Enter Password: Example123" name="admin_pwd">
							</div>			
						<button type="submit" class="btnRegister" name="btnBankerReg">REGISTER</button>
					</form>
				</div>			
				<hr>
				<p>By creating an account you agree to our <a href="tp.html">Terms & Privacy</a>.</p>				
				<div class="signin">
					<p>Already have an account? <a href="loginPage.php">SIGN IN</a>.</p>
					<p>Back To <a href="index.html" style="text-decoration: none">Home Page</a>.</p>
				</div>
			</div>	<!-- End of div "container" -->
<!--===============================================================================================-->
<!-- PHP -->
<!--===============================================================================================-->
<?php
	if(!isset($_GET['error'])){
		exit();
	}else{
		$signupCheck = $_GET['error'];

		if($signupCheck == "emptyfields"){
			echo "<script>alert('You did not fill in all fields!')</script>";
			exit();
		}
		else if($signupCheck == "invalidusername"){
			echo "<script>alert('Used of invalid characters in username!')</script>";
			exit();
		}
		else if($signupCheck == "invalidemail"){
			echo "<script>alert('Used of an invalid email!')</script>";
			exit();
		}
		else if($signupCheck == "userexist"){
			echo "<script>alert('Username already exist!')</script>";
			exit();
		}
		else if($signupCheck == "sqlerror"){
			echo "<script>alert('SQL Error!')</script>";
			exit();
		}				
	}
?>
	</body>
</html>