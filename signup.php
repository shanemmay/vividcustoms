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
      //print_r("Result :" . $result);
  }
  
?>

<?php 
/*
    echo "<table>";
    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
*/
?>
