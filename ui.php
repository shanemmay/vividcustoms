<?php
    include 'session.php';
 
?>
<html>
<head>
    <title>ui</title>
    <script src="fabric.min.js"></script>
    <script src="custom_controls.js"></script>
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
        textarea {
            resize: none;
        }
        span.line {
            display: inline-block;
            font-size: 10px;
        }
    </style>
    <!--CSS-->
    <!--<link rel="stylesheet" type="text/css" href="css/main.css">
    to replace style tags on this page-->
    <link rel="stylesheet" type="text/css" href="css/style.css">    
</head>
<body>
<button id="totalPriceBtn" class="btn btn-success btn-lg" style="display: none; position: fixed; top: 0; right: 0;"  data-toggle="modal" data-target="#productPicker" onclick="setDesign();" >price</button>
<p id="testingCart">.</p>
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
                        var designs = [];  //to save the latest designs
                        //to hold the address of the most recent design save
                        var designArray = [];
                        var designArrayIndex = 0;
                        var addingToCart = false;   //this keeps track of whether or not we should add the item to cart
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
                  echo  '<b><a href = "logout.php">Sign Out</a></b>';    
              }  
              else if (isset($_SESSION['Guest'])) 
              {
                  echo ("<left> Order number: ".$_SESSION['Guest']."</left>");             
              }          
          ?>
          </div>
        </div> 
    </div>
 <div class="card-block">
    <div class="row">
        <!--START SIDE BAR-->
        <div class="col-sm-1">   
            <style type="text/css">
            </style>
            <ul class="nav nav-tabs nav-stacked" style="height: 90%;">
                <li class="active" ><a  data-toggle="tab" href="#addArt">Add Art <span style="visibility: hidden;">equal</span></a></li> 
                <li ><a  data-toggle="tab" href="#textSection">Text Design</a></li>
                <li ><a  data-toggle="tab" href="#productSection">Change Product</a></li>
                <li data-toggle="modal" data-target="#productPicker" onclick="setDesign(); calcPrice();" ><a  data-toggle="tab" href="#priceSection" ><span  >Get Price<span style="visibility: hidden;">spacing</span></span></a></li>
                <!--<li ><a  data-toggle="tab" href="#shareSection" onclick="share();">Share</a></li>-->
                <li ><a   data-toggle="tab" href="#saveSection" onclick="share();">Save &amp; Share</a></li>
            </ul>
        </div>
        <!--END  SIDE BAR-->
        <!--START TAB CONTENT-->
        <div class="col-sm-4" style="height: 90%;">
            <div class="tab-content" >
                <div id="addArt" class="tab-pane fade in active">
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
                    <img class="hover" src="img/clip_1.png" width="64" height="64" onclick="addImg(this);">
                    <img class="hover" src="img/watchdogs.png" width="64" height="64" onclick="addImg(this);">
                    <img class="hover" src="img/clip_4.png" width="64" height="64" onclick="addImg(this);">
                    <img class="hover" src="img/trash_icon.png" width="64" height="64" onclick="addImg(this);">
                    
                    <!--CLIP ART CATEGORIES-->
                    <div id="clipArtCategories">
                        <!--menu for customers to go back if they wish-->
                        <!--WILL USE THIS IF BREADCRUMBS DON'T WORK<div class="row"><div class="col-sm-1"></div><div class="col-sm-1"></div><div class="col-sm-10"></div></div>-->
                        <ol class="breadcrumb" id="breadcrumb"><li class="active" id="categories">Categories</li><li id="subcategories" style="display: none;"></li><li id="clips"  style="display: none;"></li></ol>
                        <style type="text/css">
                            #clipArtTable{
                                width: 100%;
                            }
                            #clipArtTable td{
                                padding: 10px;
                            }                            
                        </style>
                        <table id="clipArtTable" >
                            <tr class="clipArtRow">
                                <td class="clipArtCell">
                                    <img art-image="" src="img/productview_58be2f3f61f33.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Animals</a>
                                </td>
                                <td class="clipArtCell">
                                    <img art-image="" src="img/productview_58be2f3048a4e.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Food</a>                                    
                                </td>
                            </tr>
                            <tr>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58be2f4c8f8a7.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Shapes</a>                                
                                </td>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58be435564527.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Holidays</a>                                
                                </td>
                            </tr>
                            <tr>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58bf0061cd6aa.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Music</a>                                
                                </td>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58bf4ca4c04b7.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">People</a>                                
                                </td>
                            </tr>
                            <tr>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58bf51402ff52.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Nature</a>                                
                                </td>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58bf517bbb709.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Religion</a>                                
                                </td>
                            </tr>
                            <tr>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58bf4bc579119.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Sports</a>                                
                                </td>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58bf5745d1fbc.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Events</a>                                
                                </td>
                            </tr>
                            <tr>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58befd670f704.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">School</a>
                                
                                </td>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58bf5ebfc01ab.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Transportation</a>
                                
                                </td>
                            </tr>
                            <tr>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58be2f3f61f34.png" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Military</a>                                
                                </td>
                                 <td class="clipArtCell">
                                 <img art-image="" src="img/productview_58be2f3f61f35.jpg" width="50" height="50">
                                    <a onclick="setCategory(this.innerHTML);">Emojis</a>                                
                                </td>
                            </tr>
                        </table>
                    </div>
                    <script type="text/javascript">
                        var div = document.getElementById('clipArtCategories');
                        var category = "";
                            
 
                        var categories = document.getElementById('categories');
                        
                        var subcategories = document.getElementById('subcategories');
                        var clips = document.getElementById('clips');
 
                        subcategories.onclick = function(){
                            //hiding clips
                            clips.style.display = "none";
                            //making subcategories "active"
                            categories.classList.remove("active");
                            subcategories.classList.add("active");
                        }
                        categories.onclick = function(){
                            //TODO hide whatever is currently showing
                            //showing table
                            var table = document.getElementById('clipArtTable');
                            table.style.display = "block";
                            table.setAttribute('width','100%');
                            //getting ride of other crumbs in the breadcrumb list
                            subcategories.style.display = "none";
                            clips.style.display = "none";
                            //making the categories tab have the 'active' class
                            categories.classList.add("active");
                        }
                        function setCategory(element){
                            //setting the category
                            category = element;
                            //hiding table
                            var table = document.getElementById('clipArtTable');
                            table.style.display = "none";
                            //making the subcategories visible and 'active'
                            subcategories.style.display = "inline"; 
                                                        subcategories.innerHTML = element; 
                            clips.style.display = "none";
                            //making the subcategories tab have the 'active' class
                            categories.classList.remove("active");
                            subcategories.classList.add("active");
                            
                        }                    
                        </script>
                    <!--END CLIP ART SECTION-->
                    </div>
                     <!--START MODIFY ART SECTION-->
                    <div id="editArt" style="display: none;">                    
                      <h2>Add Art</h2>
                      <p>Seccion Edit Art</p>
                      <div class="panel-group">
                        <div class="panel panel-default">
                          <div class="panel-heading">Size & Effect</div>
                          <div class="panel-body">
                             <!--resize clip art form-->
                                 <form>                      
                                  <div class="input-group">
                                    <span class="input-group-addon">Width</span>
                                    <input id="widthImage" type="number" class="form-control" name="widthImage"  maxlength="5" onkeypress="return resize(event);">
                                    <span class="input-group-addon">Height</span>
                                    <input id="heightImage" type="number" class="form-control" name="heightImage" onkeypress="return resize(event);">
                                    <span class="input-group-addon">Rotate</span>
                                    <input id="angleImage" type="number" class="form-control" name="angleImage" onkeypress="return rotate(event);">
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
                                  
                </div>
                <!--END MODIFY ART SECTION-->  
                <!--START TEXT DESIGN SECTION-->
                <div id="textSection" class="tab-pane fade">

                     <h3>ADD TEXT</h3>                      
                      <div class="panel-group">
                        <div class="panel panel-default">
                          <div class="panel-heading">Text Secction</div>
                          <div class="panel-body">
                            <textarea rows="3" class="form-control" id="text" type="text" onkeypress="return addText(event);" placeholder="Enter text"></textarea><!--was taken out of onchange setText();-->
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading">Change Color</div>
                          <div class="panel-body"> 
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
                          <div class="panel-heading">Styles</div>
                          <div class="panel-body">
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
                                                    <a href="#"><div class="col-sm-3"><h3 id="bully" onclick="setFont(this);">Bully Style</h3></div></a>
                                                    <a href="#"><div class="col-sm-3"><h3 id="PokemonHollow" onclick="setFont(this);">Gotta Catch</h3></div></a>
                                                    <a href="#"><div class="col-sm-3"><h3 id="PokemonSolid" onclick="setFont(this);">Them All!</h3></div></a>
                                                    <a href="#"><div class="col-sm-3"><h3 id="jelly" onclick="setFont(this);">Jellyfi Text</h3></div></a>
                                                </div>
                                                <div class="row">
                                                    <a href="#"><div class="col-sm-3"><h3 id="angry" onclick="setFont(this);">Angry Birds!</h3></div></a>
                                                    <a href="#"><div class="col-sm-3"><h3 id="tmnt" onclick="setFont(this);">Turtle Power!</h3></div></a>
                                                    <a href="#"><div class="col-sm-3"><h3 id="db" onclick="setFont(this);">Make a Wish</h3></div></a>
                                                    <a href="#"><div class="col-sm-3"><h3 id="dbz" onclick="setFont(this);">But be careful</h3></div></a>
                                                </div>
                                                <div class="row">
                                                    <a href="#"><div class="col-sm-3"><h3 id="spongebob" onclick="setFont(this);">Lives Under The Sea!</h3></div></a>
                                                    <a href="#"><div class="col-sm-3"><h3 id="tmnt" onclick="setFont(this);">Turtle Power!</h3></div></a>
                                                    <a href="#"><div class="col-sm-3"><h3 id="db" onclick="setFont(this);">Make a Wish</h3></div></a>
                                                    <a href="#"><div class="col-sm-3"><h3 id="dbz" onclick="setFont(this);">But be careful</h3></div></a>
                                                </div>
                                            </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--END FONTS MODAL-->
                            <input class="btn btn-primary" type="button" value="Normal" onclick="straight();">
                            <input class="btn btn-primary" type="button" value="Circle" onclick="circle();">
                            <input class="btn btn-primary" type="button" value="Bridge" onclick="reverseCurve();">
                            <input class="btn btn-primary" type="button" value="Valley" onclick="curve();">
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading">Size & Effect</div>
                          <div class="panel-body">
                             <div class="input-group">                           
                                <span class="input-group-addon">Font Size</span>
                                <input id="sizeText" type="number" class="form-control" name="sizeText"  min="1" max="2" onkeypress="return resize(event);">
                                <span class="input-group-addon">Rotate</span>
                                <input id="angleText" type="number" class="form-control" name="angleText" onkeypress="return rotate(event);">
                            </div>
                          </div>
                        </div>                       
                      </div>  
                       </div>                   
                <!--END TEXT DESIGN SECTION-->
                <div id="productSection" class="tab-pane fade">
                    <h3>SWAP ITEM</h3>
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
                <div id="priceSection" class="tab-pane fade"> 
                    <!--CHANGE QUANTITY-->
                    <!--COMMENTED OUT BECAUSE THIS IS NO LONGER HOW WE SET QUANTITY! TODO DELETE THIS<input class="form-control" id="quantity" type="number" placeholder="Enter quantity" onchange="setQuantity(this.value); showPrice();">-->
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
                        #productsTable td{
                            width: 25%;
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
                          <h4 class="modal-title">Add Products and Styles</h4>
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
                              <div class="col-sm-6">
               
                                  <table class="table" id="productsTable">
                                    <tr>
                                        <td><img src="img/classic_fit_adult_t-ash_grey_front.jpg" onclick="setProductPreview(this);"> V Neck </td>
                                        <td><img src="img/classic_fit_adult_t-azalea_front.jpg" onclick="setProductPreview(this);"> Polo</td>
                                        <td><img src="img/classic_fit_adult_t-cardinal_red_front.jpg" onclick="setProductPreview(this);"> Long Sleeve</td>
                                        <td><img src="img/classic_fit_adult_t-charcoal_front.jpg" onclick="setProductPreview(this);"> Short Sleeve</td>
                                    </tr>
                                  </table>
                                  <!--showing price per design TODO DELETE THIS AND PUT IT IN HIDDEN INPUT FOR CHECKOUT-->
                                  <p>Design Price:<p id="pricePerUnit"></p></p>
                                  
                                  <script type="text/javascript">
                                    
                                      /*var priceLabel = document.getElementById('pricePerUnit');
                                      var totalLabel = document.getElementById('totalPrice');
                                      priceLabel.innerHTML = pricePerUnit + " : ";
                                      totalLabel.innerHTML = totalPrice + " : ";*/
                                  </script>

                              </div>
                            </div>
                            <!--SIZE SELECTION-->
                            <form id="sizeForm">
                                 <input min="0" id="yxs" type="number" name="yxs" placeholder="yxs"> 
                                 <input min="0" id="ys" type="number" name="ys" placeholder="ys"> 
                                 <input min="0" id="ym" type="number" name="ym" placeholder="ym"> 
                                 <input min="0" id="yl" type="number" name="yl" placeholder="yl"> 
                                 <input min="0" id="yxl" type="number" name="yxl" placeholder="yxl">    
                                 <input min="0" id="s" type="number" name="s" placeholder="s"> 
                                 <input min="0" id="m" type="number" name="m" placeholder="m"> 
                                 <input min="0" id="l" type="number" name="l" placeholder="l"> 
                                 <input min="0" id="xl" type="number" name="xl" placeholder="xl"> 
                                 <input min="0" id="xxl" type="number" name="xxl" placeholder="xxl"> 
                                 <input min="0" id="xxxl" type="number" name="xxxl" placeholder="xxxl"> 
                                 <input min="0" id="xxxxl" type="number" name="xxxxl" placeholder="xxxxl"> 
                                 <input min="0" id="xxxxxl" type="number" name="xxxxxl" placeholder="xxxxxl"> 
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="addingToCart = true; uploadEx(); calcPrice();">Get Price</button>
                        </div>
                      </div>
                    </div>
                    </div>
                    
 
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
                        <form action="checkout.php" method="post">
                            <table class="table" id="cart" style="width: 100% !important;">
                                
                            </table>
                            <!-- Trigger the modal with a button -->
                            <button id="productPickerBtn" type="button" class="btn btn-info" data-toggle="modal" data-target="#productPicker" >Add Products</button> <!-- taken out of the button onclick="setDesign();" -->
                            <h3 id="cartTotal"></h3>
                            <input id="total" type="hidden" name="total">
                            <?php 
                                 $ses_sql = mysqli_query($db,"Select Quantity From consecutive where Name = 'Order'");     
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
                                echo('<input id="ordernumber" type="hidden" name="ordernumber" value = '.$ordernumber.'>');
                             ?>
                            
                            <button type="submit" id="checkoutBtn"  class="btn btn-success" style="display: none;">Check Out</button><!-- taken out of button  data-toggle="modal" data-target="#cartModal" onclick="getCheckoutCart();"-->
                        </form>
                        <!--CART MODAL-->
                        <div id="cartModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="checkout.php" method="post">
                                            <table id="checkoutCart" class="table">
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                           
                                    </div>
                                    <span>Order Total:<span id="finalTotal" style="display: block;"></span></span>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Check Out</button>
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
                                cell3.innerHTML = "<h6 class='total"+rowNum+"'>$"+itemPrice+"</h6>";
                                cell4.innerHTML = "<button  type='button' class='btn btn-danger' onclick='removeFromCart(this);';>X</button>";
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
                                
                            }/* COMMENTED OUT BECAUSE THERE IS AN ERROR IN HERE
                            function getCheckoutCart(){
                                emptyTable();
 
                                for (var i = 0; i < designArray.length; i += 5) {
                                    document.getElementById('testingCart').innerHTML += i + " | | " + designArray[i] + " |<br>| " + designArray[i+1] + " |<br>| " + designArray[i+2] + " |<br>| " + designArray[i+3] + " |<br>| " + designArray[i+4] + "|| <br>";
                                }
 
                              
                                var tempTotal = 0.0;
                                var checkoutCart = document.getElementById('checkoutCart');
                                for (var i = 0; i < cart.length ; i++) {
                                    //document.getElementById('testingCart').innerHTML += i + " | | " + designArray[i] + " |\n<br>| " + designArray[i+1] + " |\n<br>| " + designArray[i+2] + " |\n<br>| " + designArray[i+3] + " |\n<br>| " + designArray[i+4] + "|\n<br>|";
                                    //document.getElementById('testingCart').innerHTML += i + " start <br>";
                                    var row = checkoutCart.insertRow(i);
                                    var cell0 = row.insertCell(0);
                                    var cell1 = row.insertCell(1);
                                    var cell2 = row.insertCell(2);
                                    var cell3 = row.insertCell(3);
                                    var cell4 = row.insertCell(4);
                                    var cell5 = row.insertCell(5);
                                    var cell6 = row.insertCell(6);  //folderName
                                    var cell7 = row.insertCell(7);  //front design
                                    var cell8 = row.insertCell(8);  //right design
                                    var cell9 = row.insertCell(9);  //back design
                                    var cell10 = row.insertCell(10);    //left design
                                    cell0.innerHTML = cart[i].cell0;
                                    cell1.innerHTML = cart[i].cell1;
                                    cell2.innerHTML = cart[i].cell2;
                                    cell3.innerHTML = cart[i].cell3;
                                    //cell4.innerHTML = cart[i].cell4;
                                    cell5.innerHTML = cart[i].cell5;
                                    cell6.innerHTML = cart[i].cell6;
                                    cell7.innerHTML = cart[i].cell7;
                                    cell8.innerHTML = cart[i].cell8;
                                    cell9.innerHTML = cart[i].cell9;
                                    cell10.innerHTML = cart[i].cell10;
                                    cell0.style.height="110px";
                                    tempTotal += cart[i].total;
                                    //document.getElementById('testingCart').innerHTML += i +" <br>" +" <br>";
                                    //document.getElementById('testingCart').innerHTML += "tempTotal : " + tempTotal + "|| cart[i].total : " + cart[i].total;
                                }
 
                                document.getElementById('finalTotal').innerHTML = '$' + tempTotal;
                                document.getElementById('finalTotal').style.display = "block";
                            function removeFromCart(element){
                                //remove from table
                                var row = element.parentNode.parentNode;
                                row.parentNode.removeChild(row);
                                
                                cart.splice(rowNum - 1,1);
                                designArray.splice(rowNum - 1,5);
                                
                                rowNum--;
                                getCartTotal();
                            }*/
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
                                var totalPriceBtn = document.getElementById('totalPriceBtn');
                                var finalTotal = document.getElementById('finalTotal');
                                if(total != "Error" && total > 0){
                                    cartTotal.style.display = "block";
                                    checkoutBtn.style.display = "block";
                                    cartTotal.innerHTML = "Total: $" + total;
                                    document.getElementById('total').value = total; //setting hidden input for post
                                    totalPriceBtn.style.display = "block";
                                    totalPriceBtn.innerHTML = "$" + total;
                                    //finalTotal.style.display = "block";
                                    //finalTotal.innerHTML = "$"  + total;
                                }else{
                                    cartTotal.style.display = "none";
                                    document.getElementById('total').value = 0.0;   //setting hidden input for post
                                    totalPriceBtn.style.display = "none";
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
                    <h3>Look at your previous designs!</h3> 
                    <?php                                  
                        echo('<select id="mydesings" name="mydesings" onChange="loadImages();">');                      
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
 
                       function loadImages()
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
 
                            //showing the most recent saved design with the most recent product in preperation to be shared
                            shareDesignsDiv.style.display = "block";
 
                            
                        }
                    </script>
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
                <style type="text/css">
                    /*@media (min-width:481px) and (max-width:767px) { }
                    @media (max-width:480px) { }
                    @media (max-width:767px) { }
                    @media (max-width:1224px) { }
                    @media (min-width:768px) and (max-width:1199px) {  }
                    @media (min-width:1900px) {  }
                    @media (min-width:1200px) {  }
                    @media (min-width:768px) and (max-width:1199px) and (-webkit-min-device-pixel-ratio:1.5),(min--moz-device-pixel-ratio:1.5),(-o-min-device-pixel-ratio:3/2),(min-device-pixel-ratio:1.5) { }
                    @media (min-width:768px) and (max-width:1199px) and (-webkit-min-device-pixel-ratio:1.5),(min--moz-device-pixel-ratio:1.5),(-o-min-device-pixel-ratio:3/2),(min-device-pixel-ratio:1.5) { }
                    @media (max-width:480px) and (-webkit-min-device-pixel-ratio:1.5),(min--moz-device-pixel-ratio:1.5),(-o-min-device-pixel-ratio:3/2),(min-device-pixel-ratio:1.5) {  }
                    @media (max-width:767px) and (-webkit-min-device-pixel-ratio:1.5),(min--moz-device-pixel-ratio:1.5),(-o-min-device-pixel-ratio:3/2),(min-device-pixel-ratio:1.5) {  }
                    @media (max-width:727px) { }
                    @media (min-width:1500px) {  }
                    @media (min-width:768px) and (max-width:1199px) {  }
                    @media (min-width:768px) and (max-width:1095px),(max-width:767px) { }
                    @media (min-width:768px) and (max-width:1095px) { }
                    @media (min-width:481px) and (max-width:767px) {  }
                    @media only screen and (max-width:985px) { }
                    @media (max-width:985px) {}
                    @media (min-width:1900px) {}*/
                </style>
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
        <!-- Modal -->
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
            mb: false,
            mt: false
        } );
        fabric.Canvas.prototype.customiseControls({
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
            canvas.renderAll();
        } );
        
        fabric.Object.prototype.customiseCornerIcons({
            settings: {
                borderColor: 'black',
                cornerSize: 25,
                cornerShape: 'rect',
                cornerBackgroundColor: 'black',
                cornerPadding: 10
            },
            tl: {
                icon: 'icons/rotate.svg'
            },
            tr: {
                icon: 'icons/resize.svg'
            },
            bl: {
                icon: 'icons/remove.svg'
            },
            br: {
                icon: 'icons/up.svg'
            }/*,
            mb: {
                icon: 'icons/down.svg'
            }*/
        }, function() {
            canvas.renderAll();
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
            document.getElementById('pricePerUnit').innerHTML = pricePerUnit;
            
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
                        left: 100,
                        top: 100,
                        scaleX: 0.5,
                        scaleY: 0.5,
                        originX: 'center',
                        originY: 'center',
                        hasRotatingPoint: false,                        
                    });
                    // overwrite the prototype object based
                    img.customiseCornerIcons({
                        settings: {
                            borderColor: 'black',
                            cornerSize: 20,
                            cornerShape: 'circle',
                            cornerBackgroundColor: 'black',
                            cornerPadding: 10,
                        },
                        tl: {
                            icon: 'img/remove.svg', //icons/rotate.svg
                        },
                        tr: {
                            icon: 'img/rotate.svg', //icons/resize.svg
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
                            borderColor: 'black',
                            cornerSize: 20,
                            cornerShape: 'circle',
                            cornerBackgroundColor: 'black',
                            cornerPadding: 10,
                        },
                        tl: {
                            icon: 'img/remove.svg', //icons/rotate.svg
                        },
                        tr: {
                            icon: 'img/rotate.svg', //icons/resize.svg
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
                            front.add(img);
                            //front.setActiveObject(img);
                            break
                        case 2:
                            right.add(img);
                            //right.setActiveObject(img);
                            break;
                        case 3:
                            back.add(img);
                            //back.setActiveObject(img);
                            break;
                        default:
                            left.add(img);
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

            if (type =="c")
             {
                strokeColor = newColor;
                object.setStroke(strokeColor);
             }
             else
             {
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

        function addText(e) {
            if (e.keyCode == 13) {
                 text = document.getElementById('text').value;
                 var tempText = "";
                 if (text.length > 18)
                 {
                    
                    for (var i = 0; i < text.length; i++) 
                    {
                        var mod = (i+1) % 18;
                        if (mod == 0) 
                        {
                            tempText+=text[i] + "\n"; 
                        }
                        else
                        {
                             tempText+=text[i];
                        }                        
                    }
                     text= tempText;

                 }                 
                 straight();                
                return false;
            }
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
            txt.setColor(colorText); //this will set the color not just the stroke
            
            txt.set({
                        id: objId,
                        hasRotatingPoint: false                       
                    });
            objId++;
            txt.customiseCornerIcons({
                settings: {
                    borderColor: 'black',
                    cornerSize: 20,
                    cornerShape: 'circle',
                    cornerBackgroundColor: 'black',
                    cornerPadding: 10,
                },
                tl: {
                    icon: 'img/remove.svg', //icons/rotate.svg
                },
                tr: {
                    icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: front.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor, angle: -3});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: right.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: back.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: left.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                    letter.setColor(colorText);
                    headingText.push(letter);
                    ltr++;
                }
 
                //DECIDING WHICH CANVAS TO ADD TOO
                switch (canvasCounter){
                    case 1:
                        var group2 = new fabric.Group(headingText, { left: 0, top: front.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: right.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: back.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: left.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                    letter.setColor(colorText);
                    headingText.push(letter);          
                }
                //DECIDING WHICH CANVAS TO ADD TOO
                switch (canvasCounter){
                    case 1:
                        var group2 = new fabric.Group(headingText, { left: 0, top: front.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: right.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: back.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
                        var group2 = new fabric.Group(headingText, { left: 0, top: left.height/2 , fontFamily: font,  strokeWidth: 1, strokeStyle:"#fff",stroke: strokeColor});
                        group2.set({  id: objId, hasRotatingPoint: false}); objId++;
                        group2.customiseCornerIcons({
                            settings: {
                                borderColor: 'black',
                                cornerSize: 20,
                                cornerShape: 'circle',
                                cornerBackgroundColor: 'black',
                                cornerPadding: 10,
                            },
                            tl: {
                                icon: 'img/remove.svg', //icons/rotate.svg
                            },
                            tr: {
                                icon: 'img/rotate.svg', //icons/resize.svg
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
 
                if (textAdded || clipArtAdded || imageUploaded  || colorChanged || addingToCart) 
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
                     
                        if(addingToCart){
                            addingToCart = false;
                      
                            getImage(fileAddress);
                           
                            addToCart();
                        }      
                    };
                    xhr.send($general);
                    //$('#mProgressBarModal').modal('hide');
 
                }
            }
 
            function resize(e)
            {
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
                        case 'sizeText':
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
                            var widthImage = Number(document.getElementById('widthImage').value);
                            object.setWidth(widthImage);                             
                            break;
                         case 'heightImage':
                             var heightImage = Number(document.getElementById('heightImage').value);
                             object.setHeight(heightImage);
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
                 }
                 
                else if (e.target.type == 'image') {
                    $('.nav-tabs a[href="#addArt"]').tab('show');  
                     document.getElementById("widthImage").value = modifiedObject.getWidth();
                    document.getElementById("heightImage").value = modifiedObject.getHeight();
                    document.getElementById("angleImage").value = modifiedObject.getAngle();
                    editArt.style.display = 'block';                  
                    newArt.style.display = 'none';  
                             
                }  
                else if(e.target.type == 'text' || e.target.type == 'group' ) 
                {
                    $('.nav-tabs a[href="#textSection"]').tab('show');     
                     document.getElementById("sizeText").value = modifiedObject.getFontSize(); 
                     document.getElementById("angleText").value = modifiedObject.getAngle();
                               
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
                 }
                 
                else if (e.target.type == 'image') {
                    $('.nav-tabs a[href="#addArt"]').tab('show');  
                     document.getElementById("widthImage").value = modifiedObject.getWidth();
                    document.getElementById("heightImage").value = modifiedObject.getHeight();
                    document.getElementById("angleImage").value = modifiedObject.getAngle();
                    editArt.style.display = 'block';                  
                    newArt.style.display = 'none';  
                             
                }  
                else if(e.target.type == 'text' || e.target.type == 'group' ) 
                {
                    $('.nav-tabs a[href="#textSection"]').tab('show');     
                     document.getElementById("sizeText").value = modifiedObject.getFontSize(); 
                     document.getElementById("angleText").value = modifiedObject.getAngle();
                               
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
                 }
                 
                else if (e.target.type == 'image') {
                    $('.nav-tabs a[href="#addArt"]').tab('show');  
                     document.getElementById("widthImage").value = modifiedObject.getWidth();
                    document.getElementById("heightImage").value = modifiedObject.getHeight();
                    document.getElementById("angleImage").value = modifiedObject.getAngle();
                    editArt.style.display = 'block';                  
                    newArt.style.display = 'none';  
                             
                }  
                else if(e.target.type == 'text' || e.target.type == 'group' ) 
                {
                    $('.nav-tabs a[href="#textSection"]').tab('show');     
                     document.getElementById("sizeText").value = modifiedObject.getFontSize(); 
                     document.getElementById("angleText").value = modifiedObject.getAngle();
                               
                }
            });

            left.on('mouse:up', function(e) 
            {
                var modifiedObject = e.target;
                var editArt = document.getElementById("editArt");                        
                var newArt = document.getElementById("newArt");
              if (typeof(e.target) == "undefined")
                 {                 
                     var newArt = document.getElementById("newArt");
                     var editArt = document.getElementById("editArt");
                     newArt.style.display = 'block';
                     editArt.style.display = 'none';                    
                 }
                 
                else if (e.target.type == 'image') {
                    $('.nav-tabs a[href="#addArt"]').tab('show');  
                     document.getElementById("widthImage").value = modifiedObject.getWidth();
                    document.getElementById("heightImage").value = modifiedObject.getHeight();
                    document.getElementById("angleImage").value = modifiedObject.getAngle();
                    editArt.style.display = 'block';                  
                    newArt.style.display = 'none';  
                             
                }  
                else if(e.target.type == 'text' || e.target.type == 'group' ) 
                {
                    $('.nav-tabs a[href="#textSection"]').tab('show');     
                     document.getElementById("sizeText").value = modifiedObject.getFontSize(); 
                     document.getElementById("angleText").value = modifiedObject.getAngle();
                               
                }
            });
          
    </script> 
    <!--END SAVE DESIGN SECTION-->
    <script type="text/javascript">
        var productPreview = document.getElementById('productPreview');
        var designPreview = document.getElementById('designPreview');
 
        function setDesign(){
            front.deactivateAll().renderAll();
            designPreview.src = front.toDataURL();
        }
        //setDesign();
        function setProductPreview(element){
            productPreview.style.backgroundImage = "url('"+element.src+"')";
        }
    </script>
    <?php
    //super important code goes here!
    ?>
</body>
</html>
