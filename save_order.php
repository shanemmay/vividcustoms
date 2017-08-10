<?php
ob_start();
include("config.php");
   session_start();
 ?>  
<!--in array : creating and testing php object to hold item-->
<?php
  //creating an array of designs for automatic email being sent to customer
  $email_design = array();
  //array to hold items
  $items = array();
  $items_index = 0;
  //each item is stored uniquely by having a number attached to the name of each attribute.
  //the following array is used to store the appropriate numbers
  $nameNums = array();
  $nameNumsIndex = 0;
  class Item
  {
    var $product; var $yxs; var $ys; var $ym; var $yl; var $yxl; var $s; var $m; var $l; var $xl; var $_2xl; var $_3xl; var $_4xl; var $_5xl; var $itemTotal; var $front; var $right; var $back; var $left; 
    function Item($product, $yxs, $ys, $ym, $yl, $yxl, $s, $m, $l, $xl, $_2xl, $_3xl, $_4xl, $_5xl, $itemTotal, $front, $right, $back, $left)
    {
      $this->product = $product;
      $this->yxs = $yxs;
      $this->ys = $ys;
      $this->ym = $ym;
      $this->yl = $yl;
      $this->yxl = $yxl;
      $this->s = $s; 
      $this->m = $m;
      $this->l = $l;
      $this->xl = $xl;
      $this->_2xl = $_2xl;
      $this->_3xl = $_3xl;
      $this->_4xl = $_4xl;
      $this->_5xl = $_5xl;
      $this->itemTotal = $itemTotal;
      $this->front = $front;
      $this->right = $right;
      $this->back = $back;
      $this->left = $left;
      //echo "<h1>Mark Hit</h1>";
    }
  }

  
?>
<h1>Items</h1>
<table>
<?php 
    foreach ($_POST as $key => $value) {
      for ($i=1; $i <= count($_POST) ; $i++) 
      {
        
        if(strpos($key,"product") !== false && substr($key,-1) == $i){
          //storing the unique number in an array
          $nameNums[$nameNumsIndex] = $i;
          $nameNumsIndex++;
          //creating a new item to hold all the attributes of the item being purchased
          $item = new Item(
            $_POST['product_'.$i], $_POST['yxs_'.$i], $_POST['ys_'.$i], $_POST['ym_'.$i], $_POST['yl'.'_'.$i],  $_POST['yxl'.'_'.$i],  $_POST['s'.'_'.$i],  
            $_POST['m'.'_'.$i],  $_POST['l'.'_'.$i],  $_POST['xl'.'_'.$i],  $_POST['2xl'.'_'.$i],  $_POST['3xl'.'_'.$i],  $_POST['4xl'.'_'.$i],  $_POST['5xl'.'_'.$i], 
             $_POST['itemTotal'.'_'.$i], $_POST['front'.'_'.$i],  $_POST['right'.'_'.$i],  $_POST['back'.'_'.$i],  $_POST['left'.'_'.$i]
            );
          //storing the designs in array so that it can be used for the email
          array_push($email_design, $_POST['product_'.$i]);
          array_push($email_design, $_POST['front_'.$i]);
          array_push($email_design, $_POST['right_'.$i]);
          array_push($email_design, $_POST['back_'.$i]);
          array_push($email_design, $_POST['left_'.$i]);
          //storing the item in an array called items to be added to the cart
          $items[$items_index] = $item;
          $items_index++;
        }
      }

        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }

    //printing everthing in the items array
    foreach ($items as $key => $value)
    {
      print_r( $key );
      echo "_";
      print_r($value);
      echo "<hr>";
    }
