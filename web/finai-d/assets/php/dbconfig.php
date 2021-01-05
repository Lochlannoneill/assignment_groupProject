<?php
//===================================================================================================================
//@Author: Gerardo Julio V. Ancheta Jr.
//Group 11
//Team members: Lochlann O Neill, Keith Bullman, Daniels Pikurs, Gerardo Ancheta Jr. 
//Module: Year 03 Group Project
//Date: 21/11/2020 
//Fin-Ai Web app
//dbconfig.php
//decrypted db
//===================================================================================================================

//------------------------------------------------------------------------------------------------------------------
//Connect to Database
//------------------------------------------------------------------------------------------------------------------
	$host = 'localhost';
	$dbUser = 'root';
	$dbPwd = '';
	$dbName = 'finai_ddb';
	
	$db = mysqli_connect($host, $dbUser, $dbPwd, $dbName);

//------------------------------------------------------------------------------------------------------------------
//Error Check
//------------------------------------------------------------------------------------------------------------------
	//Connection error output
	if (!$db){
		die('Could not Connect MySQL:' .mysql_error());
	}
	//Set the character set
	$charset_set = mysqli_set_charset ($db, 'utf8');

	//Character error output
	if (!$charset_set){
		echo '<p>Sorry! CanU+02019t set character set</p>';
	exit();
	}

?>