<?php
    include 'session.php';
?>
<!--GETTING ORDER NUMBER-->
<?php 
   $ses_sql = mysqli_query($db,"Select Quantity From consecutive where Name = 'Order'");     
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $ordernumber = "";
  if (!$Guest) {
      $ordernumber = $login_session.sprintf("%06d", $row['Quantity']);                                     
  }  
  else ///if (isset($_SESSION['Guest'])) 
  {
       $ordernumber = $_SESSION['Guest'].sprintf("%06d", $row['Quantity']);                                           
  }       
  $ses_sql = mysqli_query($db,"Update consecutive set Quantity = Quantity + 1 where Name = 'Order'");
  echo('<input id="ordernumber" type="hidden" name="ordernumber" value = '.$ordernumber.'>');
?>

<html>
<head>
    <title>ui</title>
    <script src="fabric.min.js"></script>
    <script src="custom_controls.js"></script>
    <script src="aligning_guidelines.js"></script>
    <script src="centering_guidelines.js"></script>
    <!--jsPDF-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <!--FONT AWESOEM-->
    <link rel="stylesheet" href="https://use.fontawesome.com/42fa7d18a0.css">
    <script src="https://use.fontawesome.com/0bc1ca65b8.js"></script>
 
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    
    <!--BOOTSRAP 3-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Niconne" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
    <style type="text/css">
        /*TODO make sure this image hover rule only applies to certain images*/
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
        .hover:hover{
            /*background-color: #eeeeee;*/
            border: 1px solid #000000;
        }
        .active{
            border: 1px solid #eeeeee;
            background: none !important;
        }
        /*top bar*/
        #topBar{ height: 5vh !important;  }
        #topBar img{ height: 5vh !important; }
        /*top nav bar*/
        .nav{
            border: none;
            background-color: #696973;
        }
        .nav li{
            border: none;
        }
        li.active a{
            background-color: #31B0D5 !important; 
        }
        .nav a{                                       
            color: #ffffff !important;
            margin: 0 !important;
            padding-top: 1vh;
            padding-bottom: 1vh;
            font-size: 12;
            border: none !important;
            outline: none;
        }
        .nav a:hover{
            background-color: #31B0D5 !important;
        }     
        /*color selection*/
        .colorRow{
            margin: 0;
            padding: 0;
        }
        .colorColumn{
            margin: 0;
            padding: 0;
        }
        .colorItem{
            width: 100%;
            height: 2%;
        }     
        .tab-pane{
            border: none !important;
            margin-top: 0
        }
        textarea {
            resize: none;
        }
        span.line {
            display: inline-block;
            font-size: 10px;
        }
    </style>
    <script type="text/javascript">

      window.onload = function() 
      {
         var url_string = window.location;
          var url = new URL(url_string);
          var emails = url.searchParams.get("email"); 
          var shares = url.searchParams.get("share");
          if (emails)
          {
            //alert(emails);
            $('.nav-tabs a[href="#saveSection"]').tab('show'); 
             LoadDesings(emails); 
          }
          else if(shares)
          {
            $('.nav-tabs a[href="#saveSection"]').tab('show');
          }
          else
          {
            return;
          }
     
      };
    </script>
    <!--CSS-->
    <!--<link rel="stylesheet" type="text/css" href="css/main.css">
    to replace style tags on this page-->
    <link rel="stylesheet" type="text/css" href="css/style.css">    
</head>
<body onunload="return false; checksave()">
<!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& MODALS &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
  <!--PRODUCT PICKER-->
  <style type="text/css">
      #productPickerBtn{
          margin-top: 10px;
      }
      #designsTable img{
          width: 100%;
      }
      #productPreview{
          width: 100%;
          height: 50%;
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center center;
      }
      #designPreviewWrapper{
          width: 60% !important;
          height: 80% !important;
          position: relative;
          margin: auto;
          top: 10% !important;
      }
      #designPreview{
          width: 60% !important;
          height: 80% !important;
          position: relative;
          margin: auto;
          top: 10% !important;
      }
      #productsTable{
          text-align: center;
      }
      #productsTable tr{
        border-top: none;
      }
      #productsTable td{
          width: 25%;
          border-top: none;
      }
      #productsTable img{
          width: 100%;
      }
      #sizeForm input{
          width: 7%;
      }
  </style>
  <!-- Modal -->
  <div class="modal fade" id="productPicker" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">Add Products and Styles</h4>
        </div>
        <div class="modal-body">
            <!--PRODUCT PREVIEW-->
            <div class="row">
              <div class="col-sm-6">

                      <div id="productPreview" style=" background-image: url('img/classic_fit_adult_t-ash_grey_front.jpg');">
                            <div style="width: 80%; height: 80%; position: relative ; margin: auto !important; top: 10% !important;" class="designPrevieWrapper">
                                <img style="display: block;  margin: auto !important; " id="designPreview" src=""> 
                            </div>
                      </div>
                      <p>T Shirt made of cotton.</p>
               
              </div>
              <div class="col-sm-6" style="border-left: 1px solid #d3d3d3;">
 
                  <table class="table" id="productsTable">
                    <tr><td colspan="4" >Add Products</td></tr>
                    <tr>
                        <td>  <div style="background-image: url('img/classic_fit_adult_t-azalea_front.jpg'); width: 100%; height: 50%; background-repeat: no-repeat; background-size: cover; background-position: center center;"><img style="display: block; margin: auto !important;  position: relative; margin: auto; top: 10% !important; " class="designPreview" src=""> </div> V Neck </td> <!--<img src="img/classic_fit_adult_t-ash_grey_front.jpg" onclick="setProductPreview(this);">-->
                        <td>  <div style="background-image: url('img/classic_fit_adult_t-azalea_front.jpg'); width: 100%; height: 50%; background-repeat: no-repeat; background-size: cover; background-position: center center;"><img style="display: block; margin: auto !important;  position: relative; margin: auto; top: 10% !important;" class="designPreview" src=""> </div> Polo</td> <!--<img src="img/classic_fit_adult_t-azalea_front.jpg" onclick="setProductPreview(this);"> -->
                        <td>  <div style="background-image: url('img/classic_fit_adult_t-cardinal_red_front.jpg'); width: 100%; height: 50%; background-repeat: no-repeat; background-size: cover; background-position: center center;"><img style="display: block; margin: auto !important;  position: relative; margin: auto; top: 10% !important;" class="designPreview" src=""> </div> Long Sleeve</td> <!--<img src="img/classic_fit_adult_t-cardinal_red_front.jpg" onclick="setProductPreview(this);"> -->
                        <td>  <div style="background-image: url('img/classic_fit_adult_t-charcoal_front.jpg'); width: 100%; height: 50%; background-repeat: no-repeat; background-size: cover; background-position: center center;"><img style="display: block; margin: auto !important; position: relative; margin: auto; top: 10% !important;" class="designPreview" src=""> </div> Short Sleeve</td> <!--<img src="img/classic_fit_adult_t-charcoal_front.jpg" onclick="setProductPreview(this);"> -->
                    </tr>
                  </table>
 
                  <hr>
                  <h3 id="itemPriceLabel">Price per shirt:<span id="itemPrice" style="color: #5cb85c;"></span> <small id="numOfShirtsLabel" style="position: relative; bottom: 0.2em;"> @ (4 shirts)</small></h3>
                  <h4 id="itemTotalLabel" style="visibility: hidden;">Total: <span id="itemTotal" style="color: #5cb85c;" ></span></h4>
                  <div id="shippingSection" style="visibility: hidden;">
                    <h3>Guaranteed by <span id="deliveryDate" style="color: #5bc0de;">||</span> with FREE 2-week delivery!</h3>
                  </div>
              </div>
            </div>
            <!--SIZE SELECTION-->
            <form id="sizeForm" style="">
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="yxs" type="number" name="yxs" placeholder="YXS"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="ys" type="number" name="ys" placeholder="YS"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="ym" type="number" name="ym" placeholder="YM"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="yl" type="number" name="yl" placeholder="YL"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="yxl" type="number" name="yxl" placeholder="YXL">    
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="s" type="number" name="s" placeholder="S"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="m" type="number" name="m" placeholder="M"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="l" type="number" name="l" placeholder="L"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="xl" type="number" name="xl" placeholder="XL"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="xxl" type="number" name="xxl" placeholder="2XL" data-toggle="popover" data-placement="top" data-content="+$2.00"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="xxxl" type="number" name="xxxl" placeholder="3XL" data-toggle="popover" data-placement="top" data-content="+$2.00"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="xxxxl" type="number" name="xxxxl" placeholder="4XL" data-toggle="popover" data-placement="top" data-content="+$2.00"> 
                 <input min="0" class="quantity" onkeydown="setItemPrice(this)" onkeyup="setItemPrice(this)" id="xxxxxl" type="number" name="xxxxxl" placeholder="5XL" data-toggle="popover" data-placement="top" data-content="+$2.00"> 
            </form>
        </div>
        <div class="modal-footer">
          <!--showing price per design TODO LIVE UPDATE THIS PRICE-->
          <div style="display: inline;">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="addingToCart = true; uploadEx(); calcPrice();" style="display: inline;">Add &amp; Keep Designing!</button><!--taken out of style -->
            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="checkoutFromGetPrice();" style="display: inline;   ">Checkout</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--PRODUCT MODAL (SWAP ITEM)-->
  <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h1 class="display-4" id="exampleModalLabel">Choose a Product</h1>
          <!--<h5 class="modal-title" id="exampleModalLabel">Choose Product</h5>-->
        </div>
        <div class="modal-body">
              <table class="table">
                  <thead>
                    <tr>
                      <th>T Shirts</th>
                      <th>Polos</th>
                      <th>Ultra T Shirts</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td onclick="setProduct(this);" ><img src="img/shirt_white.jpg" style="width: 64;"><br> <span class="product_name"> White Shirt </span></td>
                      <td onclick="setProduct(this);"><img src="img/shirt_dark_heather.jpg" style="width: 64;"><br><span class="product_name">Black Shirt</span></td>
                      <td onclick="setProduct(this);"><img src="img/shirt_dark_heather.jpg" style="width: 64;"><br><span class="product_name">Grey Shirt</span></td>
                    </tr>
                    <tr>
                      <td onclick="setProduct(this);"><img src="img/shirt_heather_sapphire.jpg" style="width: 64;"><br><span class="product_name">Blue Shirt</span></td>
                      <td onclick="setProduct(this);"><img src="img/shirt_irish_green.jpg" style="width: 64;"><br><span class="product_name">Green Shirt</span></td>
                      <td onclick="setProduct(this);"><img src="img/shirt_purple.jpg" style="width: 64;"><br><span class="product_name">Purple Shirt</span></td>
                    </tr>
                    <tr>
                      <td onclick="setProduct(this);"><img src="img/shirt_cherry_red.jpg" style="width: 64;"><br><span class="product_name">Maroon Shirt</span></td>
                      <td onclick="setProduct(this);"><img src="img/shirt_cherry_red.jpg" style="width: 64;"><br><span class="product_name">Red Shirt</span></td>
                      <td onclick="setProduct(this);"><img src="img/shirt_safety_orange.jpg" style="width: 64;"><br><span class="product_name">Orange Shirt</span></td>
                    </tr>
                  </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
      </div>
    </div>
  </div>

  <!--SIGN UP-->
  <!--modal to be shown when user tries to leave the page-->
  <div id="signupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="text-align: center;">
        <div class="modal-header">
          <h4 class="modal-title">Signup!</h4>
        </div>
          <div class="modal-body">
            <form action="signup.php" method="post" class="form-horizontal">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="firstname">First Name:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="firstName">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="lastname">Last Name:</label>
                  <div class="col-sm-10">
                    <input type="lastname" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastName">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="username">Username:</label>
                  <div class="col-sm-10">
                    <input type="username" class="form-control" id="username" placeholder="Enter Username" name="username">
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">Password:</label>
                  <div class="col-sm-10">          
                    <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Email:</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="phone">Phone:</label>
                  <div class="col-sm-10">
                    <input type="phone" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
                  </div>
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" onclick="signup();" data-dismiss="modal">Signup!</button><!--changed type="submit" to type="button"-->
            </form>
          </div>
      </div>

    </div>
  </div>
<!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& MODALS &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
<!--TOP LEFT MENU-->
<style type="text/css">
  .column{
    display: inline-block;
  }
</style>
<div id="topRightMenu" style=" position: fixed; top: 0; right: 0;">
  <h4  class="column">Total Price : $<span id="totalPriceLabel">0</span>&nbsp;</h4>
  <button class="btn btn-info " data-target="#saveSection" onclick="uploadEx();" >
    Save
  </button>
  <button class="btn btn-success" onclick=" isThereDesign(true);" ><!--data-toggle="modal" data-target="#productPicker" -->
    Get Price
  </button>
</div>
<p id="testingCart">.</p>
<!--message to let customer know their email sent successfully-->
<div class="alert alert-success" id="emailmessage" style="display:none; text-align: center;">
  <strong><center>The email was sent successfully.</center></strong> 
</div>
<!--message letting the customer know their was an error sending their email-->
<div class="alert alert-danger" id="emailerrormessage" style="display:none; text-align: center;">
  <strong><center>Error sending the email.</center></strong> 
</div>
<!--message letting the customer know they need to make a design to checkout-->
<div class="alert alert-danger" role="alert" id="noDesignError" style="display:none; text-align: center;">
  <strong>Oh snap!</strong> You forgot to make a design.
