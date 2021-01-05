<?php
//===================================================================================================================
//@Author: Gerardo Julio V. Ancheta Jr.
//Group 11
//Team members: Lochlann O Neill, Keith Bullman, Daniels Pikurs, Gerardo Ancheta Jr. 
//Module: Year 03 Group Project
//Date: 21/11/2020 
//Fin-Ai Web app
//brokerReg.php
//===================================================================================================================
if(isset($_POST['btnRegister'])){
//------------------------------------------------------------------------------------------------------------------
//Connect to Database
//------------------------------------------------------------------------------------------------------------------
    require_once 'dbconfig.php';
//------------------------------------------------------------------------------------------------------------------
//Initialize Variables
//------------------------------------------------------------------------------------------------------------------
    //here getting result from the post array after submitting the form.
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_pwd = $_POST['user_pwd'];
    //$user_pwd = password_hash($user_pwd, PASSWORD_DEFAULT);
//------------------------------------------------------------------------------------------------------------------
//Input Error Check
//------------------------------------------------------------------------------------------------------------------
    //Check if inputs are empty.
    if(empty($username) || empty($user_email) || empty($user_pwd)){
        header("Location: registerPage.php?error=emptyfields");
        exit();
    }
    //Check if email input is valid.
    else if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        header("Location: registerPage.php?error=invalidemail");
        exit();
    }
    //Check if username input characters are valid.
    else if(!preg_match("/^[a-zA-Z]*$/",$username)){
        header("Location: registerPage.php?error=invalidusername");
        exit();
    }
//------------------------------------------------------------------------------------------------------------------
//Escape the admin input to make it safe to place in a query
//------------------------------------------------------------------------------------------------------------------
        $safe_username = mysqli_real_escape_string($db, $username);
        $safe_user_email = mysqli_real_escape_string($db, $user_email);
        $safe_user_pwd = mysqli_real_escape_string($db, $user_pwd);
        //$safe_hashedPwd = password_hash($safe_user_pwd, PASSWORD_DEFAULT);    
//------------------------------------------------------------------------------------------------------------------
//MySQL Query
//------------------------------------------------------------------------------------------------------------------    
    //Here query check weather if broker already registered so can't register again.  
    $check_username_query="SELECT username FROM broker_db WHERE username='$safe_username'";  
    $sql_query=mysqli_query($db,$check_username_query);

    if(mysqli_num_rows($sql_query)>0){  
        header("Location: registerPage.php?error=userexist");  
        exit();  
    }
    //Insert the user into the database.  
    $insert_user="INSERT INTO broker_db (username, user_email, user_pwd) VALUES ('$safe_username','$safe_user_email','$safe_user_pwd')";  
    if(mysqli_query($db,$insert_user)){  
        //echo"<script>window.open('dashboard.php','_self')</script>";
        header("Location: loginPage.php?register=success");
        exit();
    }     
    mysqli_close($db);
}
?>