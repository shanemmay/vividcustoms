<?php
   include('session.php');
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Design Mobile</title>
  <script src="fabric.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/fonts.css">

  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

  <style type="text/css">


/* 
Smaller than standard 960 (devices and browsers) 
@media only screen and (max-width: 959px) {
  .carousel-slide{
      width: 250px;
      height: 300px
    }

}

 Tablet Portrait size to standard 960 (devices and browsers) 
@media only screen and (min-width: 768px) and (max-width: 959px) {
  .carousel-slide{
      width: 250px;
      height: 300px
    }

}*/

/*All Mobile Sizes (devices and browser) 
@media only screen and (max-width: 767px) {
  body{font-size: 8px;}
}*/

/*Mobile Landscape Size to Tablet Portrait (devices and browsers) 
@media only screen and (min-width: 480px) and (max-width: 767px) {
     body{font-size: 8px;}

}*/

/*Mobile Portrait Size to Mobile Landscape Size (devices and browsers)
@media only screen and (max-width: 768px) {
  .carousel-slide{
      width: 250px;
      height: 300px
    }
  } */


.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}

}

</style>  
</head>
<body>

 
<div class="d-flex flex-row justify-content-center" backgroundcolor="blue" >  
  <div class="p-2"><button type="button" class="btn btn-sm btn btn-secondary" data-toggle="modal" data-target="#Price">Get Price</button></div>  
  <!-- The modal Get Price -->
    <div class="modal fade" id="Price" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modalLabel">Get Price</h4>
          </div>
          <div class="modal-body">
              Contents
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  <div class="p-2"><button type="button" class="btn btn-sm btn btn-secondary" data-toggle="modal" data-target="#Save" onclick="uploadEx();">Save & Share</button></div>  
  <!-- The modal Save and Share -->
    <div class="modal fade" id="Save" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modalLabel">Save & Share</h4>
          </div>
          <div class="modal-body">
              <h6>Look at your previous designs!</h6> 
	            <?php                                  
	                echo('<select id="mydesings" name="mydesings" onChange="LoadImages();">');                      
	                echo ('<option value="0">Select the desing</option>');     
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
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="frontSavePreview" src="" onclick="LoadDesings();">
                             </div> 
                        </td>
                        <td>
                             <div id="rightSavedDesing" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="rightSavePreview" src=""  onclick="LoadDesings();">
                             </div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                             <div id="backSavedDesing" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="backSavePreview" src=""  onclick="LoadDesings();">
                             </div> 
                        </td>
                        <td>
                             <div id="leftSavedDesing" style="margin: auto; width: 87px; height: 81px; background-size: cover; background-position: center center;">
                               <img style="display: block; margin: auto; width: 60%; height: 80%; position: relative; top: 10% " id="leftSavePreview" src=""  onclick="LoadDesings();">
                             </div>
                        </td>
                        </tr>
                        </tbody>
                        </table>
                    </div>     

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
     <div class="p-2"><button type="button" class="btn btn-sm btn btn-secondary" onclick="removeItem();">Remove</button></div>  
</div>
<div id="myCarousel" class="carousel slide container bg-inverse" data-ride="carousel" data-interval="false">

        <ol class="carousel-indicators">
          <li id="frontActive" data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li id="rightActive" data-target="#myCarousel" data-slide-to="1"></li>
          <li id="backActive" data-target="#myCarousel" data-slide-to="2"></li>
          <li id="leftActive" data-target="#myCarousel" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active" id="test">
              <div class="container">
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
                  <div id="canvas-wrapper"><canvas id="frontCanvas" width="315" height="409"></canvas></div>
               </div>
             </div>
            <div class="carousel-caption">
               <h3>Front</h3>
               <p>Preview Front Design.</p>
            </div>
          </div>
          <div class="carousel-item">
           <div class="container">
            <div class="canvasShirt" id="rightCanvasShirt" >
                <div id="canvas-wrapper"><canvas id="rightCanvas"  width="315" height="409"></canvas></div>
            </div>
             </div>
              <div class="carousel-caption">
                <h3>Rigth</h3>
                <p>Preview Rigth Design.</p>
              </div>
          </div>
          <div class="carousel-item">
           <div class="container">
            <div class="canvasShirt" id="backCanvasShirt">
                <div id="canvas-wrapper"><canvas id="backCanvas"  width="315" height="409"></canvas></div>
            </div>
             </div>
              <div class="carousel-caption">
                <h3>Back</h3>
                <p>Preview Back Design.</p>
              </div>
          </div>
          <div class="carousel-item">
           <div class="container">
             <div class="canvasShirt" id="leftCanvasShirt">
                <div id="canvas-wrapper"><canvas id="leftCanvas"  width="315" height="409"></canvas></div>
            </div>
             </div>
              <div class="carousel-caption">
                <h3>Left</h3>
                <p>Preview Left Design.</p>
              </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev" onclick="setCanvas('previous');">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next" onclick="setCanvas('next');">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
