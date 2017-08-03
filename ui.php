<?php
//include 'session.php';
session_start();
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
        img:hover{
            background-color: #eeeeee;
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
            background-color: red !important;
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
            background-color: red !important;
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
    </style>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--to replace style tags on this page-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<!--START NEW PAGE-->
<div class="page-wrapper">
<div class="container" style="width: 1360px !important; height: 900px !important;">
    <!--TOP BAR-->
    <div>
        <div id="topBar">
            <div class="row">
            <div class="col-sm-1">
            <img src="https://vividcustoms.com/skin/frontend/tv_nautica_package/tv_nautica8/images/logo.png">
            </div>
            <div class="col-sm-9"></div>
            <div class="col-sm-2">
                <p id="showPrice"></p><p id="forChrome" style="visibility: hidden;">when this is hidden here to make chrome work </p>
                <form action="buynow.php" method="POST">                        
                    <button id="buybtn" style="display: none;" type="submit" class="btn btn-primary" >Buy Now</button>      
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!--START SIDE BAR-->
        <div class="col-sm-1" >   
            <style type="text/css">

            </style>
            <ul class="nav nav-tabs nav-stacked" style="height: 90%;">
                <li class="active" ><a   data-toggle="tab" href="#addArt">Add Art</a></li>
                <li ><a  data-toggle="tab" href="#textSection">Text Design</a></li>
                <li ><a  data-toggle="tab" href="#productSection">Product</a></li>
                <li ><a  data-toggle="tab" href="#priceSection">Price</a></li>
                <!--<li ><a  data-toggle="tab" href="#shareSection" onclick="share();">Share</a></li>-->
                <li ><a   data-toggle="tab" href="#saveSection" onclick="share();">Save &amp; Share</a></li>
            </ul>
        </div>
        <!--END  SIDE BAR-->
        <!--START TAB CONTENT-->
        <div class="col-sm-3" style="height: 90%;">
            <div class="tab-content" >
                <div id="addArt" class="tab-pane fade in active">
                    <h3>Add Art</h3>
                    <p>Have your own image, logo or artwork?</p>
                    <!--START UPLOADING IMAGE SECTION-->
                    <input id="imgUpload" type="file" name="imgUpload" data-buttonText="upload" onchange="uploadImage();">
                    <img id="imgPreview" style="" src="" alt="" onclick="addImg(this); imgPreviewCanvas();"> 
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
                    <img src="data:image/png;base64,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" width="64" height="64" onclick="addImg(this);">
                    <img src="img/watchdogs.png" width="64" height="64" onclick="addImg(this);">
                    <img src="data:image/png;base64,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" width="64" height="64" onclick="addImg(this);"> 
                    <img src="data:image/png;base64,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" width="64" height="64" onclick="addImg(this);">
                    <!--END CLIP ART SECTION-->
                    <!--To remove items from canvas-->
                    <button onclick="removeItem();">Remove</button>
                    <!--COLOR SECTION-->
                        <style type="text/css">

                        </style>
                        <div class="row" id="colorRow" style="font-size: 3px !important;"> 
                            <div class="colorColumn col-sm-4" id="">   
                                <div class="colorGroup list-group" id="">
                                    <a href="#" class="list-group-item active"><div class="colorItem" style="color: #00ffff; background-color: #00ffff;"   onclick="changeColor(this.innerHTML);">#00ffff</div></a>
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #808000; background-color: #808000;"   onclick="changeColor(this.innerHTML);">#808000</div></a>
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #800000; background-color: #800000;"   onclick="changeColor(this.innerHTML);">#800000</div></a>
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #880000; background-color: #880000;"   onclick="changeColor(this.innerHTML);">#880000</div></a>
                                </div>
                            </div> 
                            <div class="colorColumn col-sm-4" id="colorColumn">
                                <div class="colorGroup list-group">
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #ff0000; background-color: #ff0000;"   onclick="changeColor(this.innerHTML);">#ff0000</div></a>
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #00ff00; background-color: #00ff00;"   onclick="changeColor(this.innerHTML);">#00ff00</div></a>
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #0000ff; background-color: #0000ff;"   onclick="changeColor(this.innerHTML);">#0000ff</div></a>
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #000088; background-color: #000088;"   onclick="changeColor(this.innerHTML);">#000088</div></a>
                                </div>
                            </div>
                            <div class="colorColumn col-sm-4" id="colorColumn">
                                <div class="colorGroup list-group">
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #ff0000; background-color: #ff0000;"   onclick="changeColor(this.innerHTML);">#ff0000</div></a>
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #00ff00; background-color: #00ff00;"   onclick="changeColor(this.innerHTML);">#00ff00</div></a>
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #0000ff; background-color: #0000ff;"   onclick="changeColor(this.innerHTML);">#0000ff</div></a>
                                    <a href="#" class="list-group-item"><div class="colorItem" style="color: #000088; background-color: #000088;"   onclick="changeColor(this.innerHTML);">#000088</div></a>
                                </div>
                            </div>
                        </div>
                    <!--END COLOR SECTION-->
                </div>
                <div id="textSection" class="tab-pane fade">
                    <h3>ADD TEXT</h3>
                    <!--START TEXT DESIGN SECTION-->
                        <form onsubmit="return false;">
                            <input  class="form-control" id="text" type="text" onchange="setText();" placeholder="Enter text">
                            <input  class="form-control" id="color" type="text" onchange="setColor();" placeholder="Enter hex color">
                            <input  class="form-control" id="strokeColor" type="text" onchange="setStrokeColor();" placeholder="Enter hex stroke color">
                            <!--START FONTS MODAL-->
                                <!-- Button trigger modal -->
                                <input type="button" value="Fonts" class="btn btn-primary" data-toggle="modal" data-target="#fontModal">
                                
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
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-3"><h3 id="bully" onclick="setFont(this);">Bully Style</h3></div>
                                                <div class="col-sm-3"><h3 id="PokemonHollow" onclick="setFont(this);">Gotta Catch</h3></div>
                                                <div class="col-sm-3"><h3 id="PokemonSolid" onclick="setFont(this);">Them All!</h3></div>
                                                <div class="col-sm-3"><h3 id="jelly" onclick="setFont(this);">Jellyfi Text</h3></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"><h3 id="angry" onclick="setFont(this);">Angry Birds!</h3></div>
                                                <div class="col-sm-3"><h3 id="tmnt" onclick="setFont(this);">Turtle Power!</h3></div>
                                                <div class="col-sm-3"><h3 id="db" onclick="setFont(this);">Make a Wish</h3></div>
                                                <div class="col-sm-3"><h3 id="dbz" onclick="setFont(this);">But be careful</h3></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"><h3 id="spongebob" onclick="setFont(this);">Lives Under The Sea!</h3></div>
                                                <div class="col-sm-3"><h3 id="tmnt" onclick="setFont(this);">Turtle Power!</h3></div>
                                                <div class="col-sm-3"><h3 id="db" onclick="setFont(this);">Make a Wish</h3></div>
                                                <div class="col-sm-3"><h3 id="dbz" onclick="setFont(this);">But be careful</h3></div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--END FONTS MODAL-->
                            <!--To remove items from canvas-->
                            <input type="button" class="btn btn-primary" value="Remove" onclick="removeItem();">
                            <input class="btn btn-primary" type="button" value="Normal" onclick="straight();">
                            <input class="btn btn-primary" type="button" value="Circle" onclick="circle();">
                            <input class="btn btn-primary" type="button" value="Bridge" onclick="curve();">
                            <input class="btn btn-primary" type="button" value="Valley" onclick="reverseCurve();">
                            
                        </form>
                    <!--END TEXT DESIGN SECTION-->
                </div>
                <div id="productSection" class="tab-pane fade">
                    <h3>SWAP ITEM</h3>
                    <p>1. Switch to a different product</p>
                    <p>2. Choose a color</p>
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
                                        <td onclick="setProduct(this);"><img src="img/shirt_white.jpg" style="width: 64;"><br> <span class="product_name"> White Shirt </span></td>
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
                    <!--END  CHOOSE PRODUCT MODAL-->
                </div>
                <div id="priceSection" class="tab-pane fade"> 
                    <!--CHANGE QUANTITY-->
                    <input class="form-control" id="quantity" type="number" placeholder="Enter quantity" onchange="setQuantity(this.value); showPrice();">
                </div>
                <div id="shareSection" class="tab-pane fade">
                    <h3>Share</h3>
                    <p>Via Facebook, Twitter, Instagram, or Email!</p>
                    <i class="fa fa-facebook" aria-hidden="true" style="font-size: 5vh;"></i>
                    <i class="fa fa-twitter" aria-hidden="true" style="font-size: 5vh;"></i>
                    <i class="fa fa-instagram" aria-hidden="true" style="font-size: 5vh;"></i>
                    <i class="fa fa-envelope-o" aria-hidden="true" style="font-size: 5vh;"></i>
                    <form action="email.php" method="post">
                        <!--URLs for front, right, back, and left designs with products-->
                        <input type="hidden" id="frontShirtURL" name="frontShirtURL">
                        <input type="hidden" id="frontImageURL" name="frontImageURL">
                        <input type="hidden" id="rightShirtURL" name="rightShirtURL">
                        <input type="hidden" id="rightImageURL" name="rightImageURL">
                        <input type="hidden" id="backShirtURL" name="backShirtURL">
                        <input type="hidden" id="backImageURL" name="backImageURL">
                        <input type="hidden" id="leftShirtURL" name="leftShirtURL">
                        <input type="hidden" id="leftImageURL" name="leftImageURL">
                        <input type="email" name="email" placeholder="Enter email">
                        <!--<i class="fa fa-envelope-o" aria-hidden="true" style="font-size: 5vh;"><input type="submit" name="submit" class="btn btn-primary"></i>-->
                        <button type="submit" name="submit" class="btn btn-primary fa fa-envelope-o"></button>
                    </form>
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
                            //SETTING FRONT IMAGE AND FORM DATA
                            var picture = folderName + "/" + fileAddress + "/" + fileAddress + "_front.png";
                            document.getElementById('sharePreviewFront').src = picture;
                            var imageLocation = window.location.href;
                            document.getElementById('frontImageURL').value = imageLocation.substring(0, imageLocation.length - 6) + picture;
                            //SETTING RIGHT IMAGE AND FORM DATA
                            picture = folderName + "/" + fileAddress + "/" + fileAddress + "_right.png";
                            document.getElementById('sharePreviewRight').src = picture;
                            document.getElementById('rightImageURL').value = imageLocation.substring(0, imageLocation.length - 6) + picture;
                            //SETTING BACK IMAGE AND FORM DATA
                            picture = folderName + "/" + fileAddress + "/" + fileAddress + "_back.png";
                            document.getElementById('sharePreviewBack').src = picture;
                            document.getElementById('backImageURL').value = imageLocation.substring(0, imageLocation.length - 6) + picture;
                            //SETTING RIGHT IMAGE AND FORM DATA
                            picture = folderName + "/" + fileAddress + "/" + fileAddress + "_left.png";
                            document.getElementById('sharePreviewLeft').src = picture;
                            document.getElementById('leftImageURL').value = imageLocation.substring(0, imageLocation.length - 6) + picture;

                            //getting the product image TODO change the way this is set!
                            var frontShirt = document.getElementById('description_image').src;
                            document.getElementById('frontShirtURL').value = frontShirt;
                            document.getElementById('rightShirtURL').value = frontShirt;
                            document.getElementById('backShirtURL').value = frontShirt;
                            document.getElementById('leftShirtURL').value = frontShirt;

                            //showing the most recent saved design with the most recent product in preperation to be shared
                            shareDesignsDiv.style.display = "block";
                        }
                    </script>
                </div>
               <div id="saveSection" class="tab-pane fade">
                    <h3>Look at your previous designs!</h3> 
                    <?php                                  
                        echo('<select id="mydesings" name="mydesings" onChange="LoadImages();">');                      
                        echo ('<option value="Select the desing">Select the desing</option>');     
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
                                 echo ('<option value="'.$scanned_directory[$i].'">'.$scanned_directory[$i].'</option>');       
                                }                       
                        }                                               
                        echo ('</select>');                         
                    ?>
                   <br>
                    <!--TODO PUT THESE DIVS IN EITHER A ROW, GRID, OR CAROUSEL-->
                    <div id="savedDesigns">
                        <table>
                        <tbody>
                        <tr>
                        <td>
                             <div id="frontSavedDesing"  style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="frontSavePreview" src="" onclick="LoadDesings()">
                             </div> 
                        </td>
                        <td>
                             <div id="rightSavedDesing" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="rightSavePreview" src=""  onclick="LoadDesings()">
                             </div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                             <div id="backSavedDesing" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="backSavePreview" src=""  onclick="LoadDesings()">
                             </div> 
                        </td>
                        <td>
                             <div id="leftSavedDesing" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="leftSavePreview" src=""  onclick="LoadDesings()">
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

                       function LoadImages()
                       {
                            //shows previews of saved design when user wants to see a saved design
                            savedDesignsDiv.style.display = "block";

                            var desing =   document.getElementById("mydesings").value;
                            var guest = desing.split("_", 1);

                            var file = guest+ '/' + desing + '/' + desing;                            
                            document.getElementById('frontSavePreview').src = file+ '_front.png';
                            document.getElementById('rightSavePreview').src = file+ '_right.png';
                            document.getElementById('backSavePreview').src = file+ '_back.png';
                            document.getElementById('leftSavePreview').src = file+ '_left.png';

                       }

                       function LoadDesings()
                       {   
                            //shows previews of saved design when user wants to see a saved design
                            savedDesignsDiv.style.display = "block";

                           var desing =   document.getElementById("mydesings").value;
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
                    <h3>Share</h3>
                    <p>Via Facebook, Twitter, Instagram, or Email!</p>
                    <i class="fa fa-facebook" aria-hidden="true" style="font-size: 5vh;"></i>
                    <i class="fa fa-twitter" aria-hidden="true" style="font-size: 5vh;"></i>
                    <i class="fa fa-instagram" aria-hidden="true" style="font-size: 5vh;"></i>
                    <i class="fa fa-envelope-o" aria-hidden="true" style="font-size: 5vh;"></i>
                    <form action="email.php" method="post">
                        <!--URLs for front, right, back, and left designs with products-->
                        <input type="hidden" id="frontShirtURL" name="frontShirtURL">
                        <input type="hidden" id="frontImageURL" name="frontImageURL">
                        <input type="hidden" id="rightShirtURL" name="rightShirtURL">
                        <input type="hidden" id="rightImageURL" name="rightImageURL">
                        <input type="hidden" id="backShirtURL" name="backShirtURL">
                        <input type="hidden" id="backImageURL" name="backImageURL">
                        <input type="hidden" id="leftShirtURL" name="leftShirtURL">
                        <input type="hidden" id="leftImageURL" name="leftImageURL">
                        <input type="email" name="email" placeholder="Enter email">
                        <!--<i class="fa fa-envelope-o" aria-hidden="true" style="font-size: 5vh;"><input type="submit" name="submit" class="btn btn-primary"></i>-->
                        <button type="submit" name="submit" class="btn btn-primary fa fa-envelope-o"></button>
                    </form>
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
                            //SETTING FRONT IMAGE AND FORM DATA
                            var picture = folderName + "/" + fileAddress + "/" + fileAddress + "_front.png";
                            document.getElementById('sharePreviewFront').src = picture;
                            var imageLocation = window.location.href;
                            document.getElementById('frontImageURL').value = imageLocation.substring(0, imageLocation.length - 6) + picture;
                            //SETTING RIGHT IMAGE AND FORM DATA
                            picture = folderName + "/" + fileAddress + "/" + fileAddress + "_right.png";
                            document.getElementById('sharePreviewRight').src = picture;
                            document.getElementById('rightImageURL').value = imageLocation.substring(0, imageLocation.length - 6) + picture;
                            //SETTING BACK IMAGE AND FORM DATA
                            picture = folderName + "/" + fileAddress + "/" + fileAddress + "_back.png";
                            document.getElementById('sharePreviewBack').src = picture;
                            document.getElementById('backImageURL').value = imageLocation.substring(0, imageLocation.length - 6) + picture;
                            //SETTING RIGHT IMAGE AND FORM DATA
                            picture = folderName + "/" + fileAddress + "/" + fileAddress + "_left.png";
                            document.getElementById('sharePreviewLeft').src = picture;
                            document.getElementById('leftImageURL').value = imageLocation.substring(0, imageLocation.length - 6) + picture;

                            //getting the product image TODO change the way this is set!
                            var frontShirt = document.getElementById('description_image').src;
                            document.getElementById('frontShirtURL').value = frontShirt;
                            document.getElementById('rightShirtURL').value = frontShirt;
                            document.getElementById('backShirtURL').value = frontShirt;
                            document.getElementById('leftShirtURL').value = frontShirt;

                            //showing the most recent saved design with the most recent product in preperation to be shared
                            shareDesignsDiv.style.display = "block";
                        }
                    </script>
                </div>
            </div>
        </div>
        <!--END  TAB CONTENT-->
        <!--START SHIRT SECTION-->
        <div class="col-sm-8" style="height: 90%;" >
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
                                    background-image: url('img/shirt.png');
                                    background-repeat: no-repeat;
                                    background-size: cover;
                                    background-position: center center;
                                }
                                #canvas-wrapper{
                                    border: 1px solid #eeeeee;
                                    width: 60%;
                                    height: 80%;
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
</div>
</div>
</div>
<!--END  NEW PAGE-->

    
    <script src="lib/fabric.js"></script>
    <script>
        //var canvas = new fabric.Canvas('frontCanvas');
        var additionalpictures = "";
        var canvasCounter = 1;
        var front = new fabric.Canvas('frontCanvas'); 
        var right = new fabric.Canvas('rightCanvas');
        var back = new fabric.Canvas('backCanvas');
        var left = new fabric.Canvas('leftCanvas'); 
        var text = "";
        var color = "#4169e1";
        var strokeColor = "#ff0000";
        var font = 'Ariel'; 
        front.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        front.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        right.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        right.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        back.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        back.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        left.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        left.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
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
        var quantityOfProduct = 1;
        var costOfProduct = 1.0;
        var pricePerUnit = 0.0;
        var totalPrice = 0.0;
        var numObjectsFront = 0;
        var numObjectsRight = 0;
        var numObjectsBack = 0;
        var numObjectsLeft = 0;


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
            //TODO determining number of colors based on each object
            
            if (quantityOfProduct < 5){
                pricePerUnit = costOfProduct + 17;
            } else if (quantityOfProduct < 11){
                pricePerColor = numOfColors < 4 ? 14.00 : 15.00;
                pricePerUnit = numOfColors * pricePerColor;
            } else if (quantityOfProduct < 24){
                pricePerColor = numOfColors < 2 ? 5.5 : numOfColors < 3 ? 9.75 : numOfColors <= 4 ? 13.00 : 15;
                pricePerUnit = numOfColors * pricePerColor;
            } else if (quantityOfProduct < 36){
                pricePerColor = numOfColors < 2 ? 4.75 : numOfColors < 3 ? 7.65 : numOfColors < 4 ? 8.75 : numOfColors < 5 ? 10.25 : numOfColors < 6 ? 13.0 : 15.0;
                pricePerUnit = numOfColors * pricePerColor;
            } else if (quantityOfProduct < 48){
                pricePerColor = numOfColors < 2 ? 4.0 : numOfColors < 3 ? 5.0 : numOfColors < 4 ? 7.0 : numOfColors < 5 ? 8.75 : numOfColors < 6 ? 9.0 : numOfColors < 7 ? 10.3 : numOfColors < 7 ? 11.30 : 12.3;
                pricePerUnit = numOfColors * pricePerColor;
            } else if (quantityOfProduct < 70){
                pricePerColor = numOfColors < 2 ? 3.5 : numOfColors < 3 ? 4.0 : numOfColors < 4 ? 5.0 : numOfColors < 5 ? 5.65 : numOfColors < 6 ? 6.4 : numOfColors < 7 ? 7.2 : numOfColors < 7 ? 8.0 : 9.0;
                pricePerUnit = numOfColors * pricePerColor;
            } else if (quantityOfProduct < 150){
                pricePerColor = numOfColors < 2 ? 2.85 : numOfColors < 3 ? 3.5 : numOfColors < 4 ? 4.0 : numOfColors < 5 ? 4.65 : numOfColors < 6 ? 5.00 : numOfColors < 7 ? 5.45 : numOfColors < 7 ? 5.95 : 6.95;
                pricePerUnit = numOfColors * pricePerColor;
            } else if (quantityOfProduct < 300){
                pricePerColor = numOfColors < 2 ? 2.55 : numOfColors < 3 ? 3.0 : numOfColors < 4 ? 3.35 : numOfColors < 5 ? 3.75 : numOfColors < 6 ? 4.00 : numOfColors < 7 ? 4.5 : numOfColors < 7 ? 4.7 : 5.7;
                pricePerUnit = numOfColors * pricePerColor;
            } else if (quantityOfProduct < 500){
                pricePerColor = numOfColors < 2 ? 2.5 : numOfColors < 3 ? 2.75 : numOfColors < 4 ? 3.0 : numOfColors < 5 ? 3.3 : numOfColors < 6 ? 3.5 : numOfColors < 7 ? 3.8 : numOfColors < 7 ? 4.1 : 4.90;
                pricePerUnit = numOfColors * pricePerColor;
            } else if (quantityOfProduct < 700){
                pricePerColor = numOfColors < 2 ? 2.25 : numOfColors < 3 ? 2.50 : numOfColors < 4 ? 2.75 : numOfColors < 5 ? 3.0 : numOfColors < 6 ? 3.25 : numOfColors < 7 ? 3.5 : numOfColors < 7 ? 3.75 : 4.25;
                pricePerUnit = numOfColors * pricePerColor;
            } else {
                pricePerColor = numOfColors < 2 ? 2.05 : numOfColors < 3 ? 2.25 : numOfColors < 4 ? 2.50 : numOfColors < 5 ? 2.85 : numOfColors < 6 ? 3.10 : numOfColors < 7 ? 3.40 : numOfColors < 7 ? 3.65 : 3.9;
                pricePerUnit = numOfColors * pricePerColor;
            }
            totalPrice = pricePerUnit * quantityOfProduct;
            //setting everything to 2 decimal places for dollar amout
            pricePerUnit = pricePerUnit.toFixed(2);
            totalPrice = totalPrice.toFixed(2);
        }
        //SHOWING PRICE
        function showPrice(){
            //TODO when rotating the shirt, make sure you save the number of objects that are on that side
            document.getElementById('forChrome').style.display = 'none';
            document.getElementById('showPrice').innerHTML = "";
            calcPrice();
            document.getElementById('showPrice').innerHTML = "price per shirt : " + pricePerUnit + " <br> total price : " + totalPrice;
            if(front.getObjects().length > 0 || right.getObjects().length > 0 || back.getObjects().length > 0 || left.getObjects().length > 0){
                document.getElementById('buybtn').style.display = 'block';
            }else{
                document.getElementById('buybtn').style.display = 'none';
            }
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
        function addImg(element){
            //getting img src
            var imgSrc = element.src;
            //adding image to canvas
            fabric.Image.fromURL(imgSrc, function(img){

                    /*var str = element.src;
                    var n = str.search("data:image");  
                    if (n == -1)
                    {                   
                        element.setAttribute( 'src', previewCanvas.toDataURL("image/png") );                        
                    }*/               
                    //img.setSrc(previewCanvas.toDataURL("image/png"));
                    img.setWidth(front.width/4);
                    img.setHeight(front.height/4);
                    //DECIDING WHICH CANVAS TO ADD TOO
                    switch (canvasCounter){
                        case 1:
                            front.add(img);
                            break
                        case 2:
                            right.add(img);
                            break;
                        case 3:
                            back.add(img);
                            break;
                        default:
                            left.add(img);
                    }
                    //canvas.add(img);
                    //this is where animation would go          
            }); 
            clipArtAdded = true; //set for pricing purposes
        }

        function changeColor(newColor){
            //this is to record what was done for the purpose of saving designs
            colorChanged = true;
            //TEST TEXT DESIGN COLOR CHANGE
            color = newColor;
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
            /*if(canvas.getActiveGroup()){
              canvas.getActiveGroup().forEachObject(function(o){ canvas.remove(o) });
              canvas.discardActiveGroup().renderAll();
            } else {
              canvas.remove(canvas.getActiveObject());
            }*/
        }
        function setText(){
            text = document.getElementById('text').value;
        }
        function setColor(){
            color = document.getElementById('color').value;
        }
        function setStrokeColor(){
        strokeColor = document.getElementById('strokeColor').value;
        }
        function setFont(element){
            font = element.id;
        }
        //adding text
        function straight(){
            textAdded = true;
            removeItem();
            var txt = new fabric.Text(text,{
                fontFamily: font,
                stroke: strokeColor,
                left:50,
                top:50});
            txt.setColor(color); //this will set the color not just the stroke
            //DECIDING WHICH CANVAS TO ADD TOO
            switch (canvasCounter){
                case 1:
                    front.add(txt);
                    break
                case 2:
                    right.add(txt);
                    break;
                case 3:
                    back.add(txt);
                    break;
                default:
                    left.add(txt);
            }
        }

        //START CURVE CODE*******************************************************************************************************************************************************************
            function curve(){
                textAdded = true;
                //remove selected item to be replaced
                removeItem();
                //used to hold the text
                var headingText = []; 
                var startAngle = -58;
                var textLength = text.length;

                var r = text.length * 20;//sets distance between letters getTranslationDistance(text);
                var j = -1; // this will adjust the angle of the letters not the curve
                var angleInterval = 116/textLength; // arc length (full circle is 360/textlength)
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
                    letter.setColor(color);
                    headingText.push(letter);
                }
                //DECIDING WHICH CANVAS TO ADD TOO
                switch (canvasCounter){
                    case 1:
                        var group2 = new fabric.Group(headingText, { left: 0, top: front.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        front.add(group2);
                        break
                    case 2:
                        var group2 = new fabric.Group(headingText, { left: 0, top: right.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        right.add(group2);
                        break;
                    case 3:
                        var group2 = new fabric.Group(headingText, { left: 0, top: back.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        back.add(group2);
                        break;
                    default:
                        var group2 = new fabric.Group(headingText, { left: 0, top: left.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        left.add(group2);
                }
                
            }
        //END CURVE CODE*******************************************************************************************************************************************************************
        //START REVERSE CURVE CODE*******************************************************************************************************************************************************************
            function reverseCurve(){
                textAdded = true;
                //remove selected item to be replaced
                removeItem();
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
                    letter.setColor(color);
                    headingText.push(letter);
                    ltr++;
                }

                //DECIDING WHICH CANVAS TO ADD TOO
                switch (canvasCounter){
                    case 1:
                        var group2 = new fabric.Group(headingText, { left: 0, top: front.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        front.add(group2);
                        break
                    case 2:
                        var group2 = new fabric.Group(headingText, { left: 0, top: right.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        right.add(group2);
                        break;
                    case 3:
                        var group2 = new fabric.Group(headingText, { left: 0, top: back.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        back.add(group2);
                        break;
                    default:
                        var group2 = new fabric.Group(headingText, { left: 0, top: left.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        left.add(group2);
                }
            }
        //END  REVERSE CURVE CODE*******************************************************************************************************************************************************************
        //START CIRCLE CODE*******************************************************************************************************************************************************************
            function circle(){
                textAdded = true;
                //to keep first word and last word from touching
                text = text + " ";
                //remove selected item to be replaced
                removeItem();
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
                    letter.setColor(color);
                    headingText.push(letter);          
                }
                //DECIDING WHICH CANVAS TO ADD TOO
                switch (canvasCounter){
                    case 1:
                        var group2 = new fabric.Group(headingText, { left: 0, top: front.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        front.add(group2);
                        break
                    case 2:
                        var group2 = new fabric.Group(headingText, { left: 0, top: right.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        right.add(group2);
                        break;
                    case 3:
                        var group2 = new fabric.Group(headingText, { left: 0, top: back.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        back.add(group2);
                        break;
                    default:
                        var group2 = new fabric.Group(headingText, { left: 0, top: left.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        left.add(group2);
                }
                var group2 = new fabric.Group(headingText, { left: 0, top: canvas.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
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
              
                if (textAdded || clipArtAdded || imageUploaded  || colorChanged) 
                {
                    //this is to reset the variables that record changes 
                    textAdded = clipArtAdded = imageUploaded = colorChanged = false;
                    var data = [];
                    var frontdatalist = "";                         
                    frontdatalist += front.toDataURL('image/png');            
                    data.push(front);
                    var rightdatalist = "";             
                    rightdatalist += right.toDataURL('image/png');
                    data.push(right);
                    var backdatalist = "";            
                    backdatalist += back.toDataURL('image/png');
                    data.push(back);
                    var leftdatalist = "";            
                    leftdatalist += left.toDataURL('image/png');  
                    data.push(left);
                    var $general = frontdatalist;
                        $general += "*" + rightdatalist;
                        $general += "*" + backdatalist;
                        $general += "*" + leftdatalist;
                        if (additionalpictures.length > 1)
                         {
                            $general += additionalpictures;
                         }
                        
                   var jsonData = JSON.stringify(data);                         
                    $general += "*" + jsonData;  
                     var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {             
                      if (xhr.readyState == 4) {
                        alert('The desing "' + xhr.responseText + '" was save successful');  
                        var x = document.getElementById("mydesings");
                        var option = document.createElement("option");
                        option.text = xhr.responseText;
                        fileAddress = xhr.responseText;
                        getImage(fileAddress);
                        //alert(fileAddress);
                        x.add(option);               
                      }                         
                    };
                    xhr.open('POST','save_design.php',true);
                    xhr.setRequestHeader('Content-Type', 'application/upload');            
                    xhr.send($general);       
                }
            }
        </script>
    <!--END SAVE DESIGN SECTION-->

</body>
</html>;
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
                        front.add(group2);
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
                        right.add(group2);
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
                        back.add(group2);
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
                        left.add(group2);
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
                        front.add(group2);
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
                        right.add(group2);
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
                        back.add(group2);
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
                        left.add(group2);
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
                
                if (textAdded || clipArtAdded || imageUploaded  || colorChanged || addingToCart || rezided) 
                {              
                    front.deactivateAll();
                    front.renderAll();
                    right.deactivateAll();
                    right.renderAll();
                    back.deactivateAll();
                    back.renderAll();
                    left.deactivateAll();
                    left.renderAll();
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
                if(e.target.tpye == 'undefined' || e.target.type != 'text' && e.target.type != 'group' )
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
                    console.log("too wide! width : " + obj.getWidth());
                    e.target.set({ width: maxX, scaleX: 1 });
                } 
                if(obj.getHeight() > front.height){
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
                    if( obj.getWidth() > front.height){
                        if(e.target.type == 'text' || e.target.type == 'group' ) 
                        {
                            e.target.setFontSize(e.target.getFontSize()/2);
                        }
                        //obj.setWidth(maxX *2);
                        console.log("too wide! width : " + obj.getWidth());
                        e.target.set({ width: maxY, scaleX: 1 });
                    } 
                    if(obj.getHeight() > front.width){
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
        //this changes the image of the product the customer views
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

          if(quantity < 1)
          {
            document.getElementById("itemPriceLabel").style.visibility  = "hidden";
            document.getElementById('itemPrice').innerHTML = "";
          }
          else if( quantity == 1)
          {

            itemTotal = pricePerUnit;
            console.log("item total : " + itemTotal );
            document.getElementById("itemPriceLabel").style.visibility  = "visible";
            document.getElementById('itemPrice').innerHTML = "$" + itemTotal;
          }
          else
          {
            document.getElementById("itemPriceLabel").style.visibility  = "visible";
            itemTotal = (quantity) * pricePerUnit;
            console.log('itemTotal : ' + itemTotal);
            document.getElementById('itemPrice').innerHTML = "$" + itemTotal.toFixed(2);
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
        //the following 4 functions move objects selected in front of other objects
        /*front.on("object:selected", function(options) {
		    options.target.bringToFront();
		});
		right.on("object:selected", function(options) {
		    options.target.bringToFront();
		});
		back.on("object:selected", function(options) {
		    options.target.bringToFront();
		});
		left.on("object:selected", function(options) {
		    options.target.bringToFront();
		});*/
    </script>




<!--modal to be shown when user tries to leave the page-->
<div id="leaveModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Please don't leave me!</h4>
      </div>
      <div class="modal-body">
        <p>We can work this out...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">...stay</button>
      </div>
    </div>

  </div>
</div>


    <?php
    //super important code goes here!
    ?>
</body>
</html>
