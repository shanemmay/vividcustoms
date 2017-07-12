<?php

include("config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {  
   		$enteredPassword = md5($_POST['password']);
  	 $sql = "INSERT INTO `user`( `Firstname`, `Lastname`, `Username`, `Password`, `Role`, `Department`, `email`, `phone`) 
  		VALUES ('{$_POST['firstName']}','{$_POST['lastName']}','{$_POST['username']}','{$enteredPassword}','Customer','Customer','{$_POST['email']}','{$_POST['phone']}')";

      $result = mysqli_query($db,$sql);
      
      $_SESSION['login_user'] = $_POST['username'];
      header("location: ui.php");
  }
  
?>