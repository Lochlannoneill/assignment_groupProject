<?php
//===================================================================================================================
//@Author: Gerardo Julio V. Ancheta Jr.
//Group 11
//Team members: Lochlann O Neill, Keith Bullman, Daniels Pikurs, Gerardo Ancheta Jr. 
//Module: Year 03 Group Project
//Date: 21/11/2020 
//Fin-Ai Web app
//funcLogin.php
//===================================================================================================================
if(isset($_POST['btnLogin'])){
//------------------------------------------------------------------------------------------------------------------
//Connect to Database
//------------------------------------------------------------------------------------------------------------------  
	require_once 'dbconfig.php'; 
//------------------------------------------------------------------------------------------------------------------
//Initialize Variables
//------------------------------------------------------------------------------------------------------------------
// Criteria to search for
	//$safe_usernameemail = mysqli_real_escape_string($db,$_POST['usernameemail']);
    $safe_username = mysqli_real_escape_string($db,$_POST['username']);  
    $safe_pwd = mysqli_real_escape_string($db,$_POST['pwd']);
    //$safe_pwd=password_hash($safe_pwd, PASSWORD_DEFAULT);
//------------------------------------------------------------------------------------------------------------------
//MySQL Query
//------------------------------------------------------------------------------------------------------------------
	//$queryBanker="SELECT * FROM banker_db WHERE admin_username='$safe_username' AND admin_pwd='$safe_pwd'"; 
	$queryBanker="SELECT * FROM banker_db WHERE admin_username='$safe_username' AND admin_pwd='$safe_pwd'";   
	$resultBanker = mysqli_query($db, $queryBanker);

	//$queryBroker="SELECT * FROM broker_db WHERE username='$safe_username' AND user_pwd='$safe_pwd'";
	$queryBroker="SELECT * FROM broker_db WHERE username='$safe_username' AND user_pwd='$safe_pwd'";  
	$resultBroker = mysqli_query($db, $queryBroker);  
//------------------------------------------------------------------------------------------------------------------
//Results/Statements
//------------------------------------------------------------------------------------------------------------------
// If user exists in banker_db table bring to user admin_view.php
	if(mysqli_num_rows($resultBanker) > 0){
		$_SESSION['username']=$safe_username;//here session is used and value of $username store in $_SESSION.
		echo "<script>window.open('admin_view.php','_self')</script>";
		//header("location:admin_view.php");
	}
	// If user exists in broker_db table bring to user dashboard.php
	else if (mysqli_num_rows($resultBroker) > 0){
		$_SESSION['username']=$safe_username;//here session is used and value of $user_email store in $_SESSION.	
		echo "<script>window.open('dashboard.php','_self')</script>";
		//header("location:dashboard.php");
	}else{  
      header("Location: loginPage.php?error=invalidcredentials");
      exit();
    } 
}
?>