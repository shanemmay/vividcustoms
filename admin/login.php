<?php
   define('DB_SERVER', '162.144.194.87');
   define('DB_USERNAME', 'vividcus_root');
   define('DB_PASSWORD', 'sheldon1');
   define('DB_DATABASE', 'vividcus_vividcustom');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if(mysqli_connect_errno()){
    $db = mysqli_connect("localhost","root","","vividcustoms");
   }else{
    
   }
   session_start();
   $error = "Your Login Name or Password is invalid";    
   if($_SERVER["REQUEST_METHOD"] == "POST") {      
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);    

      echo $username;

      $mypassword = md5($mypassword);

      $sql = "SELECT id FROM user WHERE username = '{$myusername}' and Password = '{$mypassword}'";
      
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];      
      $count = mysqli_num_rows($result);         
      if($count > 0) {
        // session_register("myusername");
         $_SESSION['login_user'] = $myusername;  
         
         header("location: main.php?page=Dashboard");
         
      }
      else 
      {         
          header("location: main.php?c=fail");
      }
   }
?>
</html>




