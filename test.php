<?php
  include 'session.php';

?>
<html>
<head>
    <title>ui</title>
    <script src="fabric.min.js"></script>
    <!--FONT AWESOEM-->
    <link rel="stylesheet" href="https://use.fontawesome.com/42fa7d18a0.css">
    <script src="https://use.fontawesome.com/0bc1ca65b8.js"></script>

    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    
    <!--BOOTSRAP 3-->
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Niconne" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">    
    <!--CSS-->
    <!--<link rel="stylesheet" type="text/css" href="css/main.css">
    to replace style tags on this page-->
    <link rel="stylesheet" type="text/css" href="css/style.css">   
    <style type="text/css">
 

    </style>
    <script src="lib/fabric.js"></script>   
    
</head>
<body>       
 <form  name="Checkout" action="save_order.php" method="POST" role="form" onchange="checkInput();" > 
<div class="panel panel-default">
<div class="panel-heading">
 <div class="row">
  <div class="col-sm-2">
      <img src="https://vividcustoms.com/skin/frontend/tv_nautica_package/tv_nautica8/images/logo.png">
  </div>
  <div class="col-sm-8">
      
  </div>
  <div class="col-sm-2">
      <?php 
    if (!$Guest) {
        echo 'Welcome: '.$login_session; 
        echo  '<h2><a href = "logout.php">Sign Out</a></h2>';    
    }  
    else if (isset($_SESSION['Guest'])) 
    {
        echo ("<left> Order number: ".$_SESSION['Guest']."</left>");             
    }          
?>
  </div>
</div> 



</div>
  <div class="panel-body">
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-info class">
                  <div class="panel-heading">Contact Information</div>
                  <div class="panel-body" >
                      <label for="usr">Name:</label>
                      <input id="name" type="text" class="form-control" name="name"  value="<?php echo( htmlspecialchars( $fullname ) ); ?>">
                      <label for="usr">Phone:</label>
                      <input id="phone" type="text" class="form-control" name="phone" value="<?php echo( htmlspecialchars( $phone ) ); ?>">
                      <label for="usr">Email:</label>
                      <input id="email" type="email" class="form-control" name="email" value="<?php echo( htmlspecialchars( $email ) ); ?>">    
                  </div>
                </div>
                     <div class="panel panel-info class">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            Shipping Information <!--<a data-toggle="collapse" href="#collapse1">Shipping Information</a>-->
                          </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse "> <!--collapse was taken out of the class attribute-->
                            <div class="panel-body">
                              <!--<label for="usr">Pickup:</label>-->                        
                                <div name="pickup" id="pickup"> 
                                    <!--<label class="radio-inline"><input type="radio" name="pickup" id="pickupNo" value="0" data-parent="#parent" data-toggle="collapse" data-target="#div1" checked="true" >NO</label>
                                    <label class="radio-inline"><input type="radio" name="pickup" id="pickupYes" value="1" data-parent="#parent" data-toggle="collapse" data-target="#div1" >YES</label>-->
                                    <div class="panel-collapse collapse in" id="div1">  
                                        <label for="usr">Shipping Type:</label>
                                        <label class="radio-inline"><input type="radio" name="shippingType" id="pickup" value="pickup" >In Store Pick Up</label>
                                        <label class="radio-inline"><input type="radio" name="shippingType" id="shippingType1" value="standard" checked="checked">Standard</label>
                                        <label class="radio-inline"><input type="radio" name="shippingType" id="shippingType2" value="expedited">Expedited</label>
                                        <label class="radio-inline"><input type="radio" name="shippingType" id="shippingType3" value="express">Express</label>
                                        <br>
                                        <label for="usr">Street:</label>
                                        <input id="shipStreet" type="text" class="form-control" name="shipStreet" >
                                        <label for="usr">City / Town:</label>
                                        <input id="shipCity" type="text" class="form-control" name="shipCity" >
                                        <label for="usr">State / Province / Region:</label>
                                        <input id="shipState" type="text" class="form-control" name="shipState" >
                                        <label for="usr">Zip / Postal Code:</label>
                                        <input id="shipZip" type="text" class="form-control" name="shipZip" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="panel panel-warning class">
                      <div class="panel-heading">Shipping Options</div>
                      <div class="panel-body">Shipping Options Content</div>
                    </div>-->
                    <br>
                    <div class="row">
                      <div class="col-sm-5"></div>
                      <div class="col-sm-2">
                            <!--the line below holds the total for the order so that it can be included in the price and saved-->
                            <input type="hidden" name="total" value="<?php echo $_POST['total']; ?>">
                            <button id="submit" type="submit" class="btn btn-outline-success" >Place Order</button>
                      </div>
                       <div class="col-sm-5"></div>
                      
                    </div>  
    </div>
    <div class="col-sm-6">
        <div class="panel panel-info class" id="paymentInformation">
                    <div class="panel-heading">Payment Information</div>
                    <div class="panel-body">
                        <p>Add option here for selecting payment type</p>
                        <label for="usr">Name on card:</label>
                        <input id="nameOnCard" type="text" class="form-control" name="nameOnCard" >
                        <label for="usr">Card Number:</label>
                        <input id="cardNumber" type="number" class="form-control" name="cardNumber" >
                        <label for="usr">Expiration Date:</label>
                        <input id="expirationDate" type="date" class="form-control" name="expirationDate" >
                        <label for="usr">Security Code:</label>
                        <input id="securityCode" type="number" class="form-control" name="securityCode" >
                        <div class="panel-heading">Billing Address</div>
                        <label for="usr">Street:</label>
                        <input id="billingStreet" type="text" class="form-control" name="billingStreet" >       
                        <label for="usr">City:</label>
                        <input id="billingCity" type="text" class="form-control" name="billingCity" >       
                        <label for="usr">State:</label>
                        <input id="billingState" type="text" class="form-control" name="billingState" >       
                        <label for="usr">Zip:</label>
                        <input id="billingZip" type="text" class="form-control" name="billingZip" >       
                    </div>
                </div>
    </div>
    <div class="col-sm-6">
     <div class="panel-group">
                
                </div>
    </div>
  </div>
</div> 
</div>
  <div class="panel-footer">Panel Footer</div>
</div>
</form>
</body>
</html>