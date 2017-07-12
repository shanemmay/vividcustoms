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
?>