</div>
<!--message to let customer know their designs have been saved-->
<div id="savedSuccessfullyMessage" class="alert alert-success" role="alert" style="display:none; text-align: center;">Your design was successfully saved!</div>
<!--START NEW PAGE-->
<div class="page-wrapper">
<div class="container" style="width: 1360px !important; height: 900px !important;">
 <div class="card">
 <!--TOP BAR-->
    <div class="card-header" align="right">
        <div class="row">
            <div class="col-sm-2">
                <img src="https://vividcustoms.com/skin/frontend/tv_nautica_package/tv_nautica8/images/logo.png">
            </div>
            <div class="col-sm-8">
                <script>
                        //to save the latest designs
                        var designs = [];  
                        //to hold the address of the most recent design save
                        var designArray = [];
                        var designArrayIndex = 0;
                        //this keeps track of whether or not we should add the item to cart
                        var addingToCart = false;   
                        //this is used to test if the user is checking out from 'add product' or not
                        var automatedCheckout = false;
                        var itemProduct = "";
                        $(document).ready(function(){
                            $('[data-toggle="popover"]').popover(); 
                        });
                </script>   
            </div>
            <div class="col-sm-2">
                <?php 
                      if (!$Guest) {
                          echo '<b> Welcome: '.$login_session.'</b><br>'; 
                          echo  '<b><a href = "logout.php"><button class="btn btn-info">Sign Out</button></a></b>';    
                      }  
                      else if (isset($_SESSION['Guest'])) 
                      {
                         echo "<button id='signup' class='btn btn-success btn-lg' data-toggle='modal' data-target='#signupModal'>Signup!</button>";             
                      }
                      else
                      {
                          echo "<button id='signup' class='btn btn-success btn-lg' data-toggle='modal' data-target='#signupModal'>Signup!</button>";
                      }          
                ?>
            </div>
        </div> 
    </div>
 <div class="card-block" >
    <div class="row" >
        <!--START SIDE BAR-->
        <div class="col-sm-1">   
            <ul class="nav nav-tabs nav-stacked" style="height: 90%; text-align: center; ">
                <li class="active" style="border-bottom: 1px solid #ffffff;"><a  data-toggle="tab" href="#productSection"><img src="img/shirt_icon.png" style="width: 70%;"><br>Shirt</a></li> <!--Shirt<br><span style="visibility: hidden;">equal</span>-->
                <li style="border-bottom: 1px solid #ffffff;" onclick="deselectAllCanvases(); document.getElementById('editArt').style.display = 'none';  document.getElementById('newArt').style.display = 'block';"><a  data-toggle="tab" href="#addArt"><img src="img/art_icon.png" style="width: 70%;"><br>Add Art</a></li> <!--Add Art <span style="visibility: hidden;">equal</span>-->
                <li onclick="deselectAllCanvases();" style="border-bottom: 1px solid #ffffff;"><a  data-toggle="tab" href="#textSection"><img src="img/text_icon.png" style="width: 70%;"><br>Add Text</a></li> <!--Add Text <span style="visibility: hidden;">equal</span>-->                   
                <li onclick=" isThereDesign(true);"  style="border-bottom: 1px solid #ffffff;">
                  <a  data-toggle="tab" href="#priceSection" ><img src="img/price_icon.png" style="width: 70%;"><br>Get Price</a>
                </li> <!-- data-toggle="modal" data-target="#productPicker" -->
                <!--<li ><a  data-toggle="tab" href="#shareSection" onclick="share();">Share</a></li>-->
                <li style="border-bottom: 1px solid #ffffff;" ><a   data-toggle="tab" href="#saveSection" onclick="share();"><img src="img/share_icon.png" style="width: 70%;"><br>Save &amp; Share</a></li> <!-- Save &amp; Share -->
                <li style="border-bottom: 1px solid #ffffff;" ><a data-toggle="tab" href="#textDesign">Text Design</a></li>
            </ul>
        </div>
        <!--END  SIDE BAR-->
        <!--START TAB CONTENT-->
        <div class="col-sm-4" style="height: 90%;">
            <div class="tab-content" >

                <div id="productSection" class="tab-pane fade in active">
                    <h2 style="text-align: center;">Swap Item</h2>
                    <hr>
                    <!--<p>1. Switch to a different product</p>
                    <p>2. Choose a color</p>-->
                    <!--START PRODUCT DESCRIPTION-->
                        <h3 id="description_label">Product Description</h3>
                        <img id="description_image" src="img/shirt_white.jpg">
                        <ul>
                            <li id="description">100% Polyester Wicking Knit</li>
                            <li id="description_size">Sizes: YS - 3XL</li>
                            <li>Mininum Quantity: 1</li>
                        </ul>
                    <!--END   PRODUCT DESCRIPTION-->
                    <!--START CHOOSE PRODUCT MODAL-->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productModal">
                          Choose Product
                        </button>
                        
                    <!--END  CHOOSE PRODUCT MODAL-->
                    <!--COLOR SELECTION FOR PRODUCTS-->
                    <hr>
                    <div class="panel panel-default">
                          <div class="panel-heading">Change Product Color</div>
                              <div class="panel-body">
                                  <!--COLOR SECTION-->  
                                    <style type="text/css">
                                        .row {
                                          width: 100%;
                                          margin: 0 auto;
                                        }
                                        .block {
                                          width: 100px;
                                          display: inline-block;
                                        }
                                    </style>       

                                    <div class="row">
                                      <div class="block"  style="border-radius:  50%; background-color: #ffff00; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#ffff00');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #ff2400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#ff2400');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #800000; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#800000');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #9bddff; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#9bddff');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #4169e1; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#4169e1');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #000080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#000080');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #800080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#800080');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #006400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#006400');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #fffdd0; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#fffdd0');"></div>                                                   
                                    </div>  
                                    <div class="row">
                                      <div class="block"  style="border-radius:  50%; background-color: #ffff00; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#ffff00');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #ff2400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#ff2400');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #800000; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#800000');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #9bddff; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#9bddff');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #4169e1; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#4169e1');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #000080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#000080');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #800080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#800080');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #006400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#006400');"></div>
                                      <div class="block"  style="border-radius:  50%; background-color: #fffdd0; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeProductColor('#fffdd0');"></div>
                                     </div>  
                                <!--END COLOR SECTION-->
                            </div>                         
                          </div> 
                </div>

                <div id="addArt" class="tab-pane fade">
                    <div id="newArt">
                        <h3>Add Art</h3>
                        <p>Have your own image, logo or artwork?</p>
                        <!--START UPLOADING IMAGE SECTION-->
                        <input id="imgUpload" type="file" name="imgUpload" data-buttonText="upload" onchange="uploadImage();">
                        <img class="hover" id="imgPreview" style="" src="" alt="" onclick="addImg(this); imgPreviewCanvas();"> 
                        <canvas id="previewCanvas" style="display: none;"></canvas>
                        <script type="text/javascript">
                            function  imgPreviewCanvas(){
                                var c=document.getElementById("previewCanvas");
                                
                                var ctx=c.getContext("2d");
                               
                                var img=document.getElementById("imgPreview");
                                ctx.drawImage(img,10,10,128,128); 
                                saveUpload();
                            };
                        </script>
                        <hr>
                        <!--START CLIP ART SECTION-->
                        <strong><p>BROWSE THE FLIP SHOP GALLERY</p></strong>
                        <img class="hover" src="img/clip_1.png" onclick="addImg(this);" style="max-width: 64px; max-height: 64px;"> <!-- taken out idth="64" height="64" -->
                        <img class="hover" src="img/watchdogs.png" onclick="addImg(this);" style="max-width: 64px; max-height: 64px;">
                        <img class="hover" src="img/clip_4.png" onclick="addImg(this);" style="max-width: 64px; max-height: 64px;">
                        <img class="hover" src="img/fuze.jpg"  onclick="addImg(this);" style="max-width: 64px; max-height: 64px;">
                        
                        <!--CLIP ART CATEGORIES-->
                         <style type="text/css">
                            .panel-success {
                              min-height: 200;
                              max-height: 500;
                              overflow-y: scroll;
                            }
                        </style>
                    <!--END CLIP ART SECTION-->
                    </div>
                     <!--START MODIFY ART SECTION-->
                    <div id="editArt" style="display: none;">
                        <h2>Add Art</h2>
                        <p> Edit Art Section</p>
                        <div class="panel-group">
                            <div class="panel panel-default">
                                  <div class="panel-heading">Size &amp; Effect</div>
                                  <div class="panel-body">
                                     <!--resize clip art form-->
                                         <form>                      
                                          <div class="input-group">
                                            <span class="input-group-addon">Width</span>
                                            <input id="widthImage" type="number" class="form-control" name="widthImage"  maxlength="5" onkeypress="return resize(event);" >
                                            <span class="input-group-addon">in.</span>
                                            <span class="input-group-addon">Height</span>
                                            <input id="heightImage" type="number" class="form-control" name="heightImage" onkeypress="return resize(event);" >
                                            <span class="input-group-addon">in.</span>
                                            <span class="input-group-addon">Rotate</span>
                                            <input id="angleImage" type="number" class="form-control" name="angleImage" onkeypress="return rotate(event);" >
                                          </div>
                                        </form>  
                                  </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">Change Color</div>
                                    <div class="panel-body">
                                      <!--COLOR SECTION-->  
                                        <style type="text/css">
                                            .row {
                                              width: 100%;
                                              margin: 0 auto;
                                            }
                                            .block {
                                              width: 100px;
                                              display: inline-block;
                                            }
                                        </style>       

                                        <div class="row">
                                          <div class="block"  style="border-radius:  50%; background-color: #ffff00; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#ffff00');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #ff2400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#ff2400');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #800000; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#800000');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #9bddff; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#9bddff');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #4169e1; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#4169e1');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #000080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#000080');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #800080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#800080');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #006400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#006400');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #fffdd0; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#fffdd0');"></div>                                                   
                                        </div>  
                                        <div class="row">
                                          <div class="block"  style="border-radius:  50%; background-color: #ffff00; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#ffff00');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #ff2400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#ff2400');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #800000; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#800000');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #9bddff; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#9bddff');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #4169e1; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#4169e1');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #000080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#000080');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #800080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#800080');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #006400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#006400');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #fffdd0; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColor('#fffdd0');"></div>
                                         </div>  
                                        <!--END COLOR SECTION-->
                                    </div>                         
                            </div>
                        </div>

                    </div>

                    <div id="clipartCategory">
                  <div id="clipArtMenu">
                    <div id="clipArtCategories">
                      <ol class="breadcrumb" id="breadcrumb"><li class="active" id="categories">Categories</li><li id="subcategories" style="display: none;"></li><li id="subsubcategories" style="display: none;"></li><li id="clips" style="display: none;"></li></ol>
                    </div>
                    <div id="ClipsArtImages" class="panel panel-success">                        
                        <style type="text/css">
                            #clipArtTable{
                                width: 100%;
                            }
                            #clipArtTable td{
                                padding: 10px;
                            }  
                        </style>    
                        <table id="clipArtTable2" class="table table-fixed">
                        </table> 
                        <table id="clipArtTable" class="table table-fixed" style=" border-top: none !important; height: 50px !important;">                                                
                          <?php                                  
                              $fulldirectory = dirname(__FILE__).'/img/clip_art';
                              $directory = 'img/clip_art';
                              $categories  = scandir($fulldirectory);               
                              print_r('<tbody style="height: 50px !important;">');
                              for ($i=0; $i< count($categories) ; $i++) 
                              { 
                                if ($categories[$i] != '.' && $categories[$i] != '..') 
                                {
                                  if ($i % 2 == 0)
                                  {                                          
                                    print_r('    <tr>') ;                                                                                    
                                  }                
                                  $valuetmp =  "'".$categories[$i]."'";
                                            print_r('    <td height="80" width="195"  align="center" style="border-left:none;border-bottom:none;border-top:none">') ; // height="80px" width="195px"
                                            //print_r('        <img art-image="" src="'.$directory.'/'.$categories[$i].'/'.$categories[$i].'.png" width="50" height="50"><br>') ;
                                            print_r('        <a href="javascript:void(0);" onclick="setCategory('.$valuetmp.');" style="font-size:16px;"><img art-image="" src="'.$directory.'/'.$categories[$i].'/'.$categories[$i].'.png" width="50" height="50"><br>'.$categories[$i].'</a>');
                                  print_r('    </td>') ;   
                                  if ($i % 2 != 0)
                                  {
                                    print_r('    </tr>') ;
                                  }
                                }      
                              }
                                        print_r('<tbody style="height: 50px !important;">');
                          ?>
                          <!--menu for customers to go back if they wish-->
                          <!--WILL USE THIS IF BREADCRUMBS DON'T WORK<div class="row"><div class="col-sm-1"></div><div class="col-sm-1"></div><div class="col-sm-10"></div></div>--> 
                        </table> 
                                           
                    </div>
                  </div>

                    <script type="text/javascript">
                          var div = document.getElementById('clipArtCategories');
                          var category = "";
                          var subcategory = "";
                              
   
                          var categories = document.getElementById('categories');
                          
                          var subcategories = document.getElementById('subcategories');
                          var clips = document.getElementById('clips');

                          var subsubcategories = document.getElementById('subsubcategories');
                          
   
                          subsubcategories.onclick = function(){
                              //hiding clips
                              clips.style.display = "none";
                              //making subcategories "active"
                              categories.classList.remove("active");
                              subcategories.classList.add("active");
                          }

                          subcategories.onclick = function(){
                              //TODO hide whatever is currently showing
                              //showing table
                              invisibleTables();
                              showTable(category);
                              //var table = document.getElementById('clipArtTable2');
                              //table.style.display = "block";
                              //table.setAttribute('width','100%');
                              //getting ride of other crumbs in the breadcrumb list
                              //subcategories.style.display = "none";
                              subsubcategories.style.display = "none";
                              clips.style.display = "none";
                              //making the categories tab have the 'active' class
                              categories.classList.remove("active");
                              subsubcategories.classList.remove("active");
                              subcategories.classList.add("active");
                          }
                          categories.onclick = function(){
                              //TODO hide whatever is currently showing
                              //showing table
                              invisibleTables();
                              var table = document.getElementById('clipArtTable');
                              table.style.display = "block";
                              table.setAttribute('width','100%');
                              //getting ride of other crumbs in the breadcrumb list
                              subcategories.style.display = "none";
                              subsubcategories.style.display = "none";
                              clips.style.display = "none";
                              //making the categories tab have the 'active' class
                              subcategories.classList.remove("active");
                              subsubcategories.classList.remove("active");
                              categories.classList.add("active");
                          }
                          function setCategory(element){
                              //setting the category
                              category = element;
                              //hiding table
                              invisibleTables();
                              //var table = document.getElementById('clipArtTable');
                              //table.style.display = "none";
                              //showNewtable
                              showTable(category,null);
                              //making the subcategories visible and 'active'
                              subcategories.style.display = "inline"; 
                                                          subcategories.innerHTML = element; 
                              clips.style.display = "none";
                              //making the subcategories tab have the 'active' class
                              categories.classList.remove("active");
                              subsubcategories.classList.remove("active");
                              subcategories.classList.add("active");                            
                          }   

                            function setSubCategory(element){
                                //setting the category
                                subcategory = element;
                                //hiding table
                                invisibleTables();
                                //var table = document.getElementById('clipArtTable');
                                //table.style.display = "none";
                                //showNewtable
                                showTable(category,subcategory);
                                //showTable(element);
                                //making the subcategories visible and 'active'
                                subsubcategories.style.display = "inline"; 
                                                            subsubcategories.innerHTML = element; 
                                clips.style.display = "none";
                                //making the subcategories tab have the 'active' class
                                categories.classList.remove("active");
                                subcategories.classList.remove("active");
                                subsubcategories.classList.add("active");
                                
                            } 

                          function showTable(category,subcategory){    
                             $.ajax({
                                      type: "POST",
                                      url: "categories.php",
                                      data: {
                                              category: category,
                                              subcategory: subcategory
                                             },
                                      success: function(data)
                                      {
                                          //alert(data);
                                          document.getElementById('clipArtTable2').innerHTML = data;
                                          document.getElementById('clipArtTable2').style.display = "block";
                                      }
                                  })                         
                              }      

                           function invisibleTables(){
                              var tables = document.getElementsByClassName('table table-fixed');

                              for (var i = 0; i < tables.length; i++) {
                                  tables[i].style.display = "none";
                              }
                          }             
                    </script>

                    </div>
                </div>  
                </div>            
 

                <!--START TEXT DESIGN SECTION-->
                <div id="textSection" class="tab-pane fade">

                     <h3>ADD TEXT</h3>                      
                      <div class="panel-group">
                            <div class="panel panel-default">
                              <div class="panel-heading">Text Section</div>
                              <div class="panel-body">
                                    <!--<textarea rows="3" class="form-control"  type="text" onkeypress="return addText(event);" placeholder="Enter text"></textarea>--><!--id="text" was taken out for testing || onchange setText(); was taken out -->
                                    <!--NEW TEXT DESIGN-->
                                    <textarea rows="3"  class="form-control" type="text" id="text" placeholder="Enter Text"/></textarea> <br><!--testtext was the old id, make sure to change the javascript!-->
                                    <button onclick="addTextToDesign();">Add Text to Design!</button><br><br>
                                    <button id="convert">Convert Text/Curved</button>
                                    Reverse : <input type="checkbox" name="reverse" id="reverse" /><br>
                                    Radius : <input type="range" min="0" max="110" value="50" id="radius" /><br>
                                    Spacing : <input type="range" min="0" max="44" value="20" id="spacing" /><br>
                                    <!--Color : <input type="color" value="#0000ff" id="fill" /><br>
                                    Effect : 
                                    <select name="effect" id="effect" >
                                      <option value="curved">Curved</option>
                                      <option value="arc">Arc</option>
                                      <option value="STRAIGHT">STRAIGHT</option>
                                      <option value="smallToLarge">smallToLarge</option>
                                      <option value="largeToSmallTop">largeToSmallToped</option>
                                      <option value="largeToSmallBottom">largeToSmallBottom</option>
                                      <option value="bulge">bulge</option>
                                    </select>-->
                                    
                                    <!--<button id="save">Save/Reload</button>-->

                              </div>
                            </div>
                            <div class="panel panel-default">
                              <div class="panel-heading" data-toggle="collapse" data-target="#color_panel">Change Color</div>
                              <div id="color_panel" class="collapse panel-body"> 
                                  <h5>Text Color:</h5>
                                    <!--COLOR SECTION-->  
                                        <style type="text/css">
                                            .row {
                                              width: 100%;
                                              margin: 0 auto;
                                            }
                                            .block {
                                              width: 100px;
                                              display: inline-block;
                                            }
                                        </style>       

                                        <div class="row">
                                          <div class="block"  style="border-radius:  50%; background-color: #ffff00; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#ffff00','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #ff2400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#ff2400','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #800000; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#800000','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #9bddff; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#9bddff','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #4169e1; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#4169e1','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #000080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#000080','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #800080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#800080','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #006400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#006400','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #fffdd0; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#fffdd0','f');"></div>                                                   
                                        </div>  
                                        <div class="row">
                                          <div class="block"  style="border-radius:  50%; background-color: #ffff00; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#ffff00','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #ff2400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#ff2400','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #800000; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#800000','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #9bddff; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#9bddff','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #4169e1; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#4169e1','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #000080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#000080','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #800080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#800080','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #006400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#006400','f');"></div>
                                          <div class="block"  style="border-radius:  50%; background-color: #fffdd0; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#fffdd0','f');"></div>
                                         </div>  
                                    <!--END COLOR SECTION-->

                                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Add Outline</button>
                                        <div id="demo" class="collapse">
                                            <h5>Text Stroke Color:</h5>
                                                <!--COLOR SECTION-->  
                                                    <style type="text/css">
                                                        .row {
                                                          width: 100%;
                                                          margin: 0 auto;
                                                        }
                                                        .block {
                                                          width: 100px;
                                                          display: inline-block;
                                                        }
                                                    </style>       

                                                    <div class="row">
                                                      <div class="block"  style="border-radius:  50%; background-color: #ffff00; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#ffff00','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #ff2400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#ff2400','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #800000; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#800000','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #9bddff; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#9bddff','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #4169e1; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#4169e1','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #000080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#000080','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #800080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#800080','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #006400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#006400','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #fffdd0; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#fffdd0','c');"></div>                                                   
                                                    </div>  
                                                    <div class="row">
                                                      <div class="block"  style="border-radius:  50%; background-color: #ffff00; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#ffff00','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #ff2400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#ff2400','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #800000; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#800000','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #9bddff; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#9bddff','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #4169e1; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#4169e1','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #000080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#000080','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #800080; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#800080','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #006400; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#006400','c');"></div>
                                                      <div class="block"  style="border-radius:  50%; background-color: #fffdd0; width: 2vw; height: 2vw; border:1px solid #eeeeee;" onclick="changeColorText('#fffdd0','c');"></div>
                                                     </div>  
                                                <!--END COLOR SECTION-->
                                        </div>                             
                              </div>
                            </div>
                            <!--START TEXT DESIGN SECTION-->
                            <div class="panel panel-default">
                              <div class="panel-heading" data-toggle="collapse" data-target="#fonts_panel">Fonts</div>
                              <div id="fonts_panel" class="collapse panel-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <a href="#"><div class="col-sm-3"><h3 id="bully" onclick="setFont(this);">Bully Style</h3></div></a>
                                        <a href="#"><div class="col-sm-3"><h3 id="PokemonHollow" onclick="setFont(this);">Gotta Catch</h3></div></a>
                                        <a href="#"><div class="col-sm-3"><h3 id="PokemonSolid" onclick="setFont(this);">Them All!</h3></div></a>
                                        <a href="#"><div class="col-sm-3"><h3 id="jelly" onclick="setFont(this);">Jellyfi Text</h3></div></a>
                                    </div>
                                    <div class="row">
                                        <a href="#"><div class="col-sm-3"><h3 id="angry" onclick="setFont(this);">Angry Birds!</h3></div></a>
                                        <a href="#"><div class="col-sm-3"><h3 id="tmnt" onclick="setFont(this);">Turtle Power!</h3></div></a>
                                        <a href="#"><div class="col-sm-3"><h3 id="db" onclick="setFont(this);">Make a Wish</h3></div></a>
                                        <a href="#"><div class="col-sm-3"><h3 id="dbz" onclick="setFont(this);">But take care</h3></div></a>
                                    </div>
                                    <div class="row">
                                        <a href="#"><div class="col-sm-3"><h3 id="spongebob" onclick="setFont(this);">Lives Under The Sea!</h3></div></a>
                                        <a href="#"><div class="col-sm-3"><h3 id="tmnt" onclick="setFont(this);">Turtle Power!</h3></div></a>
                                        <a href="#"><div class="col-sm-3"><h3 id="db" onclick="setFont(this);">Make a Wish</h3></div></a>
                                        <a href="#"><div class="col-sm-3"><h3 id="dbz" onclick="setFont(this);">But take care</h3></div></a>
                                    </div>
                                </div>
                                    <!-- Button trigger modal -->
                                    <input type="button" value="Fonts" class="btn btn-primary textBtn" data-toggle="modal" data-target="#fontModal" disabled="true">
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="fontModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h1 class="modal-title fancy" id="label">Fonts</h1>
                                          </div>
                                          <div class="modal-body">
                                                <!--COMMENTED OUT FOR TESTING
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <a href="#"><div class="col-sm-3"><h3 id="bully" onclick="setFont(this);">Bully Style</h3></div></a>
                                                        <a href="#"><div class="col-sm-3"><h3 id="PokemonHollow" onclick="setFont(this);">Gotta Catch</h3></div></a>
                                                        <a href="#"><div class="col-sm-3"><h3 id="PokemonSolid" onclick="setFont(this);">Them All!</h3></div></a>
                                                        <a href="#"><div class="col-sm-3"><h3 id="jelly" onclick="setFont(this);">Jellyfi Text</h3></div></a>
                                                    </div>
                                                    <div class="row">
                                                        <a href="#"><div class="col-sm-3"><h3 id="angry" onclick="setFont(this);">Angry Birds!</h3></div></a>
                                                        <a href="#"><div class="col-sm-3"><h3 id="tmnt" onclick="setFont(this);">Turtle Power!</h3></div></a>
                                                        <a href="#"><div class="col-sm-3"><h3 id="db" onclick="setFont(this);">Make a Wish</h3></div></a>
                                                        <a href="#"><div class="col-sm-3"><h3 id="dbz" onclick="setFont(this);">But take care</h3></div></a>
                                                    </div>
                                                    <div class="row">
                                                        <a href="#"><div class="col-sm-3"><h3 id="spongebob" onclick="setFont(this);">Lives Under The Sea!</h3></div></a>
                                                        <a href="#"><div class="col-sm-3"><h3 id="tmnt" onclick="setFont(this);">Turtle Power!</h3></div></a>
                                                        <a href="#"><div class="col-sm-3"><h3 id="db" onclick="setFont(this);">Make a Wish</h3></div></a>
                                                        <a href="#"><div class="col-sm-3"><h3 id="dbz" onclick="setFont(this);">But take care</h3></div></a>
                                                    </div>
                                                </div>-->
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                <!--END FONTS MODAL-->
                                <input class="btn btn-primary textBtn" type="button" value="Normal" onclick="straight();" disabled="true">
                                <input class="btn btn-primary textBtn" type="button" value="Circle" onclick="circle();" disabled="true">
                                <input class="btn btn-primary textBtn" type="button" value="Bridge" onclick="bridge();" disabled="true">
                                <input class="btn btn-primary textBtn" type="button" value="Valley" onclick="valley();" disabled="true">
                              </div>
                            </div>
                            <div class="panel panel-default">
                              <div class="panel-heading" data-toggle="collapse" data-target="#size_effect">Size &amp; Effect</div>
                              <div id="size_effect" class="collapse panel-body">
                                    <div class="input-group">                           
                                        <span class="input-group-addon">Font Size</span>
                                        <input id="sizeText" type="number" class="form-control" name="sizeText"  min="1" max="2" onkeypress="return resize(event);" >
                                        <span class="input-group-addon">Rotate</span>
                                        <input id="angleText" type="number" class="form-control" name="angleText" onkeypress="return rotate(event);" >
                                    </div>
                              </div>
                            </div>                       
                      </div>  
                </div>                   


                <div id="priceSection" class="tab-pane fade"> 
                    <!--CHANGE QUANTITY-->
                    <!--COMMENTED OUT BECAUSE THIS IS NO LONGER HOW WE SET QUANTITY! TODO DELETE THIS<input class="form-control" id="quantity" type="number" placeholder="Enter quantity" onchange="setQuantity(this.value); showPrice();">-->
                    <!--CART SECTION--> 
                    <div >
                        <style type="text/css">
                            #cart{
                                max-width: 100%;
                            }
                            #cart tr{
                                height: 25%;
                            }
                            #cart td{
                                width: 100%;
                            }
                        </style>
                        <h3>Cart</h3><!--TODO MAKE THIS BUTTON FOR CART MODAL-->
                        <form id="checkout_form"  method="post" action="checkout.php"><!--taken out action="checkout.php"-->
                            <table class="table" id="cart" style="width: 100% !important;">
                                
                            </table>
                            <!-- Trigger the modal with a button -->
                            <button id="productPickerBtn" type="button" class="btn btn-info" data-toggle="modal" data-target="#productPicker" >Add Products</button> <!-- taken out of the button onclick="setDesign();" -->
                            <h3 id="cartTotal"></h3>
                            <input id="total" type="hidden" name="total">
                                                        <?php echo('<input id="ordernumber" type="hidden" name="ordernumber" value = '.$ordernumber.'>'); ?>
                            <!-- Trigger the modal with a button -->
                            <button id="productPickerBtn" type="button" class="btn btn-info" data-toggle="modal" data-target="#productPicker" >Add Products</button> <!-- taken out of the button onclick="setDesign();" -->
                            <h3 id="cartTotal"></h3>
                            <input id="total" type="hidden" name="total">
                            <?php 
                                 /*$ses_sql = mysqli_query($db,"Select Quantity From consecutive where Name = 'Order'");     
                                 $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
                                 $ordernumber = "";
                                if (!$Guest) {
                                    $ordernumber = $login_session.sprintf("%06d", $row['Quantity']);                                     
                                }  
                                else if (isset($_SESSION['Guest'])) 
                                {
                                     $ordernumber = $_SESSION['Guest'].sprintf("%06d", $row['Quantity']);                                           
                                }       
                                $ses_sql = mysqli_query($db,"Update consecutive set Quantity = Quantity + 1 where Name = 'Order'");
                                echo('<input id="ordernumber" type="hidden" name="ordernumber" value = '.$ordernumber.'>');*/
                             ?>
                            
                            <button type="button" id="checkoutBtn"  class="btn btn-success" style="display: none;" onclick="canCheckout_form();">Check Out</button><!-- taken out of button  data-toggle="modal" data-target="#cartModal" onclick="getCheckoutCart();"-->
                        </form>
                        <!--CART MODAL todo delete this-->
                        <div id="cartModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="checkout.php"  method="post" id="cart_checkout_form"><!--taken out action="checkout.php"-->                                            <table id="checkoutCart" class="table">
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                           
                                    </div>
                                    <span>Order Total:<span id="finalTotal" style="display: block;"></span></span>
                                    <div class="modal-footer">
                                        <?php echo('<input id="ordernumber" type="hidden" name="ordernumber" value = '.$ordernumber.'>'); ?>
                                        <button type="button" id="checkoutBtn2" class="btn btn-success" onclick="canCheckout_cart();">Check Out</button>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
 
 
                        <script type="text/javascript">
                            //start of javascript object to keep track of an item
                            var item = new Object();
                            //now creating an array of items called a cart to keep track of all the items
                            var cart = new Array();
                            var cartIndex = 0;  //this is to keep track of the current index in the cart object (possible should match rowNum)
                            //to keep track of current row number
                            var rowNum = 0; 
                            var table = document.getElementById('cart');
                            var sizeSummary = "";   //this is used to show the quantity per size the customer selected.
                            function addToCart(){
                                var itemPrice = getItemPrice();
                                var product = productPreview.style.backgroundImage;
                                var design = designPreview.src;
 
                                var row = table.insertRow(rowNum);
                                var cell0 = row.insertCell(0);
                                var cell1 = row.insertCell(1);
                                var cell2 = row.insertCell(2);
                                var cell3 = row.insertCell(3);
                                var cell4 = row.insertCell(4);
                                var cell5 = row.insertCell(5);
                                var cell6 = row.insertCell(6);
                                //ADDING INFO TO CELLS.
                                cell0.innerHTML = "<div style='width:100%; max-height: 300px; height:100%;  background-image:"+product+"; background-repeat: no-repeat; background-size: cover; background-position: center center;'> <input name='product_"+rowNum+"' type='hidden' value='"+product+"'>"+
                                ""+"<img src='"+design+"' style=' width: 30% !important;  display: block; margin: auto; position: relative; top: 20% !important;'>"+"</div>" + "<input type='hidden' name='product_"+rowNum+"' value="+product+">"+"<input type='hidden' name='design_preview"+rowNum+"' value="+design+">";
                                cell1.innerHTML = "<div style='font-size: 10px;'>product description</div>";
                                cell2.innerHTML = "<div style='width:100px !important;'>" + sizeSummary + "</div>" + '<input min="0" type="hidden" name="yxs_'+rowNum+'" placeholder="yxs" value="'+item.yxs+'"><input min="0"   type="hidden" name="ys_'+rowNum+'" placeholder="ys" value="'+item.ys+'"><input min="0"   type="hidden" name="ym_'+rowNum+'" placeholder="ym" value="'+item.ym+'"><input min="0"   type="hidden" name="yl_'+rowNum+'" placeholder="yl" value="'+item.yl+'"><input min="0"   type="hidden" name="yxl_'+rowNum+'" placeholder="yxl" value="'+item.yxl+'"><input min="0"   type="hidden" name="s_'+rowNum+'" placeholder="s" value="'+item.s+'"><input min="0"   type="hidden" name="m_'+rowNum+'" placeholder="m" value="'+item.m+'"><input min="0"   type="hidden" name="l_'+rowNum+'" placeholder="l" value="'+item.l+'"><input min="0"   type="hidden" name="xl_'+rowNum+'" placeholder="xl" value="'+item.xl+'"><input min="0"   type="hidden" name="2xl_'+rowNum+'" placeholder="2xl" value="'+item.xxl+'"><input min="0"   type="hidden" name="3xl_'+rowNum+'" placeholder="3xl" value="'+item.xxxl+'"><input min="0"   type="hidden" name="4xl_'+rowNum+'" placeholder="4xl" value="'+item.xxxxl+'"><input min="0"   type="hidden" name="5xl_'+rowNum+'" placeholder="5xl" value="'+item.xxxxxl+'">' ;  
                                sizeSummary = ""; //reseting size summary so that another product can be added
                                cell3.innerHTML = "<h6 class='total"+rowNum+"'>$"+itemPrice+"</h6>"+"<input type='hidden' name='itemTotal_"+rowNum+"'' value='"+itemPrice+"'>";
                                cell4.innerHTML = "<button  type='button' class='btn btn-danger' id="+rowNum+" onclick='removeFromCart(this);';>X</button>";
                                cell5.innerHTML = '<input type="hidden" name="front_'+rowNum+'" value="'+designs[0]+'">'+'<input type="hidden" name="right_'+rowNum+'" value="'+designs[1]+'">'+'<input type="hidden" name="back_'+rowNum+'" value="'+designs[2]+'">'+'<input type="hidden" name="left_'+rowNum+'" value="'+designs[3]+'">';   //hidden product went here.
                                cell6.innerHTML = "";   //hidden design went here
                                item.product = product;
                                item.design = design;
                                item.cell0 =  "<div style='width:100px;  background-image:"+product+"; background-repeat: no-repeat; background-size: cover; background-position: center center;'>"+"<img src='"+design+"' style=' width: 50% !important; height: 75% !important; display: block; margin: auto; position: relative; top: 10% !important;'>"+"</div>";
                                item.cell1 = "<p>product description</p>";
                                item.cell2 = '<div><table style="text-align: center;"><tr><td colspan="5">Youth</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="4">Adult</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="4">Plus</td></tr><tr><td>YXS</td><td>YS</td><td>YM</td><td>YL</td><td>YXL</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>S</td><td>M</td><td>L</td><td>XL</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>2XL</td><td>3XL</td><td>4XL</td><td>5XL</td></tr><tr><td><input min="0" onchange="updatePrice(this);" onchange="updatePrice(this);" style="width:100%;" type="hidden" name="yxs_'+rowNum+'" placeholder="yxs" class='+rowNum+' value='+item.yxs+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="ys_'+rowNum+'" placeholder="ys" class='+rowNum+' value='+item.ys+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="ym_'+rowNum+'" placeholder="ym" class='+rowNum+' value='+item.ym+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="yl_'+rowNum+'" placeholder="yl" class='+rowNum+' value='+item.yl+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="yxl_'+rowNum+'" placeholder="yxl" class='+rowNum+' value='+item.yxl+'></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="s_'+rowNum+'" placeholder="s" class='+rowNum+' value='+item.s+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="m_'+rowNum+'" placeholder="m" class='+rowNum+' value='+item.m+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="l_'+rowNum+'" placeholder="l" class='+rowNum+' value='+item.l+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="xl_'+rowNum+'" placeholder="xl" class='+rowNum+' value='+item.xl+'></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="xxl_'+rowNum+'" placeholder="xxl" class='+rowNum+' value='+item.xxl+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="xxxl_'+rowNum+'" placeholder="xxxl" class='+rowNum+' value='+item.xxxl+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="xxxxl_'+rowNum+'" placeholder="xxxxl" class='+rowNum+' value='+item.xxxxl+'></td><td><input min="0" onchange="updatePrice(this);" style="width:100%;" type="number" name="xxxxxl_'+rowNum+'" placeholder="xxxxxl" class='+rowNum+' value='+item.xxxxxl+'></td></tr></table></div>'; 
                                item.cell3 = "<h6 class='total"+rowNum+" itemTotal'>$"+itemPrice+"</h6>";
                                item.cell4 = cell4.innerHTML; item.cell5 = cell5.innerHTML; 
                                if(designArrayIndex + 5 < designArray.length){   //this is to set the index on to the next set of designs if there are any
                                    designArrayIndex += 5;
                                }
                                item.cell6 = "<input type='hidden' name='design_folder_"+rowNum+"'" +"value="+designArray[designArrayIndex]+">";
                                item.cell7 = "<input type='hidden' name='design_front_"+rowNum+"'" +" value="+designArray[designArrayIndex+1]+">";
                                item.cell8 = "<input type='hidden' name='design_right_"+rowNum+"'" +" value="+designArray[designArrayIndex+2]+">";
                                item.cell9 = "<input type='hidden' name='design_back_"+rowNum+"'" +" value="+designArray[designArrayIndex+3]+">";
                                item.cell10 = "<input type='hidden' name='design_left_"+rowNum+"'" +" value="+designArray[designArrayIndex+4]+">";
 
                                cart.push(item);
                                //try adding item = null; or item = new Object();
                                item = new Object();
                                rowNum++;
                                getCartTotal();
                            }
                            function removeFromCart(btn){
                                var row = btn.parentNode.parentNode;
                                row.parentNode.removeChild(row);
                                var num = Number(btn.id);
                                cart.splice(num);
                                getCartTotal();
                                rowNum--;
                            }
                            function getItemPrice(){
                                var yxs = document.getElementById('yxs').value; var ys = document.getElementById('ys').value; var ym = document.getElementById('ym').value;
                                var yl = document.getElementById('yl').value; var yxl = document.getElementById('yxl').value; var s = document.getElementById('s').value;
                                var m = document.getElementById('m').value; var l = document.getElementById('l').value; var xl = document.getElementById('xl').value;
                                var xxl = document.getElementById('xxl').value; var xxxl = document.getElementById('xxxl').value; var xxxxl = document.getElementById('xxxxl').value;
                                var xxxxxl = document.getElementById('xxxxxl').value;
                                //setting size summary
                                sizeSummary += (yxs > 0) ? "<small><span class='line'> YXS: " + yxs + "  </span></small>  " : ""; sizeSummary += (ys > 0) ? "<small><span class='line'> YS: " + ys+ " </span></small> " : ""; sizeSummary += (ym > 0) ? "<small><span class='line'> YM: " + ym+ " </span></small> " : "";
                                sizeSummary += (yl > 0) ? "<small><span class='line'> YL: " + yl+ " </span></small> " : ""; sizeSummary += (yxl > 0) ? "<small><span class='line'> YXL: " + yxl+ " </span></small> " : ""; sizeSummary += (s > 0) ? "<small><span class='line'> S: " + s+ " </span></small> " : "";
                                sizeSummary += (m > 0) ? "<small><span class='line'> M: " + m+ " </span></small> " : ""; sizeSummary += (l > 0) ? "<small><span class='line'> L: " + l+ " </span></small> " : ""; sizeSummary += (xl > 0) ? "<small><span class='line'> XL: " + xl+ " </span></small> " : "";
                                sizeSummary += (xxl > 0) ? "<small><span class='line'> 2XL: " + xxl+ " </span></small> " : ""; sizeSummary += (xxxl > 0) ? "<small><span class='line'> 3XL: " + xxxl+ " </span></small> " : ""; sizeSummary += (xxxxl > 0) ? "<small><span class='line'> 4XL: " + xxxxl+ " </span></small> " : "";
                                sizeSummary += (xxxxxl > 0) ? "<small><span class='line'> 5XL: " + xxxxxl+ " </span></small> " : "";
                                setQuantity(Number(yxs) + Number(ys) + Number(ym) + Number(yl) + Number(yxl) + Number(s) + Number(m) + Number(l) + Number(xl) + Number(xxl) + Number(xxxl) + Number(xxxxl) + Number(xxxxxl));
                                //saving the values in the cart object
                                item.yxs = Number(yxs); item.ys = Number(ys); item.ym = Number(ym) ; item.yl = Number(yl); item.yxl= Number(yxl); item.s = Number(s); item.m = Number(m); item.l = Number(l) ; item.xl = Number(xl); item.xxl = Number(xxl); item.xxxl = Number(xxxl); item.xxxxl = Number(xxxxl); item.xxxxxl = Number(xxxxxl);
                                item.total = pricePerUnit * ( Number(yxs) + Number(ys) + Number(ym) + Number(yl) + Number(yxl) + Number(s) + Number(m) + Number(l) + Number(xl) + Number(xxl) + Number(xxxl) + Number(xxxxl) + Number(xxxxxl) ) ;
                                return pricePerUnit * ( Number(yxs) + Number(ys) + Number(ym) + Number(yl) + Number(yxl) + Number(s) + Number(m) + Number(l) + Number(xl) + Number(xxl) + Number(xxxl) + Number(xxxxl) + Number(xxxxxl) );
                            }
 
                            function getCartTotal(){
                                var columns = document.getElementsByTagName('td');
                                var total = 0.0;
                                for (var i = 0; i < cart.length; i++) {
                                    total += cart[i].total;
                                    console.log(total);
                                }
                                var cartTotal = document.getElementById('cartTotal');
                                var checkoutBtn = document.getElementById('checkoutBtn');
                                var totalPriceLabel = document.getElementById('totalPriceLabel');
                                var finalTotal = document.getElementById('finalTotal');
                                if(total != "Error" && total > 0){
                                    cartTotal.style.display = "block";
                                    checkoutBtn.style.display = "block";
                                    cartTotal.innerHTML = "Total: $" + total;
                                    document.getElementById('total').value = total; //setting hidden input for post
                                    totalPriceLabel.innerHTML = total.toFixed(2);
                                    //finalTotal.style.display = "block";
                                    //finalTotal.innerHTML = "$"  + total;
                                }else{
                                    cartTotal.style.display = "none";
                                    document.getElementById('total').value = 0.0;   //setting hidden input for post
                                    totalPriceLabel.innerHTML = 0.00;
                                    checkoutBtn.style.display = "none";
                                    //finalTotal.style.display = "none";
                                }
 
                                //getting the final total by the item totals
                                var itemTotals = document.getElementsByClassName('itemTotal');
                                var tempSum = 0.0;
                                for (var i = 0; i < itemTotals.length; i++) {
                                    tempSum += Number(itemTotals[i].innerHTML.substring(1));
                                
                                }
                                
                                if(tempSum > 0){
                                    finalTotal.style.display = "block";
                                    finalTotal.innerHTML = "$"+tempSum;
                                }else{
                                    finalTotal.style.display = "none";
                                }
                                return total;
                            }
                            function updatePrice(element){
                                var newTotal = 0.0;
                                //get inputs
                                var inputs = document.getElementsByClassName(element.className);
                                for (var i = 0; i < inputs.length; i++) {
                                    newTotal += Number(inputs[i].value);
                                }
                                //setting item total
                                var totals = document.getElementsByClassName('total' + element.className);
                                for (var i = 0; i < totals.length; i++) {
                                    totals[i].innerHTML = "$" + newTotal;
                                }
                                getCartTotal();
                            }
                            function emptyTable(){
                                var t = document.getElementById('checkoutCart');
                                while(t.rows.length > 0){
                                    t.deleteRow(0);
                                }
                            }
                        </script>
                    </div>
                </div>

                <div id="shareSection" class="tab-pane fade">
                </div>

                <div id="saveSection" class="tab-pane fade">
                    <div class="panel panel-default">
                    <div class="panel-heading">Look at your previous designs!</div>
                    <div class="panel-body">
                           <select class="form-control" id="mydesings"  onChange="loadImages();"> 
                    <?php                                  
                        echo ('<option title="Select the design">Select the design</option>');     
                        if (isset($_SESSION['login_user']))       
                        {       
                                $folder = $_SESSION['login_user'];      
 
                                $dir    =  dirname(__FILE__).'/'.$folder;       
                                if (is_dir($dir))       
                                {       
                                    $scanned_directory = scandir($dir);         
                                }                                                   
         
                                for ($i=2; $i<count($scanned_directory) ; $i++)         
                                {               
                                       echo ('<option title="'.$scanned_directory[$i].'">'.$scanned_directory[$i].'</option>');       
                                }                       
                        }                                               
                                 
                    ?>
                        </select> 
                         <br>
                    </div>
                  </div
                    <!--SAVED DESIGN-->
                    <style type="text/css">
                        #savedDesigns img{
                            border: 1px solid #eeeeee;
                        }
                    </style>
                    <div id="savedDesigns">
                        <table>
                        <tbody>
                        <tr>
                        <td>
                             <div id="frontSavedDesing"  style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="frontSavePreview" src="" onclick="LoadDesings(null)">
                             </div> 
                        </td>
                        <td>
                             <div id="rightSavedDesing" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="rightSavePreview" src=""  onclick="LoadDesings(null)">
                             </div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                             <div id="backSavedDesing" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="backSavePreview" src=""  onclick="LoadDesings(null)">
                             </div> 
                        </td>
                        <td>
                             <div id="leftSavedDesing" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="leftSavePreview" src=""  onclick="LoadDesings(null)">
                             </div>
                        </td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                    <script type="text/javascript">
                        //Hide the saved design previews until the user has saved a design and would like to see it again
                        var savedDesignsDiv = document.getElementById('savedDesigns');
                        savedDesignsDiv.style.display = "none";
     
                           function loadImages()
                           {
                                //shows previews of saved design when user wants to see a saved design
                                
                                var design =   document.getElementById("mydesings").value;

                                if (design != 'Select the design') 
                                {
                                  savedDesignsDiv.style.display = "block";
                                  var guest = design.split("_", 1);       
                                  var file = guest+ '/' + design + '/' + design;

                                  document.getElementById('frontSavePreview').src = file+ '_front.png';
                                  document.getElementById('rightSavePreview').src = file+ '_right.png';
                                  document.getElementById('backSavePreview').src = file+ '_back.png';
                                  document.getElementById('leftSavePreview').src = file+ '_left.png';
                                }
                                else
                                {
                                    savedDesignsDiv.style.display = "none";
                                }     
                           }
     
                           function LoadDesings(value)
                           {   
                                //shows previews of saved design when user wants to see a saved design
                                
                                if (value == null)
                                {
                                  var desing =   document.getElementById("mydesings").value;
                                  savedDesignsDiv.style.display = "block";
                                }
                                else
                                {
                                  savedDesignsDiv.style.display = "none";
                                  var desing =  value;
                                }
                                 
                                var guest = desing.split("_", 1);
                                var file = guest+ '/' + desing + '/' + desing + '.json';
       
                                $.ajax({
                                     type:    "GET",
                                     dataType: "JSON",
                                     url:     file ,
                                     success: function(text) {                                         
                                          //document.getElementById('frontCanvasShirtDesing').style.backgroundImage = "url("+imgSrc+")"; 
                                          front.loadFromDatalessJSON(text[0], front.renderAll.bind(front), function(o, object) {
                                          fabric.log(o, object); 
                                           });
       
                                          right.loadFromJSON(text[1], right.renderAll.bind(right), function(o, object) {
                                          fabric.log(o, object); 
                                           });
       
                                          back.loadFromJSON(text[2], back.renderAll.bind(back), function(o, object) {
                                          fabric.log(o, object); 
                                           });
       
                                          left.loadFromJSON(text[3], left.renderAll.bind(left), function(o, object) {
                                          fabric.log(o, object);         
                                         
                                         });                                                                            
                                     },
                                     error:   function() {
                                         alert("error");
                                     }
                                 });                             
             
                          }
                    </script>
                    <!--SHARE SECTION-->
                    <div class="panel panel-default">
                    <div class="panel-heading">Share</div>
                    <div class="panel-body">
                          <form class="form-horizontal" >
                            <p>Via Facebook, Twitter, Instagram, or Email!</p>
                            <i class="fa fa-facebook" aria-hidden="true" style="font-size: 5vh;"></i>
                            <i class="fa fa-twitter" aria-hidden="true" style="font-size: 5vh;"></i>
                            <i class="fa fa-instagram" aria-hidden="true" style="font-size: 5vh;"></i>
                            <i class="fa fa-envelope-o" aria-hidden="true" style="font-size: 5vh;"></i>
                          </form>
                          
                          <form class="form-horizontal" id="emailform">

                             <!--URLs for front, right, back, and left designs with products-->
                              <input type="hidden" id="frontShirtURL" name="frontShirtURL">
                              <input type="hidden" id="frontImageURL" name="frontImageURL">
                              <input type="hidden" id="rightShirtURL" name="rightShirtURL">
                              <input type="hidden" id="rightImageURL" name="rightImageURL">
                              <input type="hidden" id="backShirtURL" name="backShirtURL">
                              <input type="hidden" id="backImageURL" name="backImageURL">
                              <input type="hidden" id="leftShirtURL" name="leftShirtURL">
                              <input type="hidden" id="leftImageURL" name="leftImageURL">
                              <input type="hidden" id="designURL" name="designURL">

                            <div class="input-group" >
                              <span class="input-group-addon">From:</span>
                              <input id="from_email" type="text" class="form-control" name="from_email" placeholder="Enter your email">
                            </div>     
                            <br>                      
                            <div class="input-group" >
                              <span class="input-group-addon">To:</span>
                              <input id="to_email" type="text" class="form-control" name="to_email" placeholder="Enter email">
                            </div> 
                            <br>
                            <div class="input-group" >
                              <span class="input-group-addon">Message:</span>
                              <textarea id="message" type="text" class="form-control" name="message" placeholder="Enter message"></textarea>
                            </div>
                            <br> 
                    <!--SHARE DESIGN PREVIEWS-->
                    <div id="shareDesigns" class="row">
                        <div class="col-sm-3">
                            <div id="frontSharePreviewCase" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                                <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="sharePreviewFront" src="">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div id="rightSharePreviewCase" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                                <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="sharePreviewRight" src="">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div id="backSharePreviewCase" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                                <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="sharePreviewBack" src="">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div id="leftSharePreviewCase" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                                <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="sharePreviewLeft" src="">
                            </div>
                        </div>
                    </div>
                    <br>
                              <button type="button" name="submit" class="btn btn-primary fa fa-envelope-o pull-right" onclick="sendemail();"></button>
                          </form>
                    </div>
                  </div>                       
                      
                    <script type="text/javascript">
                      function sendemail()
                           {
                              $.ajax({
                                    type: "POST",
                                    url: "email.php",
                                    data: {
                                            frontShirtURL: document.getElementById("frontShirtURL").value,
                                            frontImageURL: document.getElementById("frontImageURL").value,
                                            rightShirtURL: document.getElementById("rightShirtURL").value,
                                            rightImageURL: document.getElementById("rightImageURL").value,
                                            backShirtURL: document.getElementById("backShirtURL").value,
                                            backImageURL: document.getElementById("backImageURL").value,
                                            leftShirtURL: document.getElementById("leftShirtURL").value,
                                            leftImageURL: document.getElementById("leftImageURL").value,
                                            designURL: document.getElementById("designURL").value,
                                            to_email: document.getElementById("to_email").value,
                                            from_email: document.getElementById("from_email").value,
                                            message: document.getElementById("message").value
                                            },
                                    success: function(data)
                                    {
                                         var message = document.getElementById("emailmessage");                                         
                                          message.style.display="block";
                                          setTimeout(function(){ message.style.display="none"; }, 3000);                                        
                                    },
                                    error: function (error)
                                    {
                                        var message = document.getElementById('emailerrormessage');
                                            message.style.display="block";
                                        setTimeout(function(){ message.style.display="none"; }, 3000);
                                    }
                                })     
                           }
                    </script>
                    <script type="text/javascript">
                        //used to make share designs preview visible at the right time
                        var shareDesignsDiv = document.getElementById('shareDesigns');
                        shareDesignsDiv.style.display = "none";
                        //this sets a default product background in case the user hasn't selected a product yet
                        document.getElementById('frontSharePreviewCase').style.backgroundImage = "url(img/shirt_white.jpg)";
                        document.getElementById('rightSharePreviewCase').style.backgroundImage = "url(img/shirt_white.jpg)";
                        document.getElementById('backSharePreviewCase').style.backgroundImage = "url(img/shirt_white.jpg)";
                        document.getElementById('leftSharePreviewCase').style.backgroundImage = "url(img/shirt_white.jpg)";
                        //to hold the current folder address
                        var fileAddress = "";
                        function share(){
                            uploadEx(); //getImage() is called inside uploadEx()
                        }
                        

                        function getImage(fileAddress){
                           
                            //taking the folder and making a substring by '_' so we can get the folder name
                            var folderName = fileAddress.split("_",1);
                            designArray.push(folderName);   //saving the most recent design for check out purposes.
                            //SETTING FRONT IMAGE AND FORM DATA
                            var picture = folderName + "/" + fileAddress + "/" + fileAddress + "_front.png";
                            
                            document.getElementById('sharePreviewFront').src = picture;
                            var imageLocation = window.location.href;
                            
                            document.getElementById('frontImageURL').value = imageLocation.substring(0, imageLocation.indexOf('ui')) + picture;
                            
                            designs[0] = imageLocation.substring(0, imageLocation.indexOf('ui')) + picture; //used to save most recent design to save to car item
                            designArray.push(imageLocation.substring(0, imageLocation.indexOf('ui')) + picture);    //saving the most recent design for check out purposes 
                            //SETTING RIGHT IMAGE AND FORM DATA
                            picture = folderName + "/" + fileAddress + "/" + fileAddress + "_right.png";
                            document.getElementById('sharePreviewRight').src = picture; 
                            document.getElementById('rightImageURL').value = imageLocation.substring(0, imageLocation.indexOf('ui')) + picture;
                            designs[1] = imageLocation.substring(0, imageLocation.indexOf('ui')) + picture; //used to save most recent design to save to car item
                            designArray.push(imageLocation.substring(0, imageLocation.indexOf('ui')) + picture);    //saving the most recent design for check out purposes 
                            //SETTING BACK IMAGE AND FORM DATA
                            picture = folderName + "/" + fileAddress + "/" + fileAddress + "_back.png";
                            document.getElementById('sharePreviewBack').src = picture;
                            document.getElementById('backImageURL').value = imageLocation.substring(0, imageLocation.indexOf('ui')) + picture;
                             designs[2] = imageLocation.substring(0, imageLocation.indexOf('ui')) + picture; //used to save most recent design to save to car item
                            designArray.push(imageLocation.substring(0, imageLocation.indexOf('ui')) + picture);    //saving the most recent design for check out purposes 
                            //SETTING RIGHT IMAGE AND FORM DATA
                            picture = folderName + "/" + fileAddress + "/" + fileAddress + "_left.png";
                            document.getElementById('sharePreviewLeft').src = picture;
                            document.getElementById('leftImageURL').value = imageLocation.substring(0, imageLocation.indexOf('ui')) + picture;
                            designs[3] = imageLocation.substring(0, imageLocation.indexOf('ui')) + picture; //used to save most recent design to save to car item
                            designArray.push(imageLocation.substring(0, imageLocation.indexOf('ui')) + picture);    //saving the most recent design for check out purposes 
 
                            //getting the product image TODO change the way this is set!
                            var frontShirt = document.getElementById('description_image').src;
                            document.getElementById('frontShirtURL').value = frontShirt;
                            document.getElementById('rightShirtURL').value = frontShirt;
                            document.getElementById('backShirtURL').value = frontShirt;
                            document.getElementById('leftShirtURL').value = frontShirt;
                            document.getElementById('designURL').value =  fileAddress;
 
                            //showing the most recent saved design with the most recent product in preperation to be shared
                            shareDesignsDiv.style.display = "block";
 
                            
                        }
                    </script>
                </div>

                <div id="textDesign">
                 

                 <!-- COMMENTED OUT FOR TESTING ABOVE 
                  <canvas id="c" width="400" height="200"></canvas><br/>
                  <input type="text" id="testtext" value="CurvedText" /><br>
                  Reverse : <input type="checkbox" name="reverse" id="reverse" /><br>
                  Radius : <input type="range" min="0" max="100" value="50" id="radius" /><br>
                  Spacing : <input type="range" min="5" max="40" value="20" id="spacing" /><br>
                  Color : <input type="color" value="#0000ff" id="fill" /><br>
                  Effect : 
                  <select name="effect" id="effect" >
                    <option value="curved">Curved</option>
                    <option value="arc">Arc</option>
                    <option value="STRAIGHT">STRAIGHT</option>
                    <option value="smallToLarge">smallToLarge</option>
                    <option value="largeToSmallTop">largeToSmallToped</option>
                    <option value="largeToSmallBottom">largeToSmallBottom</option>
                    <option value="bulge">bulge</option>
                  </select>
                  <br>
                  <br>
                  <button id="convert">Convert Text/Curved</button>
                  <button id="save">Save/Reload</button>
                  
                  <script>
                    
                    canvas = new fabric.Canvas('c');
                    canvas.on('selection:cleared', onDeSelected);
                    canvas.on('object:selected', onSelected);
                    canvas.on('selection:created', onSelected);
                    var CurvedText = new fabric.CurvedText('CurvedText',{
                      //width: 100,
                      //height: 50,
                      left: 100,
                      top: 100,
                      textAlign: 'center',
                      fill: '#0000FF',
                      radius: 150,
                      fontSize: 25,
                      spacing: 20,
                      fontFamily: 'spongebob'
                    });
                    canvas.add(CurvedText).renderAll();
                    canvas.setActiveObject(canvas.item(canvas.getObjects().length-1));
                    $('#testtext').keyup(function(){
                      var obj = canvas.getActiveObject();
                      if(obj){
                        obj.setText(this.value);
                        canvas.renderAll();
                      }
                    });
                    $('#reverse').click(function(){
                      var obj = canvas.getActiveObject();
                      if(obj){
                        obj.set('reverse',$(this).is(':checked')); 
                        canvas.renderAll();
                      }
                    });
                    $('#radius, #spacing').change(function(){ // , #fill was taken out of the selector
                      var obj = canvas.getActiveObject();
                      if(obj){
                        obj.set($(this).attr('id'),$(this).val()); 
                      }
                      canvas.renderAll();
                    });
                    $('#radius, #spacing').change(function(){// , #effect was taken out of the selector
                      var obj = canvas.getActiveObject();
                      if(obj){
                        obj.set($(this).attr('id'),$(this).val()); 
                      }
                      canvas.renderAll();
                    });
                    /*This is commented out because #fill is commented out
                    $('#fill').change(function(){
                      var obj = canvas.getActiveObject();
                      if(obj){
                        obj.setFill($(this).val()); 
                      }
                      canvas.renderAll();
                    });*/
                    /*Commented because #save was commented out
                    $('#save').click(function() {
                      var design = JSON.stringify(canvas.toJSON());
                      canvas.clear();
                      canvas.renderAll();
                      canvas.loadFromJSON(design, function() {
                        console.log('loaded');      
                        canvas.renderAll();
                      });
                    });*/
                    $('#convert').click(function(){
                      var props = {};
                      var obj = canvas.getActiveObject();
                      if(obj){
                        if(/curvedText/.test(obj.type)) {
                          default_text = obj.getText();
                          props = obj.toObject();
                          delete props['type'];
                          var textSample = new fabric.Text(default_text, props);
                        }else if(/text/.test(obj.type)) {
                          default_text = obj.getText();
                          props = obj.toObject();
                          delete props['type'];
                          props['textAlign'] = 'center';
                          props['radius'] = 50;
                          props['spacing'] = 20;
                          var textSample = new fabric.CurvedText(default_text, props);
                        }
                        canvas.remove(obj);
                        canvas.add(textSample).renderAll();
                        canvas.setActiveObject(canvas.item(canvas.getObjects().length-1));
                      }
                    });
                    function onSelected(){
                      var obj = canvas.getActiveObject();
                      $('#testtext').val(obj.getText());
                      $('#reverse').prop('checked', obj.get('reverse'));
                      $('#radius').val(obj.get('radius'));
                      $('#spacing').val(obj.get('spacing'));
                      //$('#fill').val(obj.getFill());
                      /*Commented out because #effect was commented out
                      if(obj.getEffect) {
                        $('#effect').val(obj.getEffect());
                      }*/
                    }
                    function onDeSelected(){
                      $('#testtext').val('');
                      $('#reverse').prop('checked', false);
                      $('#radius').val(50);
                      $('#spacing').val(20);
                      //$('#fill').val('#0000FF');
                      //$('#effect').val('curved');
                    }
                  </script>-->
                </div>

            </div>
        </div>
        <!--END  TAB CONTENT-->
        <!--START SHIRT SECTION-->
        <div class="col-sm-7" style="height: 90%;" >
            <!--START CAROUSEL-->
            
              <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false" >
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li id="frontActive" data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li id="rightActive" data-target="#myCarousel" data-slide-to="1"></li>
                  <li id="backActive" data-target="#myCarousel" data-slide-to="2"></li>
                  <li id="leftActive" data-target="#myCarousel" data-slide-to="3"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <div class="item active" id="test">
                            <!--<div id="canvasShirt" style="width: 750; height: 1000; display: block; margin: auto; background-image: url('img/shirt.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
                                <canvas id="frontCanvas" width="488" height="650"  style="margin: 175 131 175 131;  border: 1px solid #000000; display: block;"></canvas>
                            </div>-->
                            <style type="text/css">
                                
                                .canvasShirt{
                                    width: 100%;
                                    height: 100%;
                                    background-image: url('img/white_shirt.png');
                                    background-repeat: no-repeat;
                                    background-size: cover;
                                    background-position: center center;
                                }
                                #canvas-wrapper{
                                    border: 1px solid #eeeeee;
                                    width: 50%;
                                    height: 75%;
                                    position: relative;
                                    margin: auto;
                                    top: 10%;
                                }                                
 
                            </style>
                            <div class="canvasShirt" id="frontCanvasShirt">
                                <div id="canvas-wrapper"><canvas id="frontCanvas"></canvas></div>
                            </div>
                    <div class="carousel-caption">
                      <p>Front</p>
                    </div>
                  </div>
 
                  <div class="item">
                        <!--<div id="canvasShirt" style="width: 750; height: 1000; display: block; margin: auto; background-image: url('img/shirt.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
                            <canvas id="rightCanvas" width="244" height="325"  style="margin: 350 262 350 262;  border: 1px solid #000000; display: block;"></canvas>
                        </div>-->
                        <div class="canvasShirt" id="rightCanvasShirt">
                            <div id="canvas-wrapper"><canvas id="rightCanvas"></canvas></div>
                        </div>
                    <div class="carousel-caption">
                      <p>Right</p>
                    </div>
                  </div>
                
                  <div class="item">
                         <!--<div id="canvasShirt" style="width: 750; height: 1000; display: block; margin: auto; background-image: url('img/shirt.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
                            <canvas id="backCanvas" width="488" height="650"  style="margin: 175 131 175 131;  border: 1px solid #000000; display: block;"></canvas>
                        </div>-->
                        <div class="canvasShirt" id="backCanvasShirt">
                            <div id="canvas-wrapper"><canvas id="backCanvas"></canvas></div>
                        </div>
                    <div class="carousel-caption">
                      <p>Back</p>
                    </div>
                  </div>
              
                    <!--start-->
                          <div class="item">
                            <!--<div id="canvasShirt" style="width: 750; height: 1000; display: block; margin: auto; background-image: url('img/shirt.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
                                <canvas id="leftCanvas" width="244" height="325"  style="margin: 350 262 350 262;  border: 1px solid #000000; display: block;"></canvas>
                            </div>-->
                            <div class="canvasShirt" id="leftCanvasShirt">
                                <div id="canvas-wrapper"><canvas id="leftCanvas"></canvas></div>
                            </div>
                    <div class="carousel-caption">
                        <p>Left</p>
                    </div>
                  </div>
                    <!--end-->
                </div>
 
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev" onclick="setCanvas('previous');">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next" onclick="setCanvas('next');">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
                <script type="text/javascript">
                </script>
            <!--END CAROUSEL-->
        </div>
        
        <!--END  SHIRT SECTION-->
        <!-- Progress Bar Modal -->
        <div id="mProgressBarModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">                  
              <div class="modal-body">
                <div class="progress progress-success">
                    <div id="progressBar" class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"  style="float: left; width: 0%; " data-percentage="100"></div>
                </div>
              </div>                  
            </div>

          </div>
        </div>
        </div>
        <style type="text/css">
              .card-footer{
                position:bottom;
                bottom:0;
                width:100%;
              }
        </style>   
        <div class="card-footer text-muted">
          <div class="container">
               <center><p>&copy; 2017 Vivid Customs</p>
                <ul class="list-inline">
                    <li>
                        <a href="#">Privacy</a>
                        |
                        <a href="#">Terms</a> 
                        |
                        <a href="#">FAQ</a>
                        |
                        <a href="draw.html">Design</a>
                    </li>
                </ul>
                </center>
            </div>
        </div>    
 </div>
