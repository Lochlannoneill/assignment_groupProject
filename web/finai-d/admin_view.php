<?php
//===================================================================================================================
//@Author: Gerardo Julio V. Ancheta Jr.
//Group 11
//Team members: Lochlann O Neill, Keith Bullman, Daniels Pikurs, Gerardo Ancheta Jr. 
//Module: Year 03 Group Project
//Date: 21/11/2020 
//Fin-Ai Web app
//admin_view.php
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
		<link rel="stylesheet" type="text/css" href="assets/css/admin_view_styles.css">
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
					<li color="black"><?php echo $_SESSION['username']?></li>
				</ul>
				<ul class="ulLogout">	
					<li><button class="btnLogout" onClick="window.location='logout.php';">Logout</button></li>					
				</ul>
			</div>	
		</div>
		<h1>Banker Dashboard</h1>
		<hr>
		<div class="main-container">
			<table class="table-data">
				<thead>  
			        <tr>  
			            <th>#</th>  
			            <th>Broker Username</th>  
			            <th>Broker E-mail</th>
			            <th>Broker Age</th>
			            <th>Broker Income</th>
			        </tr> 
	        	</thead>
		        <tbody>
		        	<?php
		        	//------------------------------------------------------------------------------------------------------------------
					//Connect to Database
					//------------------------------------------------------------------------------------------------------------------  
						//include("assets/php/dbconfig.php");
		        		//include("dbconfig.php");
		        		require_once 'assets/php/dbconfig.php';
					//------------------------------------------------------------------------------------------------------------------
					//Initialize Variables
					//------------------------------------------------------------------------------------------------------------------
						//Grab username whoever is logged in and insert into db.	
		        		$admin_session_username = $_SESSION['username'];
		        		$counter = 1;
					//------------------------------------------------------------------------------------------------------------------
					//Send Query
					//------------------------------------------------------------------------------------------------------------------
						//sql query, select user from tbl where user equal to whoever is logged in.
						$view_users_query="SELECT * FROM bankerdata_db WHERE admin_username = '$admin_session_username'";
						$result=mysqli_query($db,$view_users_query);//here run the sql query.  

						while($row=mysqli_fetch_array($result)){ //while look to fetch the result and store in a array $row.  
							$broker_username=$row[2];  
							$broker_email=$row[3];
							$broker_age=$row[4]; 
							$broker_income=$row[5];
					?>
						<tr>
							<!--here showing results in the table -->  
							<td><?php echo $counter++; ?></td>  
							<td><?php echo $broker_username; ?></td>  
							<td><?php echo $broker_email;  ?></td>
							<td><?php echo $broker_age;  ?></td> 
							<td>€<?php echo $broker_income;  ?></td>     
						</tr>  
	        		<?php } ?>
				</tbody>
			</table>
		</div>	
	</body>
</html>