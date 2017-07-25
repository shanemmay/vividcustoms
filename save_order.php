<?php

include("config.php");
   session_start();
 ?>  
<!--in array : creating and testing php object to hold item-->
<?php
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
        $result = mysqli_query($db,$sql);
        echo "cart query result : ";
        print_r($result);
      }
      //}

      if ($_POST['pickup'] != 1 ) 
      {	echo "<h1>start sale sql query</h1>";
      	$sql = "INSERT INTO `sale`( `Name`, `Phone`, `Email`, `OrderNumber`, `nameOnCard`, `cardNumber`, `expirationDate`, `securityCode`, `billingStreet`, `billingCity`, `billingState`, `billingZip`, `ShippingType`, `shipStreet`, `shipCity`, `shipState`, `shipZip`, `total`, `Shipped`) 
        VALUES ('{$_POST['name']}','{$_POST['phone']}','{$_POST['email']}','{$_POST['ordernumber']}','{$_POST['nameOnCard']}','{$_POST['cardNumber']}','{$_POST['expirationDate']}','{$_POST['securityCode']}','{$_POST['billingStreet']}','{$_POST['billingCity']}','{$_POST['billingState']}','{$_POST['billingZip']}','{$_POST['shippingType']}','{$_POST['shipStreet']}','{$_POST['shipCity']}','{$_POST['shipState']}','{$_POST['shipZip']}','{$_POST['total']}',false)";
      }
      else
      { echo "<h1>start sale sql query</h1>";
      	$sql = "INSERT INTO `sale`( `Name`, `Phone`, `Email`, `OrderNumber`, `nameOnCard`, `cardNumber`, `expirationDate`, `securityCode`, `billingStreet`, `billingCity`, `billingState`, `billingZip`, `ShippingType`, `total`, `Shipped`) 
        VALUES ('{$_POST['name']}','{$_POST['phone']}','{$_POST['email']}','{$_POST['ordernumber']}','{$_POST['nameOnCard']}','{$_POST['cardNumber']}','{$_POST['expirationDate']}','{$_POST['securityCode']}','{$_POST['billingStreet']}','{$_POST['billingCity']}','{$_POST['billingState']}','{$_POST['billingZip']}','{$_POST['shippingType']}','{$_POST['total']}',false)";
      }
   }

    $result = mysqli_query($db,$sql);
    echo "cart query result : ";
    print_r($result);
    echo "<h1>end sale sql query</h1>";
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
