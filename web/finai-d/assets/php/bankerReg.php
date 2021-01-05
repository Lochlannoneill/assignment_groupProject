<?php
//===================================================================================================================
//@Author: Gerardo Julio V. Ancheta Jr.
//Group 11
//Team members: Lochlann O Neill, Keith Bullman, Daniels Pikurs, Gerardo Ancheta Jr. 
//Module: Year 03 Group Project
//Date: 21/11/2020 
//Fin-Ai Web app
//bankerReg.php
//php for adminReg.php
//===================================================================================================================
if(isset($_POST['btnBankerReg'])){
//------------------------------------------------------------------------------------------------------------------
//Connect to Database
//------------------------------------------------------------------------------------------------------------------
    //include("assets/php/dbconfig.php");
    //include("dbconfig.php");  
    require_once 'dbconfig.php'; 
//------------------------------------------------------------------------------------------------------------------
//Initialize Variables
//------------------------------------------------------------------------------------------------------------------
    //here getting result from the post array after submitting the form.
    $admin_username = $_POST['admin_username'];
    $admin_email = $_POST['admin_email'];
    $admin_pwd = $_POST['admin_pwd'];
    //$admin_pwd = password_hash($admin_pwd, PASSWORD_DEFAULT);
//------------------------------------------------------------------------------------------------------------------
//Input Error Check
//------------------------------------------------------------------------------------------------------------------
    //Check if inputs are empty.
    if(empty($admin_username) || empty($admin_email) || empty($admin_pwd)){
        header("Location: adminReg.php?error=emptyfields");
        exit();
    }
    //Check if email input is valid.
    else if(!filter_var($admin_email, FILTER_VALIDATE_EMAIL)){
        header("Location: adminReg.php?error=invalidemail");
        exit();
    }
    //Check if username input characters are valid.
    else if(!preg_match("/^[a-zA-Z]*$/",$admin_username)){
        header("Location: adminReg.php?error=invalidusername");
        exit();
    }
//------------------------------------------------------------------------------------------------------------------
//Escape the admin input to make it safe to place in a query
//------------------------------------------------------------------------------------------------------------------
    $safe_admin_username = mysqli_real_escape_string($db, $admin_username);
    $safe_admin_email = mysqli_real_escape_string($db, $admin_email);
    $safe_admin_pwd = mysqli_real_escape_string($db, $admin_pwd);
    //$safe_hashedPwd = password_hash($safe_admin_pwd, PASSWORD_DEFAULT);    
//------------------------------------------------------------------------------------------------------------------
//MySQL Query
//------------------------------------------------------------------------------------------------------------------    
    //Here query check weather if banker already registered so can't register again.  
    $check_admin_username_query="SELECT * FROM banker_db WHERE admin_username='$safe_admin_username'";  
    $sql_query=mysqli_query($db,$check_admin_username_query);

    if(mysqli_num_rows($sql_query)>0){  
        header("Location: adminReg.php?error=userexist");  
        exit();  
    }
    //Insert the user into the database.  
    $insert_admin="INSERT INTO banker_db (admin_username, admin_email, admin_pwd) VALUES ('$safe_admin_username','$safe_admin_email','$safe_admin_pwd')";
    if(mysqli_query($db,$insert_admin)){  
        //echo"<script>window.open('admin_view.php','_self')</script>";
        header("Location: loginPage.php?register=success");
        exit();
    }     
    mysqli_close($db);    
}
?>