</div>
<!--END  NEW PAGE-->
 
    
    <!--<script src="lib/fabric.js"></script>-->
    <!--NEEDED JS TO CUSTOMIZE-->
    <script type="text/javascript">
        fabric.Object.prototype.setControlsVisibility( {
            ml: false,
            mr: false,
            mb: false//,
            //mt: false
        } );
        fabric.Canvas.prototype.customiseControls({
           mt: {
            action: 'moveUp',
            cursor: 'pointer'
          },
            tl: {
                action: 'remove',
                cursor: 'pointer'
            },
            tr: {
                action: 'rotate',
                cursor: 'pointer'
            },
            bl: {
                action: 'scale',
                cursor: 'pointer'
            },
            br: {
                action: 'scale',
                cursor: 'pointer'
            }
        }, function() {
            //canvas.renderAll();
            front.renderAll();
            right.renderAll();
            back.renderAll();
            left.renderAll();
        } );
        
        fabric.Object.prototype.customiseCornerIcons({
            settings: {
                borderColor: 'rgba(100,100,100,100)', //rrgba(100,100,100,100)
                cornerSize: 20,
                cornerShape: 'circle',
                cornerBackgroundColor: 'rgba(100,100,100,100)', //rrgba(100,100,100,100)
                cornerPadding: 5,
                                hasRotatingPoint: false
            },
            mt:{
              icon: 'img/up.png',
            },
            tl: {
                icon: 'img/x.png', //icons/rotate.svg
            },
            tr: {
                icon: 'img/rotate_2.png', //img/resize.svg
            },
            bl: {
                icon: 'img/resize_left.png',
            },
            br: {
               icon: 'img/resize_right.png',
            },/*,
            mb: {
                icon: 'icons/down.svg'
            }*/
        }, function() {
            //canvas.renderAll();
            front.renderAll();
            right.renderAll();
            back.renderAll();
            left.renderAll();
        } );
 
    </script>
 
    <script>
        //var canvas = new fabric.Canvas('frontCanvas');
        var additionalpictures = "";
        var canvasCounter = 1;
        var front = new fabric.Canvas('frontCanvas'); 
        var right = new fabric.Canvas('rightCanvas');
        var back = new fabric.Canvas('backCanvas');
        var left = new fabric.Canvas('leftCanvas'); 
        var text = "";
        var colorText = "#000000";
        var colorArt = "#000000";
        var strokeColor = "#000000";
        var font = 'Ariel'; 
        front.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        front.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        right.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        right.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        back.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        back.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        left.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        left.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        var objId = 0.0;
        //front.height = "900";//document.getElementById('canvas-wrapper').offsetWidth;
        //the following variables are used to keep track of colors for pricing purposes
        /*TODO: 
        *get number of objects (name and location) that is on canvas
        *calc cost of product when the user changes product
        *include number of back colors
        *include number of side colors
        *include number discount for other colored sides
        */
        var numOfColors = 0;
        var textAdded = false;
        var clipArtAdded = false;
        var imageUploaded = false;
        var colorChanged = false;
        var rezided = false;
        var quantityOfProduct = 1;
        var costOfProduct = 1.0;
        var pricePerUnit = 0.0;
        var totalPrice = 0.0;
        var numObjectsFront = 0;
        var numObjectsRight = 0;
        var numObjectsBack = 0;
        var numObjectsLeft = 0;

        var leftpos = 0;
        var frontTop = front.height/2;
        var leftTop = left.height/2;
        var backTop = back.height/2;
        var rightTop = right.height/2;
        
        initCenteringGuidelines(front);
        initAligningGuidelines(front);
        initCenteringGuidelines(right);
        initAligningGuidelines(right);
        initCenteringGuidelines(back);
        initAligningGuidelines(back);
        initCenteringGuidelines(left);
        initAligningGuidelines(left);
 
        //SETTING quantityOfProduct
        function setQuantity(value){
            quantityOfProduct = value;
        }
        //CALCULATING PRICE
        function calcPrice(){
            var pricePerColor = 0.0;
            pricePerUnit = 0.0;
            //TODO change the if statements below : if a user has 1 clip art and checks the price, then changes quantity and checks again, the number of colors double
            if (textAdded)    numOfColors += 2;
            if (clipArtAdded) numOfColors++;
            if (imageUploaded) numOfColors += 5;
            textAdded = clipArtAdded = imageUploaded = false;
            //TODO determining number of colors based on each object
            
            if (quantityOfProduct < 5){
                pricePerUnit = costOfProduct + 17;
            } else if (quantityOfProduct < 11){
                pricePerColor = numOfColors < 4 ? 14.00 : 15.00;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            } else if (quantityOfProduct < 24){
                pricePerColor = numOfColors < 2 ? 5.5 : numOfColors < 3 ? 9.75 : numOfColors <= 4 ? 13.00 : 15;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            } else if (quantityOfProduct < 36){
                pricePerColor = numOfColors < 2 ? 4.75 : numOfColors < 3 ? 7.65 : numOfColors < 4 ? 8.75 : numOfColors < 5 ? 10.25 : numOfColors < 6 ? 13.0 : 15.0;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            } else if (quantityOfProduct < 48){
                pricePerColor = numOfColors < 2 ? 4.0 : numOfColors < 3 ? 5.0 : numOfColors < 4 ? 7.0 : numOfColors < 5 ? 8.75 : numOfColors < 6 ? 9.0 : numOfColors < 7 ? 10.3 : numOfColors < 7 ? 11.30 : 12.3;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            } else if (quantityOfProduct < 70){
                pricePerColor = numOfColors < 2 ? 3.5 : numOfColors < 3 ? 4.0 : numOfColors < 4 ? 5.0 : numOfColors < 5 ? 5.65 : numOfColors < 6 ? 6.4 : numOfColors < 7 ? 7.2 : numOfColors < 7 ? 8.0 : 9.0;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            } else if (quantityOfProduct < 150){
                pricePerColor = numOfColors < 2 ? 2.85 : numOfColors < 3 ? 3.5 : numOfColors < 4 ? 4.0 : numOfColors < 5 ? 4.65 : numOfColors < 6 ? 5.00 : numOfColors < 7 ? 5.45 : numOfColors < 7 ? 5.95 : 6.95;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            } else if (quantityOfProduct < 300){
                pricePerColor = numOfColors < 2 ? 2.55 : numOfColors < 3 ? 3.0 : numOfColors < 4 ? 3.35 : numOfColors < 5 ? 3.75 : numOfColors < 6 ? 4.00 : numOfColors < 7 ? 4.5 : numOfColors < 7 ? 4.7 : 5.7;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            } else if (quantityOfProduct < 500){
                pricePerColor = numOfColors < 2 ? 2.5 : numOfColors < 3 ? 2.75 : numOfColors < 4 ? 3.0 : numOfColors < 5 ? 3.3 : numOfColors < 6 ? 3.5 : numOfColors < 7 ? 3.8 : numOfColors < 7 ? 4.1 : 4.90;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            } else if (quantityOfProduct < 700){
                pricePerColor = numOfColors < 2 ? 2.25 : numOfColors < 3 ? 2.50 : numOfColors < 4 ? 2.75 : numOfColors < 5 ? 3.0 : numOfColors < 6 ? 3.25 : numOfColors < 7 ? 3.5 : numOfColors < 7 ? 3.75 : 4.25;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            } else {
                pricePerColor = numOfColors < 2 ? 2.05 : numOfColors < 3 ? 2.25 : numOfColors < 4 ? 2.50 : numOfColors < 5 ? 2.85 : numOfColors < 6 ? 3.10 : numOfColors < 7 ? 3.40 : numOfColors < 7 ? 3.65 : 3.9;
                pricePerUnit = costOfProduct + numOfColors * pricePerColor;
            }
            totalPrice = pricePerUnit * quantityOfProduct;
            //setting everything to 2 decimal places for dollar amout
            pricePerUnit = pricePerUnit.toFixed(2);
            totalPrice = totalPrice.toFixed(2);
            
        }
        //SHOWING PRICE
        function showPrice(){
            //TODO when rotating the shirt, make sure you save the number of objects that are on that side

            /*OLD CODE. REWRITTING TO SHOW PRICE WHEN CUSTOMER IS ADDING ITEM TO CART
            document.getElementById('forChrome').style.display = 'none';
            document.getElementById('showPrice').innerHTML = "";
            calcPrice();
            document.getElementById('showPrice').innerHTML = "price per shirt : " + pricePerUnit + " <br> total price : " + totalPrice;
            if(front.getObjects().length > 0 || right.getObjects().length > 0 || back.getObjects().length > 0 || left.getObjects().length > 0){
                document.getElementById('buybtn').style.display = 'block';
            }else{
                document.getElementById('buybtn').style.display = 'none';
            }*/
        }
        function setCanvas(direction){
            if( direction == 'next' ){
                if( $("#frontActive").hasClass('active') ){
                    canvasCounter = 2;
                }
                if( $("#rightActive").hasClass('active') ){
                    canvasCounter = 3;
                }
                if( $("#backActive").hasClass('active') ){
                    canvasCounter = 4;
                }
                if( $("#leftActive").hasClass('active') ){
                    canvasCounter = 1;
                }
            } else {
                if( $("#frontActive").hasClass('active') ){
                    canvasCounter = 4;
                }
                if( $("#rightActive").hasClass('active') ){
                    canvasCounter = 1;
                }
                if( $("#backActive").hasClass('active') ){
                    canvasCounter = 2;
                }
                if( $("#leftActive").hasClass('active') ){
                    canvasCounter = 3;
                }
            }
        }
 
        //UPLOADING IMAGE
        function uploadImage(){
            var preview = document.getElementById('imgPreview');
            var file = document.getElementById('imgUpload').files[0]; 
            var reader = new FileReader();
            reader.onload = function (){
                preview.src = reader.result;
                 ShowAddImg(reader.result);
            }
 
            //SIZING THE IMG PREVIEW BEING UPLOADED
            preview.style.width = "10vw";
            preview.style.height = "10vw";
 
            if(file){
                preview.src = reader.readAsDataURL(file);
                imageUploaded = true; //set for pricing purposes
            } else{
                preview.src = "";
            }
        }
        
        //ADDING CLIP ART TO CANVAS
        function ShowAddImg(element){
            
            //getting img src
            var imgSrc = element;
            //adding image to canvas
            fabric.Image.fromURL(imgSrc, function(img){
                    img.set({
                        id: objId,
                        left: img.width/4,
                        top: img.height/4,
                        scaleX: 0.3,
                        scaleY: 0.3,
                        width: img.width/2,
                        height: img.height/2,
                        originX: 'center',
                        originY: 'center',
                        hasRotatingPoint: false,                         
                    });
                    // overwrite the prototype object based
                    img.customiseCornerIcons({
                        settings: {
                            borderColor: 'rgba(100,100,100,100)', //black
                            cornerSize: 20,
                            cornerShape: 'circle',
                            cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                            cornerPadding: 5,
                                hasRotatingPoint: false
                        },
                        tl: {
                            icon: 'img/x.png', //icons/rotate.svg
                        },
                        tr: {
                            icon: 'img/rotate_2.png', //img/resize.svg
                        },
                        bl: {
                            icon: 'img/resize_left.png',
                        },
                        br: {
                            icon: 'img/resize_right.png',
                        },
            
                    }, function() {
                        front.renderAll();
                        right.renderAll();
                        back.renderAll();
                        left.renderAll();
                    });
                    //DECIDING WHICH CANVAS TO ADD TOO
                    switch (canvasCounter){
                        case 1:
                            front.add(img).setActiveObject(img);
                            break
                        case 2:
                            right.add(img).setActiveObject(img);
                            break;
                        case 3:
                            back.add(img).setActiveObject(img);
                            break;
                        default:
                            left.add(img).setActiveObject(img);
                    }
                    //canvas.add(img);
                    //this is where animation would go          
            }); 
            clipArtAdded = true; //set for pricing purposes
        }
 
 
        //ADDING CLIP ART TO CANVAS
        function addImg(element){
            //getting img src
            var imgSrc = element.src;
            //adding image to canvas
            fabric.Image.fromURL(imgSrc, function(img){
 
                    img.set({
                        id: objId,
                        left: 200,
                        top: 200,
                        scaleX: 0.5,
                        scaleY: 0.5,
                        originX: 'center',
                        originY: 'center',
                        hasRotatingPoint: false,                        
                    });
                    // overwrite the prototype object based
                    img.customiseCornerIcons({
                        settings: {
                            borderColor: 'rgba(100,100,100,100)', //rrgba(100,100,100,100)
                            cornerSize: 20,
                            cornerShape: 'circle',
                            cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                            cornerPadding: 5,
                                hasRotatingPoint: false
                        },
                        tl: {
                            icon: 'img/x.png', //icons/rotate.svg
                        },
                        tr: {
                            icon: 'img/rotate_2.png', //img/resize.svg
                        },
                        bl: {
                            icon: 'img/resize_left.png',
                        },
                        br: {
                            icon: 'img/resize_right.png',
                        },
                        
                    }, function() {
                        front.renderAll();
                        right.renderAll();
                        back.renderAll();
                        left.renderAll();
                    });
 
  
                    //DECIDING WHICH CANVAS TO ADD TOO
                    switch (canvasCounter){
                        case 1:
                            front.add(img).setActiveObject(img);
                            //front.setActiveObject(img);
                            break
                        case 2:
                            right.add(img).setActiveObject(img);
                            //right.setActiveObject(img);
                            break;
                        case 3:
                            back.add(img).setActiveObject(img);
                            //back.setActiveObject(img);
                            break;
                        default:
                            left.add(img).setActiveObject(img);
                            //left.setActiveObject(img);
                    }
                    //this is where animation would go          
            }); 
            clipArtAdded = true; //set for pricing purposes
        }
        objId++;
        function changeColor(newColor){
            //this is to record what was done for the purpose of saving designs
            colorChanged = true;
            //TEST TEXT DESIGN COLOR CHANGE
            colorArt = newColor;
            //this is to style the list so that you can see what you clicked on
            $(".list-group-item").removeClass("active");
            $(this).addClass("active");
            //DECIDING WHICH CANVAS TO GET OBJECT FROM
            switch (canvasCounter){
                case 1:
                    var object = front.getActiveObject();
                    break
                case 2:
                    var object = right.getActiveObject();
                    break;
                case 3:
                    var object = back.getActiveObject();
                    break;
                default:
                    var object = left.getActiveObject();
            }
            //var object = canvas.getActiveObject();
            var filter = new fabric.Image.filters.Tint({
              color: newColor, //color: 'rgba(53, 21, 176, 0.5)'  '#3513B0'
              opacity: 1.0
            });
            object.filters.push(filter);
            //DECIDING WHICH CANVAS TO APPLY FILTER TOO
            switch (canvasCounter){
                case 1:
                    object.applyFilters(front.renderAll.bind(front));
                    break
                case 2:
                    object.applyFilters(right.renderAll.bind(right));
                    break;
                case 3:
                    object.applyFilters(back.renderAll.bind(back));
                    break;
                default:
                    object.applyFilters(left.renderAll.bind(left));
            }
            //object.applyFilters(canvas.renderAll.bind(canvas));
        }

         function changeColorText(newColor,type){
            
            //this is to record what was done for the purpose of saving designs
            colorChanged = true;

            //this is to style the list so that you can see what you clicked on
            $(".list-group-item").removeClass("active");
            $(this).addClass("active");
            //DECIDING WHICH CANVAS TO GET OBJECT FROM
            switch (canvasCounter){
                case 1:
                    var object = front.getActiveObject();
                    break
                case 2:
                    var object = right.getActiveObject();
                    break;
                case 3:
                    var object = back.getActiveObject();
                    break;
                default:
                    var object = left.getActiveObject();
            }

            if (type =="c")
             {
                //setting the stroke color
                strokeColor = newColor;
                object.setStroke(strokeColor);
             }
             else
             {
                
                //setting the stroke color to the fill color
                strokeColor = newColor;
                object.setStroke(strokeColor);
                //changing the fill color of the text to the new color
                colorText = newColor;            
                object.setFill(colorText);
             }
            
            switch (canvasCounter){
                case 1:
                    front.renderAll(front);
                    break
                case 2:
                    right.renderAll(right);
                    break;
                case 3:
                    back.renderAll(back);
                    break;
                default:
                   left.renderAll(left);
            }
            
            
        }
        //START TEXT DESIGN SECTION*************************************************************************************************************************************************
        //canvas, text, color, and strokeColor are part of text design and can be found at the top with the other variables
 
        function removeItem(){
            //DECIDING WHICH CANVAS TO REMOVE OBJECT FROM
            switch (canvasCounter){
                case 1:
                    if(front.getActiveGroup()){
                      front.getActiveGroup().forEachObject(function(o){ front.remove(o) });
                      front.discardActiveGroup().renderAll();
                    } else {
                      front.remove(front.getActiveObject());
                    }
                    break
                case 2:
                    if(right.getActiveGroup()){
                      right.getActiveGroup().forEachObject(function(o){ right.remove(o) });
                      right.discardActiveGroup().renderAll();
                    } else {
                      right.remove(right.getActiveObject());
                    }
                    break;
                case 3:
                    if(back.getActiveGroup()){
                      back.getActiveGroup().forEachObject(function(o){ back.remove(o) });
                      back.discardActiveGroup().renderAll();
                    } else {
                      back.remove(back.getActiveObject());
                    }
                    break;
                default:
                    if(left.getActiveGroup()){
                      left.getActiveGroup().forEachObject(function(o){ left.remove(o) });
                      left.discardActiveGroup().renderAll();
                    } else {
                      left.remove(left.getActiveObject());
                    }
            }
           
        }
        function setFont(element){           

             //this is to record what was done for the purpose of saving designs
            colorChanged = true;
            //TEST TEXT DESIGN COLOR CHANGE

            //this is to style the list so that you can see what you clicked on
            $(".list-group-item").removeClass("active");
            $(this).addClass("active");
            //DECIDING WHICH CANVAS TO GET OBJECT FROM
            switch (canvasCounter){
                case 1:
                    var object = front.getActiveObject();
                    break
                case 2:
                    var object = right.getActiveObject();
                    break;
                case 3:
                    var object = back.getActiveObject();
                    break;
                default:
                    var object = left.getActiveObject();
            }

                font = element.id; 
                object.set({fontFamily : font});
                
            switch (canvasCounter){
                case 1:
                    front.renderAll(front);
                    break
                case 2:
                    right.renderAll(right);
                    break;
                case 3:
                    back.renderAll(back);
                    break;
                default:
                   left.renderAll(left);
            }

             $('#fontModal').modal('hide');
        }

        function wrapText(text, maxChars) {
        var ret = [];
        var words = text.split(/\b/);

        var currentLine = '';
        var lastWhite = '';
        words.forEach(function(d) {
            var prev = currentLine;
            currentLine += lastWhite + d;

            var l = currentLine.length;

            if (l > maxChars) {
                ret.push(prev.trim());
                currentLine = d;
                lastWhite = '';
            } else {
                var m = currentLine.match(/(.*)(\s+)$/);
                lastWhite = (m && m.length === 3 && m[2]) || '';
                currentLine = (m && m.length === 3 && m[1]) || currentLine;
            }
        });

        if (currentLine) {
            ret.push(currentLine.trim());
        }

        return ret.join("\n");
    }
