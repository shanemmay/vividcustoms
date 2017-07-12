<?php
   include('config.php');
   session_start();     
   if (!isset($_SESSION['login_user'])) 
   {   	
      $Guest = true;     
      $fullname = ""; 
      $email = "";
      $phone = ""; 
      if (!isset($_SESSION['Guest'])) {             
         $login_session = '';        
      }
      else
      {              
         $login_session = $_SESSION['Guest'] ;            
      }         
   }   
   else
   {   
         $user_check = $_SESSION['login_user'];
         $ses_sql = mysqli_query($db,"select username,CONCAT(Firstname,' ',Lastname) as fullname, email, phone from user where username = '$user_check' ");         
         $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);    
         $Guest = false;
         $login_session = $row['username'];  
         $fullname = $row['fullname']; 
         $email = $row['email']; 
         $phone = $row['phone'];  
   }
   
  	
?>