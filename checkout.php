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
        <?php 
            if (!$Guest) {
                echo 'Welcome: '.$login_session; 
                echo  '<h3><a href = "logout.php">Sign Out</a></h3>';    
            }  
             else if (isset($_SESSION['Guest'])) 
            {
              echo ("<center> Order number: ".$_SESSION['Guest']."</center>");         
            }           
        ?>
    </h3> 
    <form  name="Checkout" action="save_order.php" method="POST" role="form" onchange="checkInput();" > 
        <div class="row">
          	<div class="col-2"></div>
          	<div class="col-8">
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
				<!--PRODUCT PICKER
				<div class="panel panel-info class" style="height: 60vh;">
				  <div class="panel-heading"><a data-toggle="collapse" href="#oderInfo">Order Information</a></div>
				  <div id="oderInfo" class="panel-collapse " >
				  <div class="panel-body">
				        <div class="container-fliud row">
				          <div class="col"> <button class="btn btn-outline-primary" data-toggle="collapse" href="#designs" style="color: #0892D0;"> Designs</button></div><div class="col-9"></div>
				          <div class="col"> <button class="btn btn-outline-primary" data-toggle="collapse" href="#products" style="color: #0892D0;">Products </button></div>
				        </div>
				        <div class="row">
							<div class="col-4">
								<div id="designs" class="panel-collapse collapse" > 
								    <div class="row">
								      <div class="col"> <img src="img/clip_4.png" class="rounded" alt="..." style="width: 100%;" onclick="setDesign(this);"> </div>
								      <div class="col"> <img src="img/clip_1.png" class="rounded" alt="..." style="width: 100%;" onclick="setDesign(this);"> </div>
								      <div class="col"> <img src="img/clip_1.png" class="rounded" alt="..." style="width: 100%;" onclick="setDesign(this);"> </div>
								      <div class="col"> <img src="img/clip_1.png" class="rounded" alt="..." style="width: 100%;" onclick="setDesign(this);"> </div>
								    </div>
								</div> 
							</div>
							<div class="col-4">
								
								<div id="shirt" style="padding-top: 5%; height: 30vh; width: 100%; display: block; margin: auto; margin-top: auto; background-image: url('img/shirt_heather_sapphire.jpg');  background-repeat: no-repeat; background-size: cover; background-position: center center;">
								  <img id="design" src="img/clip_1.png" style="width: 20%; display: block; margin: auto; margin-top: 25%;">
								</div>
								
								<div>
									<h6>Product description populated here be either ajax or already loaded in when the page loads</h6>
									<form >
										<p style="text-align: center;">Enter sizes:</p>
										<hr>
										<div class="row">
											<div class="col-4"><input id="sNum" type="number" name="s" placeholder="S" style="width: 100%;"></div>
											<div class="col-4"><input id="mNum" type="number" name="m" placeholder="M" style="width: 100%;"></div>
											<div class="col-4"><input id="lNum" type="number" name="l" placeholder="L" style="width: 100%;"></div>
										</div>
										<button type="button" class="btn btn-outline-success" onclick="addToCart();" style="display: block; margin: auto;">ADD TO CART</button>
									</form>
								</div>
							</div>
							<div class="col-4">
							  	<style type="text/css">
							  		#products{
							  			margin-right: 0;
							  			padding-right: 0;
							  		}
							    	.tab-pane{
							    		height: 75%; overflow:auto;
							    	}
							    	.tab-content img{
							    		width: 100%;
							    	}
							    </style>
							    <div id="products" class="panel-collapse collapse" style="">
							        
							        <ul class="nav nav-tabs" role="tablist">
							          <li class="nav-item">
							            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Round Neck</a>
							          </li>
							          <li class="nav-item">
							            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">V Neck</a>
							          </li>
							          <li class="nav-item">
							            <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Polo</a>
							          </li>
							          <li class="nav-item">
							            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Sweat Shirt</a>
							          </li>
							        </ul>
							        
							        
							        <div class="tab-content" style=" ">
							          <div class="tab-pane active" id="home" role="tabpanel" style="">
											Round Neck 
											
											<table>
											  <tbody>
											    <tr>
											      <td><img src="img/classic_fit_adult_t-ash_grey_front.jpg" onclick="setProduct(this);"></td>
											      <td><img src="img/classic_fit_adult_t-azalea_front.jpg" onclick="setProduct(this);"></td>
											      <td><img src="img/classic_fit_adult_t-cardinal_red_front.jpg" onclick="setProduct(this);"></td>
											    </tr>
											    <tr>
											      <td><img src="img/classic_fit_adult_t-charcoal_front.jpg" onclick="setProduct(this);"></td>
											      <td><img src="img/classic_fit_adult_t-cornsilk_front.jpg" onclick="setProduct(this);"></td>
											      <td><img src="img/classic_fit_adult_t-daisy_front.jpg" onclick="setProduct(this);"></td>
											    </tr>
											    <tr>
											      <td><img src="img/classic_fit_adult_t-dark_chocolate_front.jpg" onclick="setProduct(this);"></td>
											      <td><img src="img/classic_fit_adult_t-gold_front.jpg" onclick="setProduct(this);"></td>
											      <td><img src="img/classic_fit_adult_t-heliconia_front.jpg" onclick="setProduct(this);"></td>
											    </tr>
											  </tbody>
											</table>
							          </div>
							          <div class="tab-pane" id="profile" role="tabpanel" style=""> 
							                V Neck 
							                <table>
							                  <tbody>
							                    <tr>
							                      <td><img src="img/classic_fit_adult_t-ash_grey_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-azalea_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-cardinal_red_front.jpg" onclick="setProduct(this);"></td>
							                    </tr>
							                    <tr>
							                      <td><img src="img/classic_fit_adult_t-charcoal_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-cornsilk_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-daisy_front.jpg" onclick="setProduct(this);"></td>
							                    </tr>
							                    <tr>
							                      <td><img src="img/classic_fit_adult_t-dark_chocolate_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-gold_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-heliconia_front.jpg" onclick="setProduct(this);"></td>
							                    </tr>
							                  </tbody>
							                </table>                        
							          </div>
							          <div class="tab-pane" id="messages" role="tabpanel" style="">
							                V Neck 
							                <table>
							                  <tbody>
							                    <tr>
							                      <td><img src="img/classic_fit_adult_t-ash_grey_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-azalea_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-cardinal_red_front.jpg" onclick="setProduct(this);"></td>
							                    </tr>
							                    <tr>
							                      <td><img src="img/classic_fit_adult_t-charcoal_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-cornsilk_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-daisy_front.jpg" onclick="setProduct(this);"></td>
							                    </tr>
							                    <tr>
							                      <td><img src="img/classic_fit_adult_t-dark_chocolate_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-gold_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-heliconia_front.jpg" onclick="setProduct(this);"></td>
							                    </tr>
							                  </tbody>
							                </table>     
							          </div>
							          <div class="tab-pane" id="settings" role="tabpanel" style="">
							                V Neck 
							               <table>
							                  <tbody>
							                    <tr>
							                      <td><img src="img/classic_fit_adult_t-ash_grey_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-azalea_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-cardinal_red_front.jpg" onclick="setProduct(this);"></td>
							                    </tr>
							                    <tr>
							                      <td><img src="img/classic_fit_adult_t-charcoal_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-cornsilk_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-daisy_front.jpg" onclick="setProduct(this);"></td>
							                    </tr>
							                    <tr>
							                      <td><img src="img/classic_fit_adult_t-dark_chocolate_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-gold_front.jpg" onclick="setProduct(this);"></td>
							                      <td><img src="img/classic_fit_adult_t-heliconia_front.jpg" onclick="setProduct(this);"></td>
							                    </tr>
							                  </tbody>
							                </table>     
							          </div>
							        </div>
							    </div>

							</div>
				        </div>
				  </div>
				  </div>
				</div>-->
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
	                      <button id="submit" type="submit" class="btn btn-outline-success" >Save Order</button>
	                  </div>
	                   <div class="col-sm-5"></div>
	                  
	               	</div>   
      			</div>
          	</div>
          	<div class="col-2">
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
          		<!--CART
          		<style type="text/css">
          			#cart-wrapper{
          				position: fixed;
          				top: 0;
          				width: 10vw;
          			}
          			#total{
          				display: block;
          				margin: auto;
          			}
          		</style>
          		<div class="container" id="cart-wrapper"><h1>Cart</h1>
	          		<table class="table table-sm" id="cart">

	          		</table>
	          		<a href="#paymentInformation" style="text-decoration: none;"><button type="button" id="total" class="btn btn-outline-success" onclick="getTotal();"></button></a>
          		</div>-->
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
      function setProduct(element){
      	var shirt = document.getElementById('shirt');
      	shirt.style.backgroundImage = "url('"+element.src+"')";
      }

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