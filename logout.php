<?php 
    session_start();
    if(isset($_SESSION['loggedin']) || $_SESSION['loggedin'] = true){
        unset($_SESSION['loggedin']);
        unset($_SESSION['email']);
    }
    //setcookie('username',$username,time()-3600 * 24,'/'); //if we have to use multiple accounts in one pc then uncomment this , else comment this , as the cookie will be set for 24 hours of single user assuming that it is system for single user 
    session_destroy();
    header("Location:login.php");
?>