?>
</table>
<hr>
<?php
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   { 
      //adding products to cart table.
      //foreach ($items as $key => $value) {
      for ($i=0; $i < count($items); $i++) { 
 
        $sql = "INSERT INTO `cart`
        ( `OrderNumber`, `Product`, `yxs`, `ys`, `ym`, `yl`, `yxl`, `s`, `m`, `l`, `xl`, `_2xl`, `_3xl`, `_4xl`, `_5xl`, `_front`, `_right`, `_back`, `_left`, `Price`) 
        VALUES 
        ('{$_POST['ordernumber']}', '{$items[$i]->product}', '{$items[$i]->yxs}', '{$items[$i]->yxs}', '{$items[$i]->ys}', '{$items[$i]->ym}', '{$items[$i]->yl}', '{$items[$i]->yxl}', '{$items[$i]->s}', '{$items[$i]->m}', '{$items[$i]->xl}', '{$items[$i]->_2xl}', '{$items[$i]->_3xl}', '{$items[$i]->_4xl}', '{$items[$i]->_5xl}', '{$items[$i]->front}', '{$items[$i]->right}', '{$items[$i]->back}', '{$items[$i]->left}', '{$items[$i]->itemTotal}'/*'{$value->product}','{$value->yxs}','{$value->ys}','{$value->ym}','{$value->yl}','{$value->yxl}','{$value->s}','{$value->m}','{$value->l}','{$value->xl}','{$value->_2xl}','{$value->_3xl}','{$value->_4xl}','{$value->_5xl}','{$value->front}','{$value->right}','{$value->back}','{$value->left}'*/)";
        echo "<h1>cart sql query results</h1>";
        $result = mysqli_query($db,$sql);
        echo "cart query result : ";
        print_r($result);
      }
      //}

      if ($_POST['pickup'] != 1 ) 
      {	
      	$sql = "INSERT INTO `sale`( `Name`, `Phone`, `Email`, `OrderNumber`, `nameOnCard`, `cardNumber`, `expirationDate`, `securityCode`, `billingStreet`, `billingCity`, `billingState`, `billingZip`, `ShippingType`, `shipStreet`, `shipCity`, `shipState`, `shipZip`, `total`, `Shipped`) 
        VALUES ('{$_POST['name']}','{$_POST['phone']}','{$_POST['email']}','{$_POST['ordernumber']}','{$_POST['nameOnCard']}','{$_POST['cardNumber']}','{$_POST['expirationDate']}','{$_POST['securityCode']}','{$_POST['billingStreet']}','{$_POST['billingCity']}','{$_POST['billingState']}','{$_POST['billingZip']}','{$_POST['shippingType']}','{$_POST['shipStreet']}','{$_POST['shipCity']}','{$_POST['shipState']}','{$_POST['shipZip']}','{$_POST['total']}',false)";
      }
      else
      { 
      	$sql = "INSERT INTO `sale`( `Name`, `Phone`, `Email`, `OrderNumber`, `nameOnCard`, `cardNumber`, `expirationDate`, `securityCode`, `billingStreet`, `billingCity`, `billingState`, `billingZip`, `ShippingType`, `total`, `Shipped`) 
        VALUES ('{$_POST['name']}','{$_POST['phone']}','{$_POST['email']}','{$_POST['ordernumber']}','{$_POST['nameOnCard']}','{$_POST['cardNumber']}','{$_POST['expirationDate']}','{$_POST['securityCode']}','{$_POST['billingStreet']}','{$_POST['billingCity']}','{$_POST['billingState']}','{$_POST['billingZip']}','{$_POST['shippingType']}','{$_POST['total']}',false)";
      }
   }

    echo "<h1>sale sql query results</h1>";
    $result = mysqli_query($db,$sql);
    echo "cart query result : ";
    print_r($result);

  
/*EMAIL SECTION*/
//creating design preview for email
$message_design = "<table><tbody>";
for ($i=0; $i < count($email_design); $i+=5) { 
  $message_design .= "
    <tr>
      <td><div style='background-image: ".$email_design[$i]."; background-repeat: no-repeat; background-size: cover; background-position: center center; width: 300px; height: 400px;'>
      <img src='".$email_design[$i+1]."' style='padding-top:45px; padding-left:35px; padding-right:35px; width: 230px; height: 315px; position: relative; margin: auto; '>
      </div> </td>
      <td><div style='background-image: ".$email_design[$i]."; background-repeat: no-repeat; background-size: cover; background-position: center center; width: 300px; height: 400px;'>
      <img src='".$email_design[$i+2]."' style='padding-top:40px; padding-left:30px; padding-right:30px; width: 240px; height: 320px; position: relative; margin: auto; '>
      </div></td>
      <td><div style='background-image: ".$email_design[$i]."; background-repeat: no-repeat; background-size: cover; background-position: center center; width: 300px; height: 400px;'>
      <img src='".$email_design[$i+3]."' style='padding-top:40px; padding-left:30px; padding-right:30px; width: 240px; height: 320px; position: relative; margin: auto; '>
      </div> </td>
      <td><div style='background-image: ".$email_design[$i]."; background-repeat: no-repeat; background-size: cover; background-position: center center; width: 300px; height: 400px;'>
      <img src='".$email_design[$i+4]."' style='padding-top:40px; padding-left:30px; padding-right:30px; width: 240px; height: 320px; position: relative; margin: auto; '>
      </div></td>
    </tr>

  ";
}
$message_design .= "</tbody></table>";

$to = $_POST['email'];
$subject = "Order Received!";
$from = "info@vividcustoms.com";
$message = "<!DOCTYPE html>
<html>
<head>
  <title>Design</title>
</head>
<body style='text-align: center; color: #0000ff;'>
<h1>Order : ".$_POST['ordernumber']." has been received and is being processed.</h1>
".$message_design."

<h2>Shipping Info: </h2>

  <h3>Shipping Type : ".$_POST['shippingType']."</h3>
  <h3>".$_POST['shipStreet']."</h3>
  <h3>".$_POST['shipCity'].",".$_POST['shipState']." ".$_POST['shipZip']."</h3>

<h2>Total: $".$_POST['total']."</h2>  
<h3>Our representative is available to assist you!</h3>
<p>Monday - Friday | 9:00 AM - 5:00 PM Central Standard Time</p>
<table border='0' align='center'>
  <tbody>
    <tr>
      <td><h3>Phone : (832) 429-7699 |</h3></td>
      <td><h3>Online : Live Chat! |</h3></td>
      <td><h3>Email : info@vividcustoms.com |</h3></td>
      <td><h3>In Person : 6222 Gessner Rd unit C, Houston Texas 77040</h3></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>


</body>
</html>";

$headers = "From: info@vividcustoms.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 

mail($to,   $subject,   $message, $headers);
header('Location: ui.php');

/*
if (filter_var($to, FILTER_VALIDATE_EMAIL)) 
{
    $success = mail($to,   $subject,   $message, $headers);
    if ($success) 
    {
      header('Location: ui.php');
      exit;  
    }
    else
    {
       //Error server sending the email
    }
}
else
{
    //email address incorrect.
}
*/
ob_end_flush();

?>
