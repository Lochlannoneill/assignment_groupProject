<?php  
session_start();//session starts here  
require_once 'assets/php/funcLogin.php';
?> 
<!DOCTYPE html>
<!--
@Author: Gerardo Julio V. Ancheta Jr.
Group 11
Team members: Lochlann O Neill, Keith Bullman, Daniels Pikurs, Gerardo Ancheta Jr. 
Module: Year 03 Group Project
Date: 21/11/2020 
Fin-Ai Web app
loginPage.html
-->
<html lang="en">
	<head>
		<title>Fin-Ai Login</title>
		<meta charset="UTF-8">
		<!--===============================================================================================--> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->  
		<link rel="icon" type="image/png" href="img/finAi-logo.png" alt="Fin-Ai Logo"/>
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="assests/vendor/bootstrap/css/bootstrap.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="assets/css/loginStyles.css">
		<!--===============================================================================================-->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
		<!--===============================================================================================-->
	</head>
	<body>
		<div class="logo">
			<a href="index.html"><img src="img/finAi-logo.png" alt="Fin-Ai Logo" width="100px" height="50px"/></a>
		</div>
			<form role="form" action="loginPage.php" method="post">
				<div class="container">
					<h1>LOGIN FORM</h1>
					<label for="username"><b>Username</b></label>
					<input type="text" placeholder="Enter Username" name="username" autocomplete="off" required>

					<label for="pwd"><b>Password</b></label>
					<input type="password" placeholder="Enter Password" name="pwd" required>

					<button type="submit" class="btnLogin" name="btnLogin">LOGIN</button>
					<button class="btnRegister" onclick="window.location.href='registerPage.php';">REGISTER</button>
					<!--<label>
					<input type="checkbox" checked="checked" name="remember"> Remember me
					</label> -->
				</div>
				<div class="container" style="background-color:#f1f1f1">
					<button type="button" class="cancelbtn" onclick="window.location.href='index.html';">Cancel</button>
					<!--<span class="psw">Forgot <a href="#">password?</a></span>-->
			  </div>
			</form>
<!--===============================================================================================-->
<!-- PHP -->
<!--===============================================================================================-->
<?php
	if(!isset($_GET['error'])){
		exit();
	}else{
		$loginCheck = $_GET['error'];

		if($loginCheck == "emptyfields"){
			echo "<script>alert('You did not fill in all fields!')</script>";
			exit();
		}
/*		else if($loginCheck == "wrongpassword"){
			echo "<script>alert('Wrong Password!')</script>";
			exit();
		}*/
		else if($loginCheck == "nouser"){
			echo "<script>alert('User not found')</script>";
			exit();
		}
		else if($loginCheck == "invalidcredentials"){
			echo "<script>alert('Invalid Credentials!')</script>";
			exit();
		}				
	}
?>				
	</body>
</html> 