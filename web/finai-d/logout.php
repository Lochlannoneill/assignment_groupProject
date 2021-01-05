<?php  
//===================================================================================================================
//@Author: Gerardo Julio V. Ancheta Jr.
//Group 11
//Team members: Lochlann O Neill, Keith Bullman, Daniels Pikurs, Gerardo Ancheta Jr. 
//Module: Year 04 Group Project
//Date: 21/11/2020 
//Fin-Ai Web app
//logout.php
//===================================================================================================================
  
session_start();//session is a way to store information (in variables) to be used across multiple pages.
session_unset();  
session_destroy();  
header("Location: index.html");//use for the redirection to some page  
?> 