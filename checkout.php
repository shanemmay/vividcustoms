<?php
   include('session.php');
?>
<html>
<head>
    <title>Checkout</title>
    <script src="fabric.min.js"></script>
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

    <!--BOOTSTRAP 4 INFO-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!--BOOTSRAP 3 INFO <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Niconne" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
    <style type="text/css">
		input[type="number"]::-webkit-outer-spin-button,
		input[type="number"]::-webkit-inner-spin-button {
		    -webkit-appearance: none;
		    margin: 0;
		}
		input[type="number"] {
		    -moz-appearance: textfield;
		}
        body{
            background-color: #000000;
        }
        img:hover{
            background-color: #eeeeee;
            border: 1px solid #000000;
        }
        .active{
            border: 1px solid #eeeeee;
            background: none !important;
        }
    </style>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>    
    <h3>
        	<?php echo ("<center> Order number: ".$_POST['ordernumber']."</center>");    ?>
    </h3> 
    <form  name="Checkout" action="save_order.php" method="POST" role="form" onchange="checkInput();" > 
        <div class="row">
          	<div class="col-3"></div>
          	<div class="col-6">
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
				
				<div class="panel panel-info class" id="paymentInformation">
					<div class="panel-heading">Payment Information</div>
					<div class="panel-body">
					    <p>Add option here for selecting payment type</p>
					    <label for="usr">Name on card:</label>
					    <input id="nameOnCard" type="text" class="form-control" name="nameOnCard" >
					    <label for="usr">Card Number:</label>
					    <input id="cardNumber" type="number" class="form-control" name="cardNumber" >
					    <label for="usr">Expiration Date:</label>
					    <input id="expirationDate" type="number" class="form-control" name="expirationDate" >
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
				<div class="panel-group">
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
	                  		
							<!--creating inputs for cart-->
							<?php
								//here we are filling hidden inputs with the information for the cart.
								//we are using $i to keep track of products and designs
								$i = 1;  
							    foreach ($_POST as $key => $value) {
							    	if($key != "total" && $key != "ordernumber"){
							    		$name = substr($key,0, -2);
								        /*echo "<tr>";
								        echo "<td>";
								        echo $name."_".$i; //$key
								        echo "</td>";
								        echo "<td>";*/
								        echo "<input name='".$name."_".$i."' type='hidden' value='".$value."'>";
								        /*echo "</td>";
								        echo "</tr>";*/
								    }else{
								    	/*echo "<tr>";
								        echo "<td>";
								        echo $key;
								        echo "</td>";
								        echo "<td>";*/
								        echo "<input name='".$key."' type='hidden' value='".$value."'>";
								        /*echo "</td>";
								        echo "</tr>";*/
								    }
								    $i += (strpos($key, "left") !== false ? 1 : 0);
							    }
							?>
							<!--the line below holds the total for the order so that it can be included in the price and saved-->
							<input type="hidden" name="total" value="<?php echo $_POST['total']; ?>">
							<input type="hidden" name="ordernumber" value="<?php echo $_POST['ordernumber']; ?>">
							<button id="submit" type="submit" class="btn btn-outline-success" >Place Order</button>
	                  </div>
	                   <div class="col-sm-5"></div>
	                  
	               	</div>   
      			</div>
          	</div>
          	<div class="col-3">
          		<!--test printing results from ui-->
				<table>
				<?php 
					//here we are filling hidden inputs with the information for the cart.
					//we are using $i to keep track of products and designs
					/*$i = 1;  
				    foreach ($_POST as $key => $value) {
				    	if($key != "total" && $key != "ordernumber"){
				    		$name = substr($key,0, -2);
					        echo "<tr>";
					        echo "<td>";
					        echo $name."_".$i; //$key
					        echo "</td>";
					        echo "<td>";
					        //echo "<input name='".$name."_".$i."' type='text' value='".$value."'>";
					        echo $value;
					        echo "</td>";
					        echo "</tr>";
					    }else{
					    	echo "<tr>";
					        echo "<td>";
					        echo $key;
					        echo "</td>";
					        echo "<td>";
					        //echo "<input name='".$key."' type='text' value='".$value."'>";
					        echo $value;
					        echo "</td>";
					        echo "</tr>";
					    }
					    $i += (strpos($key, "left") !== false ? 1 : 0);
				    }*/
				?>
				</table>
          	</div>
        </div>
    </form>

    <h1 id="test"></h1>
    <script type="text/javascript">
      //submit button will only be shown when all information is entered
      var submitBtn = document.getElementById('submit');
      submitBtn.disabled = true;
      var name = document.getElementById('name');
      var phone = document.getElementById('phone');
      var email = document.getElementById('email');
      var nameOnCard = document.getElementById('nameOnCard');
      var cardNumber = document.getElementById('cardNumber');
      var expirationDate = document.getElementById('expirationDate');
      var securityCode = document.getElementById('securityCode');
      var billingStreet = document.getElementById('billingStreet');
      var billingCity = document.getElementById('billingCity');
      var billingState = document.getElementById('billingState');
      var billingZip = document.getElementById('billingZip');
      var shippingType1 = document.getElementById('shippingType1');
      var shippingType2 = document.getElementById('shippingType2');
      var shippingType3 = document.getElementById('shippingType3');
      var shipStreet = document.getElementById('shipStreet');
      var shipCity = document.getElementById('shipCity');
      var shipState = document.getElementById('shipState');
      var shipZip = document.getElementById('shipZip');
      //setting billing address as default shipping address
      billingStreet.onchange = function(){ shipStreet.value = billingStreet.value;  };
      billingCity.onchange = function (){ shipCity.value = billingCity.value;  };
      billingState.onchange = function(){ shipState.value = billingState.value;  };
      billingZip.onchange = function(){ shipZip.value = billingZip.value;  };
      //checking if all user input has been entered TODO make sure cart is not empty
      /*TODO CHANGE THIS PART WHEN THEY ARE MULITPLE WAYS TO PAY*/
      function checkInput(){
        if(name.value != "" && phone.value != "" && email.value != "" && 
         nameOnCard.value != "" && cardNumber.value != "" && expirationDate.value != "" && securityCode.value != "" && 
         billingStreet.value != "" && billingCity.value != "" && billingState.value != "" && billingZip.value != ""){
          submitBtn.disabled = false;
        }else{
          submitBtn.disabled = true;
        }
      }

      function setDesign(element){
      	var design = document.getElementById('design');
      	design.src = element.src;
      }
      /*COMMENTED OUT BECAUSE THIS CODE IS USED NO WHERE
      function setProduct(element){
      	var shirt = document.getElementById('shirt');
      	shirt.style.backgroundImage = "url('"+element.src+"')";
      }*/

      var rowNum = 0;	//this is used to keep track of the current row number since rows will be added and deleted according to the customer's will
      var prices = [];
      function addToCart(){
      	var table = document.getElementById('cart');
      	var row = table.insertRow(rowNum);
      	row.className = "table-info";

      	
      	var cell0 = row.insertCell(0);
      	var cell1 = row.insertCell(1);
      	var cell2 = row.insertCell(2);
      	var cell3 = row.insertCell(3);
      	var cell4 = row.insertCell(4);
      	var cell5 = row.insertCell(5);
      	var cell6 = row.insertCell(6);

      	//SIZES!!!
      	prices[rowNum] = ((rowNum + 1) * Math.random() * 10).toFixed(2);	//TODO change this to actual price later
      	cell0.innerHTML =  rowNum; 
      	cell1.innerHTML = "<img src='img/image.png' style='width: 32px;'>";
      	cell2.innerHTML = "$" + prices[rowNum];
      	cell3.innerHTML = "<button id='"+rowNum+"' type='button' class='btn btn-outline-danger' onclick='removeFromCart(this);'>&times;</button>"; //took this out of button <img src='img/trash_icon.png' style='width: 16px;'>
      	rowNum++;
      	getTotal();
      }
      function removeFromCart(row){
      	var table = document.getElementById('cart');
      	table.deleteRow(row.id);
      	prices.splice(row.id,1);
      	getTotal();
      }
      //TODO put total in hidden input so we know how much to charge and can store it in our database
      function getTotal(){
      	var total = 0.00;
      	
      	for(var i = 0; i < prices.length; i++){ 
      		document.getElementById('test').innerHTML += " " + prices[i];
      		total += Number(prices[i]);
      	}
      	document.getElementById('test').innerHTML += " <br> ";
      	document.getElementById('total').innerHTML = '$' + total.toFixed(2);
      }
      //TODO if any part of the shipping address is left blank, use the billing address
      //alert('js works');
    </script>

</body>
</html>