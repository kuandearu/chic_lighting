<?php 
   include('../component/connect.php');
   session_start();
   session_unset();
   session_destroy();
   
   header('location:../user/user_login.php');
?>