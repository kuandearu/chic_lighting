<?php 
   include('../component/connect.php');
   session_start();
   session_unset();
   session_destroy();
   
   header('location:../component/admin_login.php');
?>