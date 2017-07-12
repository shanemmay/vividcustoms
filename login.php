<?php
   include("config.php");
   session_start();
   $error = "Your Login Name or Password is invalid";    
   if($_SERVER["REQUEST_METHOD"] == "POST") {      
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);    

      $mypassword = md5($mypassword);

      $sql = "SELECT id FROM user WHERE username = '{$myusername}' and Password = '{$mypassword}'";
      
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];      
      $count = mysqli_num_rows($result);         
      if($count > 0) {
        // session_register("myusername");
         $_SESSION['login_user'] = $myusername;  
         //echo "ok"; 
         header("location: dashboard.php");
      }
      else 
      {         
          header("location: login.html?c=fail");
         //$error = "Your Login Name or Password is invalid";        
         //header("location: login.html");
         //echo $error;
      }
   }
?>