// ens space for functions 
        function addText(e) {
            textAdded = true;
            if (e.keyCode == 13 || e.type == "click") 
            {

              //the following is only for styling purposes                   
                    $(".list-group-item").removeClass("active");
                    $(this).addClass("active");
                    //setting 'object' to the active object or the object the user has selected
                    switch (canvasCounter){
                        case 1:
                             object = front.getActiveObject();
                            break
                        case 2:
                             object = right.getActiveObject();
                            break;
                        case 3:
                             object = back.getActiveObject();
                            break;
                        default:
                             object = left.getActiveObject();
                    }
                    //taking the id of the input to discover what type of object is being resized
                    var element = e.target.id;
                    text = document.getElementById('text').value;
                    document.getElementById('text').value = "";
                    var tempText = text;
                    text = wrapText(tempText, 18); 
                    if (!object)
                    {  
                        //clearing the text area for new text to be entered
                        colorText = "#000000";
                        colorArt = "#000000";
                        strokeColor = "#000000";
                        font = 'Ariel';       
                        straight();                
                        return false;
                    }
                    else
                    {
                       //console.log(object);
                       //console.log(object.type);
                       switch (object.type){
                        case 'text':                           
                            object.setText(text);                         
                            break                        
                        case 'group':
                               leftpos = object.left;
                               frontTop = object.top;
                               removeItem();                                
                               if (object.id.includes("circle")) 
                               {
                                  circle();
                               }
                               else if((object.id.includes("valley")))
                               {
                                  valley();
                               }
                               else
                               {
                                  bridge();
                               }                        
                            break;
                        default:
                             console.log(element);
                      }
                
                        switch (canvasCounter){
                            case 1:
                                front.renderAll(front);
                                break
                            case 2:
                                right.renderAll(right);
                                break;
                            case 3:
                                back.renderAll(back);
                                break;
                            default:
                               left.renderAll(left);
                        }
                      return false;              
                 

                    }

                   document.getElementById('text').value= "";
            } 

        }       
       
        //adding text
        function straight(){
            textAdded = true;
           text = document.getElementById('text').value;
          document.getElementById('text').value = "";
          colorText = "#000000";
          colorArt = "#000000";
          strokeColor = "#000000";
          font = 'Ariel'; 
            var txt = new fabric.Text(text,{
                fontFamily: font,
                stroke: strokeColor,
                left:50,
                top:50});
            txt.setColor(colorText); //this will set the color not just the stroke
            
            txt.set({
                        id: objId,
                        hasRotatingPoint: false                       
                    });
            objId++;
            txt.customiseCornerIcons({
                settings: {
                    borderColor: 'rgba(100,100,100,100)', //black
                    cornerSize: 20,
                    cornerShape: 'circle',
                    cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                    cornerPadding: 5,
                                hasRotatingPoint: false
                    hasRotatingPoint: false
                },
                tl: {
                    icon: 'img/x.png', //icons/rotate.svg
                },
                tr: {
                    icon: 'img/rotate_2.png', //img/resize.svg
                },
                bl: {
                icon: 'img/resize_left.png',
                },
                br: {
                   icon: 'img/resize_right.png',
                },

            }, function() {
                front.renderAll();
                right.renderAll();
                back.renderAll();
                left.renderAll();
            });
            
            //DECIDING WHICH CANVAS TO ADD TOO
            switch (canvasCounter){
                case 1:
                    front.add(txt).setActiveObject(txt);
                    break
                case 2:
                    right.add(txt).setActiveObject(txt);
                    break;
                case 3:
                    back.add(txt).setActiveObject(txt);
                    break;
                default:
                    left.add(txt).setActiveObject(txt);
            }
        }
 
        //START CURVE CODE*******************************************************************************************************************************************************************
            function valley(){
                textAdded = true;
                
                //used to hold the text
                var headingText = []; 
                var startAngle = -60;
                var textLength = text.length;
 
                var r = text.length * 20;//sets distance between letters getTranslationDistance(text);
                var j = -1; // this will adjust the angle of the letters not the curve
                var angleInterval = 120/textLength; // arc length (full circle is 360/textlength)
                for(var iterator=(-textLength/2), i=textLength-1; iterator<textLength/2;iterator++,i--) { 
 
                    var rotation = 90-(startAngle+(i)*angleInterval) ;
                   
                    var letter = new fabric.IText(text[i], {
                        fontFamily: font,
                        stroke: strokeColor,
                        angle : j*((startAngle)+(i*angleInterval)),
                        fontSize:28,
                        left: (r)*Math.cos((Math.PI/180)*rotation), 
                        top: (r)*Math.sin((Math.PI/180)*rotation)   
                    });
                    letter.setColor(colorText);
                    headingText.push(letter);
                }
                //DECIDING WHICH CANVAS TO ADD TOO
                switch (canvasCounter){
                    case 1:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: frontTop , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor, angle: -3});
                        group2.set({  id:'valley' +  objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'rgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                                hasRotatingPoint: false

                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png', //img/resize.svg
                            },
                            bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        front.add(group2).setActiveObject(group2);
                        break
                    case 2:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: rightTop , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'valley' +   objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'rgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png', //img/resize.svg
                            },
                            bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        right.add(group2).setActiveObject(group2);
                        break;
                    case 3:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: backTop, fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'valley' +   objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'rgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                               icon: 'img/rotate_2.png', //img/resize.svg
                            },
                            bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        back.add(group2).setActiveObject(group2);
                        break;
                    default:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: leftTop , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'valley' +   objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'rgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png', //img/resize.svg
                            },
                             bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        left.add(group2).setActiveObject(group2);
                }
                
            }
        //END CURVE CODE*******************************************************************************************************************************************************************
        //START REVERSE CURVE CODE*******************************************************************************************************************************************************************
            function bridge(){
                textAdded = true;
               
                //used to hold the text
                var headingText = []; 
                var startAngle = -58;
                var textLength = text.length;
 
                var r = text.length * 20;//sets distance between letters getTranslationDistance(text);
                var j = -1; // this will adjust the angle of the letters not the curve
                var angleInterval = 116/textLength; // arc length (full circle is 360/textlength)
                var ltr = 0; //CHANGE get rid of this
                for(var x=(-textLength/2), i=textLength-1; x<textLength/2;x++,i--) { //CHANGE 1. x to iterator 2. i = textLength -1 3. i--
 
                    var rotation = 90-(startAngle+(i)*angleInterval) ;
                   
                    var letter = new fabric.IText(text[ltr], {
                        fontFamily: font,
                        stroke: strokeColor,
                        angle : j*((startAngle)+(i*angleInterval)),
                        fontSize:28,
                        left: -1*(r)*Math.cos((Math.PI/180)*rotation), //CHANGE TAKE OUT -1
                        top: -1*(r)*Math.sin((Math.PI/180)*rotation)   //CHANGE TAKE OUT -1
                    });
                    letter.setColor(colorText);
                    headingText.push(letter);
                    ltr++;
                }
 
                //DECIDING WHICH CANVAS TO ADD TOO
                switch (canvasCounter){
                    case 1:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: frontTop , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'bridge' +   objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'rgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png', //img/resize.svg
                            },
                             bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        front.add(group2).setActiveObject(group2);
                        break
                    case 2:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: rightTop , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'bridge' +  objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                 borderColor: 'rrgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rrgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png', //img/resize.svg
                            },
                             bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        right.add(group2).setActiveObject(group2);
                        break;
                    case 3:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: backTop , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'bridge' +   objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                 borderColor: 'rrgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rrgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png',
                            },
                             bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        back.add(group2).setActiveObject(group2);
                        break;
                    default:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: leftTop , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'bridge' +   objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                 borderColor: 'rrgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rrgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png',
                            },
                             bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        left.add(group2).setActiveObject(group2);
                }
            }
        //END  REVERSE CURVE CODE*******************************************************************************************************************************************************************
        //START CIRCLE CODE*******************************************************************************************************************************************************************
            function circle(){
                textAdded = true;
                //to keep first word and last word from touching
                text = text + " ";
             
                //used to hold the text
                var headingText = []; 
                var startAngle = -58;
                var textLength = text.length;
 
                var r = text.length * 2;//sets distance between letters getTranslationDistance(text);
                var j = -1; // this will adjust the angle of the letters not the curve
                var angleInterval = 360/textLength; // arc length (full circle is 360/textlength)
                for(var iterator=(-textLength/2), i=textLength-1; iterator<textLength/2;iterator++,i--) {
                  
                    var rotation = 90-(startAngle+(i)*angleInterval) ;
                   
                    var letter = new fabric.IText(text[i], {
                        fontFamily: font,
                        stroke: strokeColor,
                        angle : j*((startAngle)+(i*angleInterval)),
                        fontSize:28,
                        left: (r)*Math.cos((Math.PI/180)*rotation),
                        top: (r)*Math.sin((Math.PI/180)*rotation)
                    });
                    letter.setColor(colorText);
                    headingText.push(letter);          
                }
                //DECIDING WHICH CANVAS TO ADD TOO
                switch (canvasCounter){
                    case 1:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: frontTop , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'circle' +   objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                 borderColor: 'rrgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rrgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png', //img/resize.svg
                            },
                             bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        front.add(group2).setActiveObject(group2);
                        break
                    case 2:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: rightTop, fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'circle' +   objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                 borderColor: 'rrgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rrgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png', //img/resize.svg
                            },
                             bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        right.add(group2).setActiveObject(group2);
                        break;
                    case 3:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: backTop , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'circle' +    objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                 borderColor: 'rrgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rrgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png', //img/resize.svg
                            },
                             bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        back.add(group2).setActiveObject(group2);
                        break;
                    default:
                        var group2 = new fabric.Group(headingText, { left: leftpos, top: leftTop, fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id:'circle' +    objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                 borderColor: 'rrgba(100,100,100,100)', //black
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'rrgba(100,100,100,100)', //black
                                cornerPadding: 5,
                                hasRotatingPoint: false
                            },
                            tl: {
                                icon: 'img/x.png', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate_2.png', //img/resize.svg
                            },
                             bl: {
                                icon: 'img/resize_left.png',
                            },
                            br: {
                                icon: 'img/resize_right.png',
                            },
                
                        }, function() {
                            front.renderAll();
                            right.renderAll();
                            back.renderAll();
                            left.renderAll();
                        });
                        left.add(group2).setActiveObject(group2);
                }
                //var group2 = new fabric.Group(headingText, { left: 0, top: canvas.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
            }
        //END CIRCLE CODE***************************************************************************************************************************************************************
    </script> 
 
    <!--START CHOOSE PRODUCT SECTION-->
       <script type="text/javascript">
            function setProduct(element){
                var content = element.innerHTML;
                //SETTING CURRENT PRODUCT IMAGE
                var imgSrc = content.substring(content.indexOf("src=\"")+5,content.indexOf('" '));
                document.getElementById('description_image').src = imgSrc;
                document.getElementById('frontCanvasShirt').style.backgroundImage = "url("+imgSrc+")";
                document.getElementById('rightCanvasShirt').style.backgroundImage = "url("+imgSrc+")";
                document.getElementById('backCanvasShirt').style.backgroundImage = "url("+imgSrc+")";
                document.getElementById('leftCanvasShirt').style.backgroundImage = "url("+imgSrc+")";
                document.getElementById('frontSharePreviewCase').style.backgroundImage = "url("+imgSrc+")";
                document.getElementById('rightSharePreviewCase').style.backgroundImage = "url("+imgSrc+")";
                document.getElementById('backSharePreviewCase').style.backgroundImage = "url("+imgSrc+")";
                document.getElementById('leftSharePreviewCase').style.backgroundImage = "url("+imgSrc+")";
                document.getElementById('productPreview').style.backgroundImage = "url("+imgSrc+")";
 
                //document.getElementById('canvasShirt').style.backgroundImage = "url("+imgSrc+")";
                console.log('Image Source: ' + imgSrc + " typeof: " + typeof imgSrc);
                //TODO CHANGE CODE BELOW, THIS IS FAKE DATA USED FOR DEMO.
                costOfProduct = 2;
            }
        </script> 
    <!--END CHOOSE PRODUCT SECTION-->
 
    <!--START SAVE DESIGN SECTION-->    
    <script>
            function saveUpload(){
                additionalpictures += "*" + document.getElementById('previewCanvas').toDataURL("image/png");
            }
 
             function uploadEx() 
             {                  
                 savePDFs();
                if (textAdded || clipArtAdded || imageUploaded  || colorChanged || addingToCart || rezided) 
                {                   
                    $('#mProgressBarModal').modal('show');         
                    //progress(10);
                    //this is to reset the variables that record changes 
                    textAdded = clipArtAdded = imageUploaded = colorChanged = false;
                    var data = [];
                    var frontdatalist = "";                         
                    frontdatalist += front.toDataURL('image/png');            
                    data.push(front);
                   // progress(20);
                    var rightdatalist = "";             
                    rightdatalist += right.toDataURL('image/png');
                    data.push(right);
                   // progress(30);
                    var backdatalist = "";            
                    backdatalist += back.toDataURL('image/png');
                    data.push(back);
                    //progress(40);
                    var leftdatalist = "";            
                    leftdatalist += left.toDataURL('image/png');  
                    data.push(left);
                   // progress(50);
                    var $general = frontdatalist;
                        $general += "*" + rightdatalist;
                        $general += "*" + backdatalist;
                        $general += "*" + leftdatalist;
                        if (additionalpictures.length > 1)
                         {
                            $general += additionalpictures;
                         }
                        
                   var jsonData = JSON.stringify(data); 
                   //progress(60);                        
                    $general += "*"+ jsonData;  
                
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "save_design.php", true);
                    xhr.responseType = "text";
                    xhr.onprogress = function(e) {
                        if (e.lengthComputable) {
                            progressBar.max = e.total;
                            progress(e.loaded);
 
                                     
                        }
                    };
                    xhr.onloadstart = function(e) {
                        progress(0);
                    };
                    xhr.onloadend = function(e) {
                        progress(e.loaded);
                        $('#mProgressBarModal').modal('hide');
                        var x = document.getElementById("mydesings");
                        var option = document.createElement("option");
                        option.text = xhr.responseText;
                        fileAddress = xhr.responseText;
                        
                        //alert(fileAddress);
                        x.add(option);
                        getImage(fileAddress);
                        //testing to see if item is being added to card
                        if(addingToCart){
                            addingToCart = false;
                            getImage(fileAddress);
                            addToCart();
                            //testing to see if customer wants checkout from 'add product' modal
                            if(automatedCheckout){
                                calcPrice();
                                getCartTotal();
                                document.getElementById('checkout_form').submit();
                            }
                        }
                        //letting customer know that their design was sucessfully saved
                        savedSuccessfullyMessage();       
                    };
                    xhr.send($general);
                    //$('#mProgressBarModal').modal('hide');
 
                }
            }
            function savePDFs(){
              //front
              var img = new Image();
              img.src = front.toDataURL();
              var doc_front = new jsPDF();
              doc_front.addImage(img ,"PNG",20,40,100,100);
              doc_front.setFontSize(22);
              doc_front.text(20, 20, 'front');
              doc_front.save('front.pdf');
              //right
              img = new Image();
              img.src = right.toDataURL();
              var doc_right = new jsPDF();
              doc_right.addImage(img ,"PNG",20,40,100,100);
              doc_right.setFontSize(22);
              doc_right.save('right.pdf');
              //back
              img = new Image();
              img.src = back.toDataURL();
              var doc_back = new jsPDF();
              doc_back.addImage(img ,"PNG",20,40,100,100);
              doc_back.save('back.pdf');
              //left
              img = new Image();
              img.src = left.toDataURL();
              var doc_left = new jsPDF();
              doc_left.addImage(img ,"PNG",20,40,100,100);
              doc_left.save('left.pdf');
            }
            function resize(e)
            {
                rezided = true;
                //stops user from entering anything except integers and 'enter'
                if(e.which != 13 && (e.which < 48 || e.which > 57) ){ return false;}
                
                var object;
                //13 is the ascii code for enter, so that this function would be triggered when the user presses enter.
                if (e.keyCode == 13)
                { 
                    //the following is only for styling purposes                   
                    $(".list-group-item").removeClass("active");
                    $(this).addClass("active");
                    //setting 'object' to the active object or the object the user has selected
                    switch (canvasCounter){
                        case 1:
                             object = front.getActiveObject();
                            break
                        case 2:
                             object = right.getActiveObject();
                            break;
                        case 3:
                             object = back.getActiveObject();
                            break;
                        default:
                             object = left.getActiveObject();
                    }
                    //taking the id of the input to discover what type of object is being resized
                    var element = e.target.id;
                    switch (element){
                        case 'sizeText':
                            //multiplying the number entered (inches) to resize the object in pixels
                            var sizeText = Number(document.getElementById('sizeText').value);
                            if (object.type == 'text')
                            {
                                object.setFontSize(sizeText);    
                            }
                            else
                            {
                                object.set("fontSize",sizeText);
                            }
                            break                        
                        case 'widthImage':
                            var widthImage = Number(document.getElementById('widthImage').value * 70);
                            object.setWidth(widthImage);                             
                            break;
                         case 'heightImage':
                             var heightImage = Number(document.getElementById('heightImage').value * 70);
                             object.setHeight(heightImage);
                            break;
                        default:
                             console.log(element);
                    } 
                    //rerendering the canvas to show the updated stats
                    switch (canvasCounter){
                        case 1:
                            front.renderAll(front);
                            break
                        case 2:
                            right.renderAll(right);
                            break;
                        case 3:
                            back.renderAll(back);
                            break;
                        default:
                           left.renderAll(left);
                    }

                  return false;
                }
               
            }
 
            function progress(status)
            {
                $('.progress .progress-bar').each(function() 
                  {

                        var me = $(this);
                        var current_perc = (status*100 )/ 18;                        
                        me.css('width', (current_perc)+'%');
                        me.text((current_perc) + '%');  
                  });
            }
 
            function rotate(e)
            {
                //stops user from entering anything except integers and 'enter'
                if(e.which != 13 && (e.which < 48 || e.which > 57) ){ return false;}

                var object;
                if (e.keyCode == 13)
                {                    
                    $(".list-group-item").removeClass("active");
                    $(this).addClass("active");
                    //DECIDING WHICH CANVAS TO GET OBJECT FROM
                    switch (canvasCounter){
                        case 1:
                             object = front.getActiveObject();
                            break
                        case 2:
                             object = right.getActiveObject();
                            break;
                        case 3:
                             object = back.getActiveObject();
                            break;
                        default:
                             object = left.getActiveObject();
                    }

                     var element = e.target.id;

                    switch (element){                       
                        case 'angleImage':
                            var angleImage = Number(document.getElementById('angleImage').value);
                             object.setAngle(angleImage);                                                               
                            break;
                         case 'angleText':
                             var angleText = Number(document.getElementById('angleText').value);
                              object.setAngle(angleText); 
                            break;
                        default:
                             console.log(element);
                    } 

                    switch (canvasCounter){
                        case 1:
                            front.renderAll(front);
                            break
                        case 2:
                            right.renderAll(right);
                            break;
                        case 3:
                            back.renderAll(back);
                            break;
                        default:
                           left.renderAll(left);
                    }

                  return false;
                }
               
            }
            //creating a function to change the size of the clip art menu when 'editArt' div is active.
            function changeClipArtMenuSize(){
                  console.log('changeClipArtMenuSize started');
                  var clipArtMenu = document.getElementById('clipArtMenu');
                  
                  document.getElementById('ClipsArtImages').style.height = '355px';
                  console.log('changeClipArtMenuSize finished. height : ' + document.getElementById('ClipsArtImages').style.height);
            }
 
             front.on('mouse:up', function(e) 
            { 
                var modifiedObject = e.target;
                var editArt = document.getElementById("editArt");                        
                var newArt = document.getElementById("newArt");
                if (typeof(e.target) == "undefined")
                 { 
                    newArt.style.display = 'block';
                    editArt.style.display = 'none';  
                    document.getElementById('text').value = ""; 
                    document.getElementById('sizeText').value = "";    
                    document.getElementById('angleText').value = "";                     
                 }

                else if (e.target.type == 'image') 
                {
                  $('.nav-tabs a[href="#addArt"]').tab('show');  
                  document.getElementById("widthImage").value = Math.round(modifiedObject.getWidth()/35);
                  document.getElementById("heightImage").value = Math.round(modifiedObject.getHeight()/35);
                  document.getElementById("angleImage").value = Math.round(modifiedObject.getAngle());
                  editArt.style.display = 'block';       
                  changeClipArtMenuSize();            
                  newArt.style.display = 'none';                               
                }  
                else if(e.target.type == 'text' || e.target.type == 'group' ) 
                {
                    $('.nav-tabs a[href="#textSection"]').tab('show');     
                     
                     document.getElementById("angleText").value = Math.round(modifiedObject.getAngle());
                     if (e.target.type == 'text') 
                     {
                       document.getElementById("sizeText").value = Math.round(modifiedObject.getFontSize()); 
                       document.getElementById('text').value = modifiedObject.text;
                     }
                     else
                     {                           
                        var objectList = modifiedObject.getObjects();
                        var value = "";  

                        if (modifiedObject.id.includes("bridge")) 
                        { 
                           for (var i=0; i < objectList.length; i++) 
                           {
                             value += objectList[i].text; 
                           }
                        }
                        else
                        {
                            console.log(objectList); 
                          for (var i = objectList.length-1 ; i > 0; i--) 
                          {
                             value += objectList[i].text; 
                          }
                        }
                        document.getElementById('text').value = value;
                     }
                     //enabling text btns
                     var textBtns = document.getElementsByClassName("textBtn");
                     for (var i = 0; i < textBtns.length; i++) {
                         textBtns[i].disabled = false;
                     }
                }
                //disabling textbtns again if text is not selected
                if(e.target.type == 'undefined' || e.target.type != 'text' && e.target.type != 'group' )
                {
                    var textBtns = document.getElementsByClassName("textBtn");
                     for (var i = 0; i < textBtns.length; i++) {
                         textBtns[i].disabled = true;
                     }
                }   
            });

            right.on('mouse:up', function(e) 
            {
                var modifiedObject = e.target;
                var editArt = document.getElementById("editArt");                        
                var newArt = document.getElementById("newArt");
                if (typeof(e.target) == "undefined")
                 { 
                    newArt.style.display = 'block';
                    editArt.style.display = 'none';  
                    document.getElementById('text').value = "";                  
                 }

                else if (e.target.type == 'image') 
                {
                  $('.nav-tabs a[href="#addArt"]').tab('show');  
                  document.getElementById("widthImage").value = Math.round(modifiedObject.getWidth()/35);
                  document.getElementById("heightImage").value = Math.round(modifiedObject.getHeight()/35);
                  document.getElementById("angleImage").value = Math.round(modifiedObject.getAngle());
                  editArt.style.display = 'block';                  
                  newArt.style.display = 'none';                               
                }  
                else if(e.target.type == 'text' || e.target.type == 'group' ) 
                {
                    $('.nav-tabs a[href="#textSection"]').tab('show');     
                     
                     document.getElementById("angleText").value = Math.round(modifiedObject.getAngle());
                     if (e.target.type == 'text') 
                     {
                       document.getElementById("sizeText").value = Math.round(modifiedObject.getFontSize()); 
                       document.getElementById('text').value = modifiedObject.text;
                     }
                     else
                     {                           
                        var objectList = modifiedObject.getObjects();
                        var value = "";  

                        if (modifiedObject.id.includes("bridge")) 
                        { 
                           for (var i=0; i < objectList.length; i++) 
                           {
                             value += objectList[i].text; 
                           }
                        }
                        else
                        {
                            console.log(objectList); 
                          for (var i = objectList.length-1 ; i > 0; i--) 
                          {
                             value += objectList[i].text; 
                          }
                        }
                        document.getElementById('text').value = value;
                     }
                     //enabling text btns
                     var textBtns = document.getElementsByClassName("textBtn");
                     for (var i = 0; i < textBtns.length; i++) {
                         textBtns[i].disabled = false;
                     }
                }
                //disabling textbtns again if text is not selected
                if(e.target.type != 'text' && e.target.type != 'group' )
                {
                    var textBtns = document.getElementsByClassName("textBtn");
                     for (var i = 0; i < textBtns.length; i++) {
                         textBtns[i].disabled = true;
                     }
                }   
            });

            back.on('mouse:up', function(e) 
            {
                var modifiedObject = e.target;
                var editArt = document.getElementById("editArt");                        
                var newArt = document.getElementById("newArt");
                if (typeof(e.target) == "undefined")
                 { 
                    newArt.style.display = 'block';
                    editArt.style.display = 'none';  
                    document.getElementById('text').value = "";                  
                 }

                else if (e.target.type == 'image') 
                {
                  $('.nav-tabs a[href="#addArt"]').tab('show');  
                  document.getElementById("widthImage").value = Math.round(modifiedObject.getWidth()/35);
                  document.getElementById("heightImage").value = Math.round(modifiedObject.getHeight()/35);
                  document.getElementById("angleImage").value = Math.round(modifiedObject.getAngle());
                  editArt.style.display = 'block';                  
                  newArt.style.display = 'none';                               
                }  
                else if(e.target.type == 'text' || e.target.type == 'group' ) 
                {
                    $('.nav-tabs a[href="#textSection"]').tab('show');     
                     
                     document.getElementById("angleText").value = Math.round(modifiedObject.getAngle());
                     if (e.target.type == 'text') 
                     {
                       document.getElementById("sizeText").value = Math.round(modifiedObject.getFontSize()); 
                       document.getElementById('text').value = modifiedObject.text;
                     }
                     else
                     {                           
                        var objectList = modifiedObject.getObjects();
                        var value = "";  

                        if (modifiedObject.id.includes("bridge")) 
                        { 
                           for (var i=0; i < objectList.length; i++) 
                           {
                             value += objectList[i].text; 
                           }
                        }
                        else
                        {
                            console.log(objectList); 
                          for (var i = objectList.length-1 ; i > 0; i--) 
                          {
                             value += objectList[i].text; 
                          }
                        }
                        document.getElementById('text').value = value;
                     }
                     //enabling text btns
                     var textBtns = document.getElementsByClassName("textBtn");
                     for (var i = 0; i < textBtns.length; i++) {
                         textBtns[i].disabled = false;
                     }
                }
                //disabling textbtns again if text is not selected
                if(e.target.type != 'text' && e.target.type != 'group' )
                {
                    var textBtns = document.getElementsByClassName("textBtn");
                     for (var i = 0; i < textBtns.length; i++) {
                         textBtns[i].disabled = true;
                     }
                }   
            });

            left.on('mouse:up', function(e) 
            {
               var modifiedObject = e.target;
                var editArt = document.getElementById("editArt");                        
                var newArt = document.getElementById("newArt");
                if (typeof(e.target) == "undefined")
                 { 
                    newArt.style.display = 'block';
                    editArt.style.display = 'none';  
                    document.getElementById('text').value = "";                  
                 }

                else if (e.target.type == 'image') 
                {
                  $('.nav-tabs a[href="#addArt"]').tab('show');  
                  document.getElementById("widthImage").value = Math.round(modifiedObject.getWidth()/35);
                  document.getElementById("heightImage").value = Math.round(modifiedObject.getHeight()/35);
                  document.getElementById("angleImage").value = Math.round(modifiedObject.getAngle());
                  editArt.style.display = 'block';                  
                  newArt.style.display = 'none';                               
                }  
                else if(e.target.type == 'text' || e.target.type == 'group' ) 
                {
                    $('.nav-tabs a[href="#textSection"]').tab('show');     
                     
                     document.getElementById("angleText").value = Math.round(modifiedObject.getAngle());
                     if (e.target.type == 'text') 
                     {
                       document.getElementById("sizeText").value = Math.round(modifiedObject.getFontSize()); 
                       document.getElementById('text').value = modifiedObject.text;
                     }
                     else
                     {                           
                        var objectList = modifiedObject.getObjects();
                        var value = "";  

                        if (modifiedObject.id.includes("bridge")) 
                        { 
                           for (var i=0; i < objectList.length; i++) 
                           {
                             value += objectList[i].text; 
                           }
                        }
                        else
                        {
                            console.log(objectList); 
                          for (var i = objectList.length-1 ; i > 0; i--) 
                          {
                             value += objectList[i].text; 
                          }
                        }
                        document.getElementById('text').value = value;
                     }
                     //enabling text btns
                     var textBtns = document.getElementsByClassName("textBtn");
                     for (var i = 0; i < textBtns.length; i++) {
                         textBtns[i].disabled = false;
                     }
                }
                //disabling textbtns again if text is not selected
                if(e.target.type != 'text' && e.target.type != 'group' )
                {
                    var textBtns = document.getElementsByClassName("textBtn");
                     for (var i = 0; i < textBtns.length; i++) {
                         textBtns[i].disabled = true;
                     }
                }   
            });
            //function used to keep objects in the canvas
            front.on("object:modified", function(e){    
                //gethering necessary information
                var obj = front.getActiveObject();
                var maxX = front.width;
                var maxY = front.height;
                var width = obj.getWidth();
                var height = obj.getHeight();
                var x = obj.left;
                var y = obj.top;
                 // if object is too big then resize
                if( obj.getWidth() > front.width){
                    if(e.target.type == 'text' || e.target.type == 'group' ) 
                    {
                        e.target.setFontSize(e.target.getFontSize()/2);
                    }
                    //obj.setWidth(maxX *2);
                    //console.log("too wide! width : " + obj.getWidth());
                    //e.target.set({ width: maxX, scaleX: 1 });
                } 
                if(obj.getHeight() > front.height){
                    if(e.target.type == 'text' || e.target.type == 'group' ) 
                    {
                        e.target.setFontSize(e.target.getFontSize()/2);
                    }
                   //obj.setHeight(maxY); 
                   console.log("3509 height : " + e.target.getHeight() + " width : " + e.target.getWidth());
                   e.target.set({ height: e.target.getHeight()/4, width: e.target.getWidth()/4});
                   console.log("3511 height : " + e.target.getHeight() + " width : " + e.target.getWidth());
                } 
                //the following is to help keep images within size range when their angle != 0
                if(e.target.getAngle() != 0 || e.target.getAngle() != 180){
                    if( obj.getWidth() > front.height){
                        if(e.target.type == 'text' || e.target.type == 'group' ) 
                        {
                            e.target.setFontSize(e.target.getFontSize()/2);
                        }
                        //obj.setWidth(maxX *2);
                        console.log("too wide! width : " + obj.getWidth());
                   e.target.set({ height: e.target.getHeight()/4, width: e.target.getWidth()/4});
                    } 
                    if(obj.getHeight() > front.width){
                        if(e.target.type == 'text' || e.target.type == 'group' ) 
                        {
                            e.target.setFontSize(e.target.getFontSize()/2);
                        }
                       //obj.setHeight(maxY); 
                       console.log("too tall! height : " + obj.getHeight());
                   e.target.set({ height: e.target.getHeight()/4, width: e.target.getWidth()/4});
                    } 
                }      
                obj.setCoords();
                // making sure top-left  corner stays in canvas
                if(obj.getBoundingRect().top < 0 || obj.getBoundingRect().left < 0){
                    obj.top = Math.max(obj.top, obj.top-obj.getBoundingRect().top);
                    obj.left = Math.max(obj.left, obj.left-obj.getBoundingRect().left);
                }
                //making sure bot-right corner stays in canvas
                if(obj.getBoundingRect().top+height  > front.height || obj.getBoundingRect().left+width  > front.width){
                    obj.top = Math.min(obj.top, front.height-obj.getBoundingRect().height+obj.top-obj.getBoundingRect().top);
                    obj.left = Math.min(obj.left, front.width-obj.getBoundingRect().width+obj.left-obj.getBoundingRect().left);
                }
                obj.setCoords();
                front.renderAll();
            });
            right.on("object:modified", function(e){    
                //gethering necessary information
                var obj = right.getActiveObject();
                var maxX = right.width;
                var maxY = right.height;
                var width = obj.getWidth();
                var height = obj.getHeight();
                var x = obj.left;
                var y = obj.top;
                 // if object is too big then resize
                if( obj.getWidth() > right.width){
                    if(e.target.type == 'text' || e.target.type == 'group' ) 
                    {
                        e.target.setFontSize(e.target.getFontSize()/2);
                    }
                    //obj.setWidth(maxX *2);
                    console.log("too wide! width : " + obj.getWidth());
                    e.target.set({ width: maxX, scaleX: 1 });
                } 
                if(obj.getHeight() > right.height){
                    if(e.target.type == 'text' || e.target.type == 'group' ) 
                    {
                        e.target.setFontSize(e.target.getFontSize()/2);
                    }
                   //obj.setHeight(maxY); 
                   console.log("too tall! height : " + obj.getHeight());
                   e.target.set({ height: maxY, scaleY: 1 });
                } 
                //the following is to help keep images within size range when their angle != 0
                if(e.target.getAngle() != 0 || e.target.getAngle() != 180){
                    if( obj.getWidth() > right.height){
                        if(e.target.type == 'text' || e.target.type == 'group' ) 
                        {
                            e.target.setFontSize(e.target.getFontSize()/2);
                        }
                        //obj.setWidth(maxX *2);
                        console.log("too wide! width : " + obj.getWidth());
                        e.target.set({ width: maxY, scaleX: 1 });
                    } 
                    if(obj.getHeight() > right.width){
                        if(e.target.type == 'text' || e.target.type == 'group' ) 
                        {
                            e.target.setFontSize(e.target.getFontSize()/2);
                        }
                       //obj.setHeight(maxY); 
                       console.log("too tall! height : " + obj.getHeight());
                       e.target.set({ height: maxX, scaleY: 1 });
                    } 
                }      
                obj.setCoords();
                // making sure top-left  corner stays in canvas
                if(obj.getBoundingRect().top < 0 || obj.getBoundingRect().left < 0){
                    obj.top = Math.max(obj.top, obj.top-obj.getBoundingRect().top);
                    obj.left = Math.max(obj.left, obj.left-obj.getBoundingRect().left);
                }
                //making sure bot-right corner stays in canvas
                if(obj.getBoundingRect().top+height  > right.height || obj.getBoundingRect().left+width  > right.width){
                    obj.top = Math.min(obj.top, right.height-obj.getBoundingRect().height+obj.top-obj.getBoundingRect().top);
                    obj.left = Math.min(obj.left, right.width-obj.getBoundingRect().width+obj.left-obj.getBoundingRect().left);
                }
                obj.setCoords();
                right.renderAll();
            });
            back.on("object:modified", function(e){    
                //gethering necessary information
                var obj = back.getActiveObject();
                var maxX = back.width;
                var maxY = back.height;
                var width = obj.getWidth();
                var height = obj.getHeight();
                var x = obj.left;
                var y = obj.top;
                 // if object is too big then resize
                if( obj.getWidth() > back.width){
                    if(e.target.type == 'text' || e.target.type == 'group' ) 
                    {
                        e.target.setFontSize(e.target.getFontSize()/2);
                    }
                    //obj.setWidth(maxX *2);
                    console.log("too wide! width : " + obj.getWidth());
                    e.target.set({ width: maxX, scaleX: 1 });
                } 
                if(obj.getHeight() > back.height){
                    if(e.target.type == 'text' || e.target.type == 'group' ) 
                    {
                        e.target.setFontSize(e.target.getFontSize()/2);
                    }
                   //obj.setHeight(maxY); 
                   console.log("too tall! height : " + obj.getHeight());
                   e.target.set({ height: maxY, scaleY: 1 });
                } 
                //the following is to help keep images within size range when their angle != 0
                if(e.target.getAngle() != 0 || e.target.getAngle() != 180){
                    if( obj.getWidth() > back.height){
                        if(e.target.type == 'text' || e.target.type == 'group' ) 
                        {
                            e.target.setFontSize(e.target.getFontSize()/2);
                        }
                        //obj.setWidth(maxX *2);
                        console.log("too wide! width : " + obj.getWidth());
                        e.target.set({ width: maxY, scaleX: 1 });
                    } 
                    if(obj.getHeight() > back.width){
                        if(e.target.type == 'text' || e.target.type == 'group' ) 
                        {
                            e.target.setFontSize(e.target.getFontSize()/2);
                        }
                       //obj.setHeight(maxY); 
                       console.log("too tall! height : " + obj.getHeight());
                       e.target.set({ height: maxX, scaleY: 1 });
                    } 
                }      
                obj.setCoords();
                // making sure top-left  corner stays in canvas
                if(obj.getBoundingRect().top < 0 || obj.getBoundingRect().left < 0){
                    obj.top = Math.max(obj.top, obj.top-obj.getBoundingRect().top);
                    obj.left = Math.max(obj.left, obj.left-obj.getBoundingRect().left);
                }
                //making sure bot-right corner stays in canvas
                if(obj.getBoundingRect().top+height  > back.height || obj.getBoundingRect().left+width  > back.width){
                    obj.top = Math.min(obj.top, back.height-obj.getBoundingRect().height+obj.top-obj.getBoundingRect().top);
                    obj.left = Math.min(obj.left, back.width-obj.getBoundingRect().width+obj.left-obj.getBoundingRect().left);
                }
                obj.setCoords();
                back.renderAll();
            });
            left.on("object:modified", function(e){    
                //gethering necessary information
                var obj = left.getActiveObject();
                var maxX = left.width;
                var maxY = left.height;
                var width = obj.getWidth();
                var height = obj.getHeight();
                var x = obj.left;
                var y = obj.top;
                 // if object is too big then resize
                if( obj.getWidth() > left.width){
                    if(e.target.type == 'text' || e.target.type == 'group' ) 
                    {
                        e.target.setFontSize(e.target.getFontSize()/2);
                    }
                    //obj.setWidth(maxX *2);
                    console.log("too wide! width : " + obj.getWidth());
                    e.target.set({ width: maxX, scaleX: 1 });
                } 
                if(obj.getHeight() > left.height){
                    if(e.target.type == 'text' || e.target.type == 'group' ) 
                    {
                        e.target.setFontSize(e.target.getFontSize()/2);
                    }
                   //obj.setHeight(maxY); 
                   console.log("too tall! height : " + obj.getHeight());
                   e.target.set({ height: maxY, scaleY: 1 });
                } 
                //the following is to help keep images within size range when their angle != 0
                if(e.target.getAngle() != 0 || e.target.getAngle() != 180){
                    if( obj.getWidth() > left.height){
                        if(e.target.type == 'text' || e.target.type == 'group' ) 
                        {
                            e.target.setFontSize(e.target.getFontSize()/2);
                        }
                        //obj.setWidth(maxX *2);
                        console.log("too wide! width : " + obj.getWidth());
                        e.target.set({ width: maxY, scaleX: 1 });
                    } 
                    if(obj.getHeight() > left.width){
                        if(e.target.type == 'text' || e.target.type == 'group' ) 
                        {
                            e.target.setFontSize(e.target.getFontSize()/2);
                        }
                       //obj.setHeight(maxY); 
                       console.log("too tall! height : " + obj.getHeight());
                       e.target.set({ height: maxX, scaleY: 1 });
                    } 
                }      
                obj.setCoords();
                // making sure top-left  corner stays in canvas
                if(obj.getBoundingRect().top < 0 || obj.getBoundingRect().left < 0){
                    obj.top = Math.max(obj.top, obj.top-obj.getBoundingRect().top);
                    obj.left = Math.max(obj.left, obj.left-obj.getBoundingRect().left);
                }
                //making sure bot-right corner stays in canvas
                if(obj.getBoundingRect().top+height  > left.height || obj.getBoundingRect().left+width  > left.width){
                    obj.top = Math.min(obj.top, left.height-obj.getBoundingRect().height+obj.top-obj.getBoundingRect().top);
                    obj.left = Math.min(obj.left, left.width-obj.getBoundingRect().width+obj.left-obj.getBoundingRect().left);
                }
                obj.setCoords();
                left.renderAll();
            });
    </script> 
    <!--END SAVE DESIGN SECTION-->
    <script type="text/javascript">
        var productPreview = document.getElementById('productPreview');
        var designPreview = document.getElementById('designPreview');
 
        function setDesign(){
            front.deactivateAll().renderAll();
            designPreview.src = front.toDataURL();
             var designPreviews = document.getElementsByClassName('designPreview');
            for (var i = 0; i < designPreviews.length; i++) {
              designPreviews[i].src = front.toDataURL();
            }
        }
        function setProductPreview(element){
            productPreview.style.backgroundImage = "url('"+element.src+"')";
        }
        //updating price in 'Add Products and Styles' modal
        //hidding label for current live price
        document.getElementById("itemPriceLabel").style.visibility  = "hidden";
        function setItemPrice(element)
        {
          //creating array of all sizes 
          var sizes = document.getElementsByClassName("quantity");
          //creating variable to hold the quantity
          var quantity = 0;
          //creating a variable to hold the total cost
          var itemTotal = 0.0;
          var s = "";
          for (var i = 0; i < sizes.length; i++) {
            quantity += Number(sizes[i].value);
            s += Number(sizes[i].value) + " ";
          }
          console.log('s : ' + s);
          //setting quantity to calc price
          setQuantity(quantity);

          //calculating price for acurate results
          calcPrice();
          if(quantity < 1)
          {
            document.getElementById("itemPriceLabel").style.visibility  = "hidden";
            document.getElementById('itemPrice').innerHTML = "";
            document.getElementById("numOfShirtsLabel").style.visibility  = "hidden";
            document.getElementById('numOfShirtsLabel').innerHTML = "";
            document.getElementById("itemTotal").style.visibility  = "hidden";
            document.getElementById('itemTotal').innerHTML = "";
            document.getElementById("itemTotalLabel").style.visibility  = "hidden";
          }
          else if( quantity == 1)
          {
            itemTotal = pricePerUnit;
            console.log("MARKER 1 : item total : " + itemTotal );
            document.getElementById("itemPriceLabel").style.visibility  = "visible";
            document.getElementById('itemPrice').innerHTML = "$" + pricePerUnit;
            document.getElementById("numOfShirtsLabel").style.visibility  = "visible";
            document.getElementById('numOfShirtsLabel').innerHTML = " <strong>QTY:</strong> "+quantityOfProduct+" shirt";
            document.getElementById("itemTotal").style.visibility  = "visible";
            document.getElementById('itemTotal').innerHTML = "$" + itemTotal;
            document.getElementById("itemTotalLabel").style.visibility  = "visible";
          }
          else
          {
            document.getElementById("itemPriceLabel").style.visibility  = "visible";
            itemTotal = (quantity) * pricePerUnit;
            console.log('MARKER 2 : itemTotal : ' + itemTotal);
            document.getElementById('itemPrice').innerHTML = "$" + pricePerUnit;
            document.getElementById("numOfShirtsLabel").style.visibility  = "visible";
            document.getElementById('numOfShirtsLabel').innerHTML = " <strong>qty:</strong> "+quantityOfProduct+" shirts";
            document.getElementById("itemTotal").style.visibility  = "visible";
            document.getElementById('itemTotal').innerHTML = "$" + itemTotal;
            document.getElementById("itemTotalLabel").style.visibility  = "visible";
          }
          //showing shipping information when
          getShippingInformation();
          }
        }
        //function preformed when the user wants to checkout from the 'add product' modal
        function checkoutFromGetPrice(){
          addingToCart = true;
          automatedCheckout = true;
          uploadEx();
        }
        //show 'get price modal'
        function getPrice(){
          setDesign(); calcPrice(); 
          $('#productPicker').modal('show');
        }
        //function notifying customer when their designs have been saved
        function savedSuccessfullyMessage(){
          var message = document.getElementById('savedSuccessfullyMessage');
          message.style.display="block";
          setTimeout(function(){ message.style.display="none"; }, 3000);
        }
        //function to make sure a design is made before allowing the customer to checkout. If there is no design, the customer cannot proceed to checkout
        function isThereDesign(showModal){
          var num = front.getObjects().length + right.getObjects().length + back.getObjects().length + left.getObjects().length;
          if(num > 0){
            if(showModal) {getPrice();}
            return true;
          }else{
            //alert letting the user know that no design was detected goes here
            var message = document.getElementById('noDesignError');
            message.style.display="block";
            setTimeout(function(){ message.style.display="none"; }, 3000);
            return false;
          }
        }
        //function determining if the customer can check out or not from add product modal
        function canCheckout_form(){
          var form = document.getElementById("checkout_form");
          var canCheckout = isThereDesign(false);
          if(canCheckout){
            form.submit();
          }
        }
        //function determining if the customer can check out or not from cart
        function canCheckout_cart(){
          var form = document.getElementById("cart_checkout_form");
          var canCheckout = isThereDesign(false);
          if(canCheckout){
            form.submit();
          }
        }
        //function to Sign user up without leaving the page and their current design
        function signup(){
          var username = document.getElementById('username').value;
          $.ajax({
            type: "post",
            url: "signup.php",
            data: { 
              firstName : document.getElementById('firstname').value,
              lastName : document.getElementById('lastname').value,
              username : document.getElementById('username').value,
              password : document.getElementById('password').value,
              email : document.getElementById('email').value,
              phone : document.getElementById('phone').value,
            },
            success: function(result) {
              //change sign up button here
              var btn = document.getElementById("signup");
              btn.classList.remove('btn-success');
              btn.classList.add('btn-info');
              btn.innerHTML = "Logout";
              btn.onclick = function() { window.location.href='logout.php'};
              btn.setAttribute("data-target", "#");
            },
            error: function(result){
              alert("An error occured");
            }
          });
        }
        //function to deselect all objects in all canvases. This just prevents a lot of errors in general.
        function deselectAllCanvases(){
          front.deactivateAll().renderAll();
          right.deactivateAll().renderAll();
          back.deactivateAll().renderAll();
          left.deactivateAll().renderAll();
        }
        //function to show and dismiss popovers in the product picker plus sizes
        var _2xl = document.getElementById('xxl');
         var _3xl = document.getElementById('xxxl');
         var _4xl = document.getElementById('xxxxl');
         var _5xl = document.getElementById('xxxxxl');
         _2xl.onfocus = function(){
          console.log('5xl onfocus');
          $(this).popover('show');
         }
         _2xl.onblur = function(){
          console.log('5xl onblur');
          $(this).popover('hide');
         }
         _3xl.onfocus = function(){
          console.log('5xl onfocus');
          $(this).popover('show');
         }
         _3xl.onblur = function(){
          console.log('5xl onblur');
          $(this).popover('hide');
         }
         _4xl.onfocus = function(){
          console.log('5xl onfocus');
          $(this).popover('show');
         }
         _4xl.onblur = function(){
          console.log('5xl onblur');
          $(this).popover('hide');
         }
         _5xl.onfocus = function(){
          console.log('5xl onfocus');
          $(this).popover('show');
         }
         _5xl.onblur = function(){
          console.log('5xl onblur');
          $(this).popover('hide');
         }
         //function: show shipping information to customer.
         function getShippingInformation(){
            /*
            REQUIREMENTS:
            Guarantee 2 week delivery
            Make sure delivery date isn't on weekend or holiday
            */
            var div = document.getElementById('shippingSection').style.visibility = "visible";
            var deliveryDate = new Date();
            //MAKE SURE THIS LINE IS WRITE SINCE I'M TESTING WITH IT
            deliveryDate.setDate(deliveryDate.getDate() + 14);
            //make sure delivery date isn't on weekend
            if(deliveryDate.getDay() == 6){
              deliveryDate.setDate(deliveryDate.getDate() + 2);
            }
            else if (deliveryDate.getDate() == 0 ){
              deliveryDate.setDate(deliveryDate.getDate() + 1); 
            }
            //making sure deliveryDate isn't on a federal holiday
            var newYears = new Date(2017,0,1);
           var independenceDay = new Date(2017,6,4);
           var VETRANS_DAY = new Date(2017, 10, 11);
           var christmas = new Date(2017, 11, 25);
           //this is a current date to reference
           var c = new Date();
           //finding mlk day
           var mlk = new Date(c.getFullYear(), 0, 1);
          var day = mlk.getDay();
          var target = 1;
          var diff = target - day;
          day = diff + 14 + 1;
          mlk.setDate(day);
          //finding Washington's birthday
          var washington = new Date(c.getFullYear(),1,1);
          day = washington.getDay();
          target = 1;
          diff = target - day;
          day = diff + 21 + 1;
          washington.setDate(day);
          //finding Memorial Day
          var memorial = new Date(c.getFullYear(),5,0);
          day = memorial.getDay();   
          target = 1;
          if(day > target){
            diff = target - day;
            day = 31 + diff;
            memorial.setDate(day);
          }else if(day < target){
            memorial.setDate(memorial.getDate() - 6);
          }
          //finding Labor Day
          var labor = new Date(c.getFullYear(), 8 , 1);
          day = labor.getDay();
          target = 1;
          if ( day >  target ){
            diff = day - target; 
            day = 7 - diff;
            labor.setDate(day + 1); //adding 1 because day is zero based and the date isn't
          }else if( day < target ){
            day++;
            labor.setDate(day);
          }
          //finding Columbus Day
          var columbus = new Date(c.getFullYear(),9,1);
          day = columbus.getDay();
          target = 1;
          if(day > target){
            diff = day - target;
            day = 7 - diff;
            day = day + 7;
          }else if( day < target ){
            day = day + 1 + 7;
          }else{
            day += 7;
          }
          columbus.setDate(day+1);
          //finding thanksgiving
          var thanksgiving = new Date(c.getFullYear(), 10 , 1);
          day = thanksgiving.getDay();
          target = 4;         
          diff = target - day;
          day = diff + 21 + 1;
          thanksgiving.setDate(day);

          //making sure the delivery date isn't a holiday
          if(newYears.getMonth() == deliveryDate.getMonth() && newYears.getDate() == deliveryDate.getDate() ||
            independenceDay.getMonth() == deliveryDate.getMonth() && independenceDay.getDate() == deliveryDate.getDate() ||
            VETRANS_DAY.getMonth() == deliveryDate.getMonth() && VETRANS_DAY.getDate() == deliveryDate.getDate() ||
            christmas.getMonth() == deliveryDate.getMonth() && christams.getDate() == deliveryDate.getDate() ||
            mlk.getMonth() == deliveryDate.getMonth() && mlk.getDate() == deliveryDate.getDate() ||
            washington.getMonth() == deliveryDate.getMonth() && washington.getDate() == deliveryDate.getDate() ||
            memorial.getMonth() == deliveryDate.getMonth() && memorial.getDate() == deliveryDate.getDate() ||
            labor.getMonth() == deliveryDate.getMonth() && labor.getDate() == deliveryDate.getDate() ||
            columbus.getMonth() == deliveryDate.getMonth() && columbus.getDate() == deliveryDate.getDate() ||
            thanksgiving.getMonth() == deliveryDate.getMonth() && thanksgiving.getDate() == deliveryDate.getDate() ){
            deliveryDate.setDate(deliveryDate.getDate()+1);
          }
          //arrays for date formatting
          var day = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
          var month = ['Janurary','Feburary','March','April','May','June','July','August','September','October','November','December'];
          document.getElementById('deliveryDate').innerHTML = day[deliveryDate.getDay()] + ", " + month[deliveryDate.getMonth()] + " " + deliveryDate.getDate();
          console.log('function finished');
          console.log('innerhtml : ' + document.getElementById('deliveryDate').innerHTML);
          
         }
        
    </script>


    <!--TEXT DESIGN JAVASCRIPT-->
    <script>
                    
                    //canvas = new fabric.Canvas('c');
                    front.on('selection:cleared', onDeSelected);
                    front.on('object:selected', onSelected);
                    front.on('selection:created', onSelected);

                    //front.add(CurvedText).renderAll();
                    //front.setActiveObject(front.item(front.getObjects().length-1));
                    $('#text').change(function(){
                      var obj = front.getActiveObject();
                      if(obj){
                        obj.setText(this.value);
                        front.renderAll();
                        return;
                      }
                      colorText = "#000000";
                      colorArt = "#000000";
                      strokeColor = "#000000";
                      font = 'Ariel'; 

                      text = document.getElementById('text').value;
                      document.getElementById('text').value = "";
                      alert("nothing : " + document.getElementById('text').value );
                      var txt = new fabric.Text(text,{
                          fontFamily: font,
                          stroke: strokeColor,
                          left:50,
                          top:50,
                          hasRotatingPoint: false
                          //effect: 'curved'//'STRAIGHT'
                        });
                      txt.setColor(colorText); //this will set the color not just the stroke
                      
                      txt.set({
                                  id: objId,
                                  hasRotatingPoint: false                       
                              });
                      objId++;
                      txt.customiseCornerIcons({
                          settings: {
                              borderColor: 'rgba(100,100,100,100)', //black
                              cornerSize: 20,
                              cornerShape: 'circle',
                              cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                              cornerPadding: 5,
                                hasRotatingPoint: false
                          },
                          tl: {
                              icon: 'img/x.png', //icons/rotate.svg
                          },
                          tr: {
                              icon: 'img/rotate_2.png', //img/resize.svg
                          },
                          bl: {
                          icon: 'img/resize_left.png',
                          },
                          br: {
                             icon: 'img/resize_right.png',
                          },
                      }, function() {
                          front.renderAll();
                          right.renderAll();
                          back.renderAll();
                          left.renderAll();
                      });
                      //DECIDING WHICH CANVAS TO ADD TOO
                      switch (canvasCounter){
                          case 1:
                              front.add(txt).setActiveObject(txt);
                              break
                          case 2:
                              right.add(txt).setActiveObject(txt);
                              break;
                          case 3:
                              back.add(txt).setActiveObject(txt);
                              break;
                          default:
                              left.add(txt).setActiveObject(txt);
                      }
                    });
                    $('#reverse').click(function(){
                      var obj = front.getActiveObject();
                      if(obj){
                        obj.set('reverse',$(this).is(':checked')); 
                        front.renderAll();
                      }
                    });
                    $('#radius, #spacing').change(function(){ // , #fill was taken out of the selector
                      console.log("radius of spacing change triggered");
                      var obj = front.getActiveObject();
                      if(obj){
                        console.log("this :" + this);
                        console.log("this.attr : " + $(this).attr('id') );
                        console.log("this.val : " + $(this).val() );
                        
                        obj.set($(this).attr('id'),$(this).val()); 
                      }
                      front.renderAll();
                    });
                    
                    /*This is commented out because #fill is commented out
                    $('#fill').change(function(){
                      var obj = front.getActiveObject();
                      if(obj){
                        obj.setFill($(this).val()); 
                      }
                      front.renderAll();
                    });*/
                    /*Commented because #save was commented out
                    $('#save').click(function() {
                      var design = JSON.stringify(front.toJSON());
                      front.clear();
                      front.renderAll();
                      front.loadFromJSON(design, function() {
                        console.log('loaded');      
                        front.renderAll();
                      });
                    });*/
                    $('#convert').click(function(){
                      var props = {};
                      var obj = front.getActiveObject();
                      if(obj){
                        if(/curvedText/.test(obj.type)) {
                          default_text = obj.getText();
                          props = obj.toObject();
                          delete props['type'];
                          var textSample = new fabric.Text(default_text, props);
                        }else if(/text/.test(obj.type)) {
                          default_text = obj.getText();
                          props = obj.toObject();
                          delete props['type'];
                          props['textAlign'] = 'center';
                          props['radius'] = 50;
                          props['spacing'] = 20;
                          var textSample = new fabric.CurvedText(default_text, props);
                        }
                        front.remove(obj);
                        front.add(textSample).renderAll();
                        front.setActiveObject(front.item(front.getObjects().length-1));
                      }
                    });
                    function onSelected(){
                      console.log("onSelected triggered");
                      var obj = front.getActiveObject();
                      $('#text').val(obj.getText());
                      $('#reverse').prop('checked', obj.get('reverse'));
                      $('#radius').val(obj.get('radius'));
                      $('#spacing').val(obj.get('spacing'));
                      //$('#fill').val(obj.getFill());
                      /*Commented out because #effect was commented out
                      if(obj.getEffect) {
                        $('#effect').val(obj.getEffect());
                      }*/
                    }
                    function onDeSelected(){
                      console.log("onDeSelected triggered");
                      $('#text').val('');
                      $('#reverse').prop('checked', false);
                      $('#radius').val(50);
                      $('#spacing').val(20);
                      //$('#fill').val('#0000FF');
                      //$('#effect').val('curved');
                    }
                    //function to add text
                    function addTextToDesign(){
                      var obj = front.getActiveObject();
                      if(obj){
                        obj.setText(this.value);
                        front.renderAll();
                        return;
                      }
                      colorText = "#000000";
                      colorArt = "#000000";
                      strokeColor = "#000000";
                      font = 'Ariel'; 

                      text = document.getElementById('text').value;
                      document.getElementById('text').value = ""; console.log('#text should be clear!');
                      var txt = new fabric.Text(text,{
                          fontFamily: font,
                          stroke: strokeColor,
                          left:50,
                          top:50
                          //effect: 'curved'//'STRAIGHT'
                        });
                      txt.setColor(colorText); //this will set the color not just the stroke
                      
                      txt.set({
                                  id: objId,
                                  hasRotatingPoint: false                       
                              });
                      objId++;
                      txt.customiseCornerIcons({
                          settings: {
                              borderColor: 'rgba(100,100,100,100)', //black
                              cornerSize: 20,
                              cornerShape: 'circle',
                              cornerBackgroundColor: 'rgba(100,100,100,100)', //black
                              cornerPadding: 5,
                                hasRotatingPoint: false
                          },
                          tl: {
                              icon: 'img/x.png', //icons/rotate.svg
                          },
                          tr: {
                              icon: 'img/rotate_2.png', //img/resize.svg
                          },
                          bl: {
                          icon: 'img/resize_left.png',
                          },
                          br: {
                             icon: 'img/resize_right.png',
                          },
                      }, function() {
                          front.renderAll();
                          right.renderAll();
                          back.renderAll();
                          left.renderAll();
                      });
                      //DECIDING WHICH CANVAS TO ADD TOO
                      switch (canvasCounter){
                          case 1:
                              front.add(txt).setActiveObject(txt);
                              break
                          case 2:
                              right.add(txt).setActiveObject(txt);
                              break;
                          case 3:
                              back.add(txt).setActiveObject(txt);
                              break;
                          default:
                              left.add(txt).setActiveObject(txt);
                      }
                    }
                  </script>
    <?php
    //super important code goes here!
    ?>

 
</body>
</html>
