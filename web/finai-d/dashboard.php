<?php
//===================================================================================================================
//@Author: Gerardo Julio V. Ancheta Jr.
//Group 11
//Team members: Lochlann O Neill, Keith Bullman, Daniels Pikurs, Gerardo Ancheta Jr. 
//Module: Year 03 Group Project
//Date: 21/11/2020 
//Fin-Ai Web app
//dashboard.php
//===================================================================================================================  
session_start();  
  
if(!$_SESSION['username']){  
  
    header("location:loginPage.php?action=login");//redirect to the login page to secure the welcome page without login access.  
}  
  
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Banker Dashboard</title>
		<meta charset="utf-8">
		<!--===============================================================================================--> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->  
		<link rel="icon" type="image/png" href="img/finAi-logo.png" alt="Fin-Ai Logo"/>
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="assets/css/dashStyles.css">
		<!--===============================================================================================-->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
		<!--===============================================================================================-->
	</head>
	<body>
		<div class="header-container">		
			<img src="img/finAi-logo.png" alt="Fin-Ai Logo" width="100px" height="50px"/>		
			<div class="wrapper">	
				<ul class="lblUser">
					<li color="black"><?php echo $_SESSION['username'];?></li>
				</ul>
				<ul class="ulLogout">	
					<li><button class="btnLogout" onClick="window.location='logout.php';">Logout</button></li>					
				</ul>
			</div>	
		</div>
		<h1>Broker Dashboard</h1>
		<hr>
		<div class="dash-container">
			<form role="form" action="dashboard.php" method="post" class="formData">
				<div>	
					<label for="lblSelectBanker"><b>Select Your Banker:</b></label>
					<select name="dpdSelectBanker" required>
						<option disabled selected>-Select Your Banker-</option>
						<?php
						//------------------------------------------------------------------------------------------------------------------
						//Connect to Database
						//------------------------------------------------------------------------------------------------------------------  
							//include("assets/php/dbconfig.php");
							//include("dbconfig.php");
							require_once 'assets/php/dbconfig.php'; 
						//------------------------------------------------------------------------------------------------------------------
						//Send Query
						//------------------------------------------------------------------------------------------------------------------
							$search_admin_username_query="SELECT admin_username FROM banker_db";
							$resultName=mysqli_query($db,$search_admin_username_query);//here run the sql query. 
						//------------------------------------------------------------------------------------------------------------------
						//Output Result, List User from liveblogusers
						//------------------------------------------------------------------------------------------------------------------
						if($resultName > 0){
							while($rowName = mysqli_fetch_array($resultName)) {
								echo '<option id="banker_user">'.$rowName["admin_username"].'</option>';
							}
						}
						?>
					</select>
				</div>	
				<br>
				<div>
					<label for="age"><b>Enter Your Age:</b></label>
					<input type="number" placeholder="Age" id="broker_age" name="broker_age" min="18" max="100" required>
				</div>
				<br>
				<div>
					<label for="income"><b>Enter Your Income(€):</b></label>
					<input type="number" placeholder="€" id="broker_income" name="broker_income" min="0" required>
				</div>
				<br>
				<button type="submit" class="btnSubmit" name="btnSubmit">Submit</button>	
			</form>
		</div>
<!--		<?php
/*			if(!isset($_GET['error'])){
				exit();
			}else{
				$formCheck = $_GET['error'];

				if($formCheck == "emptyfields"){
					echo "<script>alert('You did not fill in all fields!')</script>";
					exit();
				}
				else if($formCheck == "userexist"){
					echo "<script>alert('Username data already exist!')</script>";
					exit();
				}
				else if($formCheck == "submit"){
					echo "<script>alert('SQL Error!')</script>";
					exit();
				}			
			}
	*/	?> -->
	</body>
</html>
<?php
if(isset($_POST['btnSubmit'])){
//------------------------------------------------------------------------------------------------------------------
//Connect to Database
//------------------------------------------------------------------------------------------------------------------  
	//include("assets/php/dbconfig.php");
	//include("dbconfig.php");
	require_once 'assets/php/dbconfig.php'; 	
//------------------------------------------------------------------------------------------------------------------
//Initialize Variables
//------------------------------------------------------------------------------------------------------------------
	//get result from the post array after submitting the form.
	$admin_username = $_POST['dpdSelectBanker'];
	//Grab username whoever is logged in and insert into db.
	$username = $_SESSION['username'];
	$broker_age = $_POST['broker_age'];
	$broker_income = $_POST['broker_income'];

	
//------------------------------------------------------------------------------------------------------------------
//Input Error Check
//------------------------------------------------------------------------------------------------------------------
    if(empty($admin_username) || empty($broker_age) || empty($broker_income)){
    	echo "<script>alert('You did not fill in all fields!')</script>";
    	//header("Location: dashboard.php?error=emptyfields");
        exit();
    }
  
//------------------------------------------------------------------------------------------------------------------
//Escape the admin input to make it safe to place in a query
//------------------------------------------------------------------------------------------------------------------
	$safe_admin_username = mysqli_real_escape_string($db, $admin_username);
	$safe_broker_username = mysqli_real_escape_string($db, $username);  
	$safe_broker_age = mysqli_real_escape_string($db, $broker_age);
	$safe_broker_income = mysqli_real_escape_string($db, $broker_income);

//------------------------------------------------------------------------------------------------------------------
//MySQL Query
//------------------------------------------------------------------------------------------------------------------	
    //query if they exist in the bankerdata_db then they can't submit again.
    $check_user_exist = "SELECT broker_username FROM bankerdata_db WHERE broker_username='$safe_broker_username'";
    $sql_query_check=mysqli_query($db,$check_user_exist);
    if(mysqli_num_rows($sql_query_check)>0){
    	echo "<script>alert('Username data already exist!')</script>";  
	    //header("Location: dashboard.php?error=userexist");	    
	    exit();  
    }

    //query broker's email matching their username and insert to database.
	$match_user_email="SELECT user_email FROM broker_db WHERE username = '$safe_broker_username'";
	$query_user_email=mysqli_query($db,$match_user_email);

	//$safe_broker_email = $query_user_email->fetch_array()['user_email'] ?? '';

	if($row=mysqli_fetch_assoc($query_user_email)){
			$safe_broker_email = $row['user_email'];
	}

	//$safe_broker_email=mysqli_real_escape_string($db, $query_user_email);

	//Insert the user's data into the database.  
    $insert_data="INSERT INTO bankerdata_db (admin_username, broker_username, broker_email, broker_age, broker_income) VALUES ('$safe_admin_username', '$safe_broker_username', '$safe_broker_email', '$safe_broker_age', '$safe_broker_income')";

    if(mysqli_query($db,$insert_data)){  
        echo"<script>alert('Data Successfully Submitted')</script>";
        //header("Location: dashboard.php?submit=success");
        exit();  
    }else{
    	echo "<script>alert('SQL Error!')</script>";
    	//header("Location: dashboard.php?error=submit");
    	exit();
    }
}
?>		