<div class="d-flex flex-row justify-content-center" backgroundcolor="blue" >
   <div class="p-2"><button type="button" class="btn btn-sm btn btn-secondary" data-toggle="modal" data-target="#Art">Add Art</button></div>  
   <!-- The modal Add Art -->
    <div class="modal fade" id="Art" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modalLabel">Add Art</h4>
          </div>
          <div class="modal-body">
             <div class="container">
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Upload Image</label>
                      <div class="input-group">
                          <span class="input-group-btn">
                              <span class="btn btn-default btn-file">
                                  Browse… <input type="file" id="imgUpload" onchange="uploadImage();">                                 
                              </span>
                          </span>
                          <input type="text" class="form-control" readonly>
                      </div>
                      <img id='img-upload'/>
                  </div>
                   <label>Browse The Flip Shop Gallery</label>

                    <img class="hover" src="img/clip_4.png" width="64" height="64" onclick="addImg(this);">
                    <img class="hover" src="img/watchdogs.png" width="64" height="64" onclick="addImg(this);">
                    <img class="hover" src="img/clip_1.png" width="64" height="64" onclick="addImg(this);"> 
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
                    <br><br>
                    <div id="colorRow"></div>
                    <script type="text/javascript">
                     (function($) {
                          "use strict";
                      var aaColor = [
                            ['#000000', '#424242', '#636363', '#9C9C94', '#CEC6CE', '#EFEFEF', '#F7F7F7', '#FFFFFF'],
                            ['#FF0000', '#FF9C00', '#FFFF00', '#00FF00', '#00FFFF', '#0000FF', '#9C00FF', '#FF00FF'],
                            ['#F7C6CE', '#FFE7CE', '#FFEFC6', '#D6EFD6', '#CEDEE7', '#CEE7F7', '#D6D6E7', '#E7D6DE'],
                            ['#E79C9C', '#FFC69C', '#FFE79C', '#B5D6A5', '#A5C6CE', '#9CC6EF', '#B5A5D6', '#D6A5BD'],
                            ['#E76363', '#F7AD6B', '#FFD663', '#94BD7B', '#73A5AD', '#6BADDE', '#8C7BC6', '#C67BA5'],
                            ['#CE0000', '#E79439', '#EFC631', '#6BA54A', '#4A7B8C', '#3984C6', '#634AA5', '#A54A7B'],
                            ['#9C0000', '#B56308', '#BD9400', '#397B21', '#104A5A', '#085294', '#311873', '#731842'],
                            ['#630000', '#7B3900', '#846300', '#295218', '#083139', '#003163', '#21104A', '#4A1031']
                          ];

                          var createPaletteElement = function(element, _aaColor) {
                            element.addClass('bootstrap-colorpalette');
                            var aHTML = [];
                            $.each(_aaColor, function(i, aColor){
                              aHTML.push('<div>');
                              $.each(aColor, function(i, sColor) {
                                var sButton = ['<button type="button" class="btn btn-elegant" style="background-color:', sColor,
                                  '" data-value="', sColor,
                                  '" title="', sColor,
                                  '" onclick="changeColor(',"'",sColor,"'",');',
                                  '"></button>'].join('');
                                aHTML.push(sButton);
                              });
                              aHTML.push('</div>');
                            });
                            element.html(aHTML.join(''));
                          };

                          var attachEvent = function(palette) {
                            palette.element.on('click', function(e) {
                              var welTarget = $(e.target),
                                  welBtn = welTarget.closest('.btn-color');

                              if (!welBtn[0]) { return; }

                              var value = welBtn.attr('data-value');
                              palette.value = value;
                              palette.element.trigger({
                                type: 'selectColor',
                                color: value,
                                element: palette.element
                              });
                            });
                          };

                          var Palette = function(element, options) {
                            this.element = element;
                            createPaletteElement(element, options && options.colors || aaColor);
                            attachEvent(this);
                          };

                          $.fn.extend({
                            colorPalette : function(options) {
                              this.each(function () {
                                var $this = $(this),
                                    data = $this.data('colorpalette');
                                if (!data) {
                                  $this.data('colorpalette', new Palette($this, options));
                                }
                              });
                              return this;
                            }
                          });
                        })(jQuery);

                        var options = {
                          colors:[['#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#03a9f4', '#009688', '#8bc34a','#cddc39','#ffeb3b','#ff9800','#ff5722','#9e9e9e','#607d8b','#795548','#ececec']]
                        }
                        $('#colorRow').colorPalette(options);
                          /*.on('selectColor', function(e) {                          
                          //alert(e.color);
                           
                          });*/
                    </script>  
              </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  <div class="p-2"><button type="button" class="btn btn-sm btn btn-secondary" data-toggle="modal" data-target="#Text">Text Design</button></div>
  <!-- The modal Get Price -->
    <div class="modal fade" id="Text" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modalLabel">Text Design</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                <div class="col-12">
                   <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                </div>
                <br>
          		<select id="TextFont" class="btn btn-default btn-sm dropdown-toggle">
          		  <option value="Ariel">Text Font</option>
				  <option value="bully" style="font-family: 'bully'">Bully</option>
				  <option value="PokemonHollow" style="font-family: 'PokemonHollow'">Gotta Catch</option>
				  <option value="PokemonSolid" style="font-family: 'PokemonSolid'">Them All!</option>				  
				</select>
				<select id="TextStrokeColor" class="btn btn-default btn-sm dropdown-toggle">
          		  <option value="#ff0000">Text Stroke Color</option>
				  <option value="#000000" style="background-color:#000000;">Black</option>
				  <option value="#ffffff" style="background-color:#ffffff;">White</option>
				  <option value="#ffc0cb" style="background-color:#ffc0cb;">Pink</option>				  
				</select>				
          		<br>
          		<select id="TextColor" class="btn btn-default btn-sm dropdown-toggle">
				  <option value="#4169e1">Text Color</option>
				  <option value="#000000" style="background-color:#000000;">Black</option>
				  <option value="#ffffff" style="background-color:#ffffff;">White</option>
				  <option value="#ffc0cb" style="background-color:#ffc0cb;">Pink</option>				  
				</select>
				<select id="TextEffect" class="btn btn-default btn-sm dropdown-toggle">
				  <option value="Normal">Text Effect</option>
				  <option value="Normal">Normal</option>
				  <option value="Circle">Circle</option>
				  <option value="Bridge">Bridge</option>	
				  <option value="Valley">Valley</option>			  
				</select>
          		<br>  
              </div>
          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="AddORModify();"><span class="icon icon-thumbs-up"></span>Add Text</button>
          </div>
        </div>
      </div>
    </div>
  <div class="p-2"><button type="button" class="btn btn-sm btn btn-secondary" data-toggle="modal" data-target="#Product">Change Product</button></div>
  <!-- The modal Get Price -->
    <div class="modal fade" id="Product" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modalLabel">Choose a Product</h4>
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
                    <td onclick="setProduct(this);"><img src="img/shirt_white.jpg" class="img-fluid" alt="Responsive image" style="width: 14; height: 14"><br> <span class="product_name"> White Shirt </span></td>
                    <td onclick="setProduct(this);"><img src="img/shirt_dark_heather.jpg" class="img-fluid" alt="Responsive image" style="width: 14;"><br><span class="product_name">Black Shirt</span></td>
                    <td onclick="setProduct(this);"><img src="img/shirt_heather_sapphire.jpg" class="img-fluid" alt="Responsive image" style="width: 14;"><br><span class="product_name">Blue Shirt</span></td>
                  </tr>
                  <tr>
                      <td onclick="setProduct(this);"><img src="img/shirt_cherry_red.jpg" class="img-fluid" alt="Responsive image" style="width: 14;"><br><span class="product_name">Maroon Shirt</span></td>
                    <td onclick="setProduct(this);"><img src="img/shirt_irish_green.jpg" class="img-fluid" alt="Responsive image" style="width: 14;"><br><span class="product_name">Green Shirt</span></td>
                    <td onclick="setProduct(this);"><img src="img/shirt_purple.jpg" class="img-fluid" alt="Responsive image" style="width: 14;"><br><span class="product_name">Purple Shirt</span></td>
                  </tr>                  
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>   
</div>

    
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
        var effect = 'Normal'; 
        /*front.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        front.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        right.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        right.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        back.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        back.setHeight(document.getElementById('canvas-wrapper').offsetHeight);
        left.setWidth(document.getElementById('canvas-wrapper').offsetWidth);
        left.setHeight(document.getElementById('canvas-wrapper').offsetHeight);  */    
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
                    img.setHeight(front.width/4);
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



        function changeColor(newColor){
            //this is to record what was done for the purpose of saving designs
            //alert(newColor);
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
        }      

        function AddORModify()
        { 
             text = document.getElementById('exampleTextarea').value;             
             color = document.getElementById('TextColor').value;
             strokeColor = document.getElementById('TextStrokeColor').value;
             font = document.getElementById('TextFont').value;
             effect = document.getElementById('TextEffect').value;       
               
            switch (effect){
                case 'Normal':
                   	straight();
                    break
                case 'Circle':
                    circle();
                    break;
                case 'Bridge':
                    reverseCurve();
                    break;
                case 'Valley':
                    curve();
                    break;
                default:
                   straight();
            }          
        }   

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

                var r = text.length * 10;//sets distance between letters getTranslationDistance(text);
                var j = -1; // this will adjust the angle of the letters not the curve
                var angleInterval = 116/textLength; // arc length (full circle is 360/textlength)
                for(var iterator=(-textLength/2), i=textLength-1; iterator<textLength/2;iterator++,i--) { 

                    var rotation = 90-(startAngle+(i)*angleInterval) ;
                   
                    var letter = new fabric.IText(text[i], {
                        fontFamily: font,
                        stroke: strokeColor,
                        angle : j*((startAngle)+(i*angleInterval)),
                        fontSize:14,
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

                var r = text.length * 10;//sets distance between letters getTranslationDistance(text);
                var j = -1; // this will adjust the angle of the letters not the curve
                var angleInterval = 116/textLength; // arc length (full circle is 360/textlength)
                var ltr = 0; //CHANGE get rid of this
                for(var x=(-textLength/2), i=textLength-1; x<textLength/2;x++,i--) { //CHANGE 1. x to iterator 2. i = textLength -1 3. i--

                    var rotation = 90-(startAngle+(i)*angleInterval) ;
                   
                    var letter = new fabric.IText(text[ltr], {
                        fontFamily: font,
                        stroke: strokeColor,
                        angle : j*((startAngle)+(i*angleInterval)),
                        fontSize:14,
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
                        fontSize:14,
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

         //Hide the saved design previews until the user has saved a design and would like to see it again
        var savedDesignsDiv = document.getElementById('savedDesigns');
        savedDesignsDiv.style.display = "none";
        function LoadImages()
       {
            //shows previews of saved design when user wants to see a saved design
            savedDesignsDiv.style.display = "block";

            var desing =   document.getElementById("mydesings").value;           
            if (desing!=0) 
            {
				var guest = desing.split("_", 1);

	            var file = guest+ '/' + desing + '/' + desing;                            
	            document.getElementById('frontSavePreview').src = file+ '_front.png';
	            document.getElementById('rightSavePreview').src = file+ '_right.png';
	            document.getElementById('backSavePreview').src = file+ '_back.png';
	            document.getElementById('leftSavePreview').src = file+ '_left.png';
            }
            /*else
            {
            	 savedDesignsDiv.style.display = "none";
            }*/
            
       }



       function LoadDesings()
       {   
            //shows previews of saved design when user wants to see a saved design
            savedDesignsDiv.style.display = "block";

           var desing =   document.getElementById("mydesings").value;
           var guest = desing.split("_", 1);
           var file = guest+ '/' + desing + '/' + desing + '.json';
           //alert('file:///'+ file);

           var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {             
              if (xhr.readyState == 4) 
              {               
                var text = JSON.parse(xhr.responseText);
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
                            
              }                         
            };
            xhr.open('GET',file,true);
            xhr.setRequestHeader('Content-Type', 'text/plain');            
            xhr.send();       
           /*$.ajax({
               type: "GET",
               dataType: "JSON",
               url: file,
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
           });       */       

                 
       }



       function setProduct(element){
          var content = element.innerHTML;
          //SETTING CURRENT PRODUCT IMAGE
          var imgSrc = content.substring(content.indexOf("src=\"")+5,content.indexOf('" '));
          //document.getElementById('description_image').src = imgSrc;
          document.getElementById('frontCanvasShirt').style.backgroundImage = "url("+imgSrc+")";
          document.getElementById('rightCanvasShirt').style.backgroundImage = "url("+imgSrc+")";
          document.getElementById('backCanvasShirt').style.backgroundImage = "url("+imgSrc+")";
          document.getElementById('leftCanvasShirt').style.backgroundImage = "url("+imgSrc+")";
         /* document.getElementById('frontSharePreviewCase').style.backgroundImage = "url("+imgSrc+")";
          document.getElementById('rightSharePreviewCase').style.backgroundImage = "url("+imgSrc+")";
          document.getElementById('backSharePreviewCase').style.backgroundImage = "url("+imgSrc+")";
          document.getElementById('leftSharePreviewCase').style.backgroundImage = "url("+imgSrc+")";
          //document.getElementById('canvasShirt').style.backgroundImage = "url("+imgSrc+")";
          console.log('Image Source: ' + imgSrc + " typeof: " + typeof imgSrc);
          //TODO CHANGE CODE BELOW, THIS IS FAKE DATA USED FOR DEMO.
          costOfProduct = 2;*/
      }

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
                    $general += "*"+ jsonData;  
                     var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {             
                      if (xhr.readyState == 4) {
                        alert('The design "' + xhr.responseText + '" was save successful');  
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
       
    </script>
</body>
</html>
