<?php

include("config.php");
   session_start();
 ?>  
<table>
<?php 
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
?>
</table>
<?php
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   { 
   
      if ($_POST['pickup'] == 1) 
      {	
      	$sql = "INSERT INTO `sale`( `Name`, `Phone`, `Email`, `Payment`, `Product`, `Quantity`, `Size`, `Color`, `Pickup`, `ShippingType`, `HouseNumber`, `Street`, `State`, `Country`, `Zip`, `Shipped`) 
      		VALUES ('{$_POST['name']}','{$_POST['phone']}','{$_POST['email']}','{$_POST['paymentinfo']}','{$_POST['productinfo']}','{$_POST['quantity']}','{$_POST['size']}','{$_POST['color']}',{$_POST['pickup']},'{$_POST['ShippingType']}','{$_POST['number']}','{$_POST['street']}','{$_POST['state']}','USA','{$_POST['postalcode']}','CREATED')";
      }
      else
      {
      	$sql = "INSERT INTO `sale`( `Name`, `Phone`, `Email`, `Payment`, `Product`, `Quantity`, `Size`, `Color`, `Pickup`, `Shipped`) 
      		VALUES ('{$_POST['name']}','{$_POST['phone']}','{$_POST['email']}','{$_POST['paymentinfo']}','{$_POST['productinfo']}','{$_POST['quantity']}','{$_POST['size']}','{$_POST['color']}',{$_POST['pickup']},'CREATED')";
      }
   }

    $result = mysqli_query($db,$sql);
     // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);         
      //$count = mysqli_num_rows($result);         
      if(!$result) {       
             
         //header("location: checkout.php");
      }
      else 
      {
         //$error = "Your Login Name or Password is invalid";        
         //header("location: congratulation.html");
      }

?>