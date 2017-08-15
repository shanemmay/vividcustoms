<?php

/*require('fpdf/fpdf.php');

$img = $_POST['dataURL'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
//saving
$fileName = 'img500.png';
file_put_contents($fileName, $fileData);
savePDF("img500.png");
//*/
//setImageResolution("Aligator.png");
//exec("convert -font Ravie -pointsize 48 -background black -fill white label:'IM' -bordercolor black -border 5 BearsText.gif");
//readJSon("Guest000100/Guest000100_000616/Guest000100_000616_front.json");
exec("convert Crowns.png -unsharp 3600x4800+1+0 CrownsUnSharp.png");
exec(" convert fill blue -font Candice -size 3600x4800 -pointsize 100 -gravity center -units PixelsPerInch image -density 300 +antialias label:Text  Atile_fill_1.png");
//exec("convert Guest000103_000690_front.png -size 3600x4800 xc:none +antialias   Guest000103_000690_front2.png");
//exec("convert -size 10x6 xc:grey20 +antialias -draw 'fill white line 4,0 5,5' -filter Box -resize 100x   Aexample.png");

//exec("convert anchor1.png  -resize 3600x4800  -filter Lanczos2  anchor1Resize.png");
//exec("convert -liquid-rescale 3600x4800 -filter Sinc anchor1.png -virtual-pixel tile anchor1Rescale.png");
//exec("convert anchor1.png -liquid-rescale 1200x1000%\! anchor1Final.png");



function readJSon2($filepath)
{
	$jsondata = file_get_contents($filepath);

	$array = json_decode($jsondata,true);

	foreach($array as $k=>$val):
	    echo '<b>item: '.$k.'</b></br>';
	    $keys = array_keys($val);
	    foreach($keys as $key):
	        echo '&nbsp;'.ucfirst($key).' = '.$val[$key].'</br>';
	       if(is_array($key)) 
	    	{
	          foreach($key as $llaves => $valor):
	          	 $element = array_keys($valor);
	          	 print_r($element);
	          	//echo '&nbsp;&nbsp;'.ucfirst($llaves);
	          	//echo '&nbsp;'.ucfirst($llaves).' = '.$llaves[$valor].'</br>';
	          endforeach;
	  		}
	  		else
	  		{
	  			 echo '&nbsp;&nbsp;<b>item: '.$key.'</b></br>';
	  			//echo '&nbsp;'.ucfirst($key);
	  		}
	    endforeach;
	endforeach;
}

function readJSon($filepath)
{
	$string = file_get_contents($filepath);
	$json_a = json_decode($string, true);
	/*echo $json_a['objects'][status];
	echo $json_a['Jennifer'][status];*/
	//print_r($json_a);
	
	$quantity = 1;
	foreach ($json_a as $canvas) 
	{
	    if(is_array($canvas)) 
	    {
	    	foreach ($canvas as $item => $objects) 
			{				
				 if(is_array($objects)) 
	    		 {

	    		 	/*if(is_array($objects["filters"])) 
		 			{
				 		foreach ($objects["filters"] as $filter) 
				 		{
				 			print_r("<b>&nbsp;type: </b>".$filter["type"]."<br>");
				 			print_r("<b>&nbsp;color: </b>".$filter["color"]."<br>");
				 			print_r("<b>&nbsp;opacity: </b>".$filter["opacity"]."<br>");						 			
				 		}
			 		}
			 		else
			 		{
			 			print_r("<b>filters: </b>".$objects["filters"]."<br>");
			 		}*/

	    		 	print_r("<br><h2>".$item.":".$objects."</h2><br>");

	    		 	print_r("<b>filter: </b>".$objects["filters"]['color']."<br>");
	    		 	print_r("<b>type: </b>".$objects["type"]."<br>");	
			 		print_r("<b>originX: </b>".$objects["originX"]."<br>");	
			 		print_r("<b>originY: </b>".$objects["originY"]."<br>");	
			 		print_r("<b>left: </b>".$objects["left"]."<br>");	
			 		print_r("<b>top: </b>".$objects["top"]."<br>");	
			 		print_r("<b>width: </b>".$objects["width"]."<br>");	
			 		print_r("<b>height: </b>".$objects["height"]."<br>");	
			 		print_r("<b>fill: </b>".$objects["fill"]."<br>");	
			 		print_r("<b>stroke: </b>".$objects["stroke"]."<br>");	
			 		print_r("<b>strokeWidth: </b>".$objects["strokeWidth"]."<br>");	
			 		print_r("<b>strokeDashArray: </b>".$objects["strokeDashArray"]."<br>");	
			 		print_r("<b>strokeLineCap: </b>".$objects["strokeLineCap"]."<br>");	
			 		print_r("<b>strokeLineJoin: </b>".$objects["strokeLineJoin"]."<br>");	
			 		print_r("<b>strokeMiterLimit: </b>".$objects["strokeMiterLimit"]."<br>");	
			 		print_r("<b>scaleX: </b>".$objects["scaleX"]."<br>");	
			 		print_r("<b>scaleY: </b>".$objects["scaleY"]."<br>");	
			 		print_r("<b>angle: </b>".$objects["angle"]."<br>");	
			 		print_r("<b>flipX: </b>".$objects["flipX"]."<br>");	
			 		print_r("<b>flipY: </b>".$objects["flipY"]."<br>");	
			 		print_r("<b>opacity: </b>".$objects["opacity"]."<br>");	
			 		print_r("<b>shadow: </b>".$objects["shadow"]."<br>");	

			 		print_r("<b>visible: </b>".$objects["visible"]."<br>");
			 		print_r("<b>backgroundColor: </b>".$objects["backgroundColor"]."<br>");
			 		print_r("<b>fillRule: </b>".$objects["fillRule"]."<br>");
			 		print_r("<b>globalCompositeOperation: </b>".$objects["globalCompositeOperation"]."<br>");
			 		print_r("<b>transformMatrix: </b>".$objects["transformMatrix"]."<br>");
			 		print_r("<b>skewX: </b>".$objects["skewX"]."<br>");
			 		print_r("<b>skewY: </b>".$objects["skewY"]."<br>");
			 		print_r("<b>src: </b>".$objects["src"]."<br>");

			 		print_r("<b>crossOrigin: </b>".$objects["crossOrigin"]."<br>");
			 		print_r("<b>alignX: </b>".$objects["alignX"]."<br>");
			 		print_r("<b>alignY: </b>".$objects["alignY"]."<br>");
			 		print_r("<b>meetOrSlice: </b>".$objects["meetOrSlice"]."<br>");
			 		//propierty unique for text
			 		print_r("<b>text: </b>".$objects["text"]."<br>");
			 		print_r("<b>fontSize: </b>".$objects["fontSize"]."<br>");
			 		print_r("<b>fontWeight: </b>".$objects["fontWeight"]."<br>");
			 		print_r("<b>fontFamily: </b>".$objects["fontFamily"]."<br>");
			 		print_r("<b>fontStyle: </b>".$objects["fontStyle"]."<br>");
			 		print_r("<b>lineHeight: </b>".$objects["lineHeight"]."<br>");
			 		print_r("<b>textDecoration: </b>".$objects["textDecoration"]."<br>");
			 		print_r("<b>textAlign: </b>".$objects["textAlign"]."<br>");
			 		print_r("<b>textBackgroundColor: </b>".$objects["textBackgroundColor"]."<br>");
			 		print_r("<b>radius: </b>".$objects["radius"]."<br>");
			 		print_r("<b>spacing: </b>".$objects["spacing"]."<br>");
			 		print_r("<b>reverse: </b>".$objects["reverse"]."<br>");
			 		print_r("<b>effect: </b>".$objects["effect"]."<br>");
			 		print_r("<b>range: </b>".$objects["range"]."<br>");
			 		print_r("<b>smallFont: </b>".$objects["smallFont"]."<br>");
			 		print_r("<b>largeFont: </b>".$objects["largeFont"]."<br>");

			 		if ($objects["type"] == 'image')
			 		{
			 			$pos = strpos($objects["src"],'img');				 		
			 			$OrigenIMG = substr($objects['src'], $pos, strlen($objects['src'])); 						 		
			 			//exec("convert ".$OrigenIMG." -scale 3600x4800 ".$tmpname." _tmpImage.png");
			 			print_r("convert ".$OrigenIMG." -scale 360x480 ".$tmpname." _tmpImage.png");
			 			//unlink($route.'/'.$filename.".png");
			 		}
					 /*foreach ($objects as $element => $key) 
					 {
					 	print_r("<br> ");
					 	if (is_array($element))
					 	{

					 		/*print_r("<b>type: </b>".$element["type"]."<br>");	
					 		print_r("<b>originX: </b>".$element["originX"]."<br>");	
					 		print_r("<b>originY: </b>".$element["originY"]."<br>");	
					 		print_r("<b>left: </b>".$element["left"]."<br>");	
					 		print_r("<b>width: </b>".$element["width"]."<br>");	
					 		print_r("<b>height: </b>".$element["height"]."<br>");	
					 		print_r("<b>fill: </b>".$element["fill"]."<br>");	
					 		print_r("<b>stroke: </b>".$element["stroke"]."<br>");	
					 		print_r("<b>strokeWidth: </b>".$element["strokeWidth"]."<br>");	
					 		print_r("<b>strokeDashArray: </b>".$element["strokeDashArray"]."<br>");	
					 		print_r("<b>strokeLineCap: </b>".$element["strokeLineCap"]."<br>");	
					 		print_r("<b>strokeLineJoin: </b>".$element["strokeLineJoin"]."<br>");	
					 		print_r("<b>strokeMiterLimit: </b>".$element["strokeMiterLimit"]."<br>");	
					 		print_r("<b>scaleX: </b>".$element["scaleX"]."<br>");	
					 		print_r("<b>scaleY: </b>".$element["scaleY"]."<br>");	
					 		print_r("<b>angle: </b>".$element["angle"]."<br>");	
					 		print_r("<b>flipX: </b>".$element["flipX"]."<br>");	
					 		print_r("<b>flipY: </b>".$element["flipY"]."<br>");	
					 		print_r("<b>opacity: </b>".$element["opacity"]."<br>");	
					 		print_r("<b>shadow: </b>".$element["shadow"]."<br>");	

					 		print_r("<b>visible: </b>".$element["visible"]."<br>");
					 		print_r("<b>backgroundColor: </b>".$element["backgroundColor"]."<br>");
					 		print_r("<b>fillRule: </b>".$element["fillRule"]."<br>");
					 		print_r("<b>globalCompositeOperation: </b>".$element["globalCompositeOperation"]."<br>");
					 		print_r("<b>transformMatrix: </b>".$element["transformMatrix"]."<br>");
					 		print_r("<b>skewX: </b>".$element["skewX"]."<br>");
					 		print_r("<b>skewY: </b>".$element["skewY"]."<br>");
					 		print_r("<b>src: </b>".$element["src"]."<br>");*/

					 		//$pos = strpos($element["src"],'img');
					 		
					 		//$subcadena = substr($element['src'], $pos,strlen($element['src'])); 

					 		//echo $subcadena;

					 		//exec("convert ".$subcadena." -scale 3600x4800 _tmp.png");
					 		//list($pdfImageArrayW, $pdfImageArrayH) = getimagesize($element["src"]);
					 		//print_r("list: ".$pdfImageArrayH,$pdfImageArrayW);
					 		//$previewValueW = 1200;
					 		//$previewValueH= 1500;					 		
					 		//exec('convert  -gravity "' . $garvity . '" -background transparent -depth 8  "' . $flipStr . '" "' . $flopStr . '"  -fill  "' . $txtColor . '" -font "' . $fontTTF . '"  -quality 100   -size 2000x2000 -dither None +antialias label:"' . $text . '"  -trim png32:' . $imageDestName;);
					 		//exec("identify -list format");
					 		

					 		/*if($element["type"] == "image")
					 		{
					 			//rotate done					 			
					 			//exec("convert Bears.png -rotate ".$element["angle"]." BearsFinaly.png");
					 			//put white badground squart in the images
					 			//exec("convert -flatten Crowns.png  Bearsflaten.png");
					 			//change color
					 			//exec("convert Bears.png -fuzz 100%  -fill '#000080' -opaque none BearsFinaly.png");
					 			//draw text
					 			//exec(" convert -size 600x600 xc:none -fill red -stroke black  -font Candice -pointsize 90  -gravity center -draw 'text 0,0 Hello' BearsText.png");
					 			
					 		}*/
					 		
					 		/*exec("convert -size ".$element["width"]."x".$element["height"]." xc:none white.png  -geometry ".$element["width"]."x".$element["height"]." +0+0 -composite   anchor7.png -geometry " . $previewValueW . "x" . $previewValueH ." +0+0 -composite  BearsFinaly.png");
					 		exec("convert BearsFinaly.png -density 300 -units PixelsPerInch BearsFinaly.png");
							exec("convert  BearsFinaly.png -scale 3600x4800 BearsFinaly.png");*/
					 		//exec("convert -size ".$element["width"]."x".$element["height"]." xc:none Crowns.png  -geometry ".$element["width"]."x".$element["height"]." +0+0  BearsFinaly.png");
					 		
					 		/*if(is_array($element["filters"])) 
	    		 			{
						 		foreach ($element["filters"] as $filter) 
						 		{
						 			print_r("<b>&nbsp;type: </b>".$filter["type"]."<br>");
						 			print_r("<b>&nbsp;color: </b>".$filter["color"]."<br>");
						 			print_r("<b>&nbsp;opacity: </b>".$filter["opacity"]."<br>");						 			
						 		}
					 		}
					 		else
					 		{
					 			print_r("<b>filters: </b>".$element["filters"]."<br>");
					 		}*/

					 		/*print_r("<b>resizeFilters: </b>".$element["resizeFilters"]."<br>");

					 		print_r("<b>crossOrigin: </b>".$element["crossOrigin"]."<br>");
					 		print_r("<b>alignX: </b>".$element["alignX"]."<br>");
					 		print_r("<b>alignY: </b>".$element["alignY"]."<br>");
					 		print_r("<b>meetOrSlice: </b>".$element["meetOrSlice"]."<br>");
					 		//propierty unique for text
					 		print_r("<b>text: </b>".$element["text"]."<br>");
					 		print_r("<b>fontSize: </b>".$element["fontSize"]."<br>");
					 		print_r("<b>fontWeight: </b>".$element["fontWeight"]."<br>");
					 		print_r("<b>fontFamily: </b>".$element["fontFamily"]."<br>");
					 		print_r("<b>fontStyle: </b>".$element["fontStyle"]."<br>");
					 		print_r("<b>lineHeight: </b>".$element["lineHeight"]."<br>");
					 		print_r("<b>textDecoration: </b>".$element["textDecoration"]."<br>");
					 		print_r("<b>textAlign: </b>".$element["textAlign"]."<br>");
					 		print_r("<b>textBackgroundColor: </b>".$element["textBackgroundColor"]."<br>");
					 		print_r("<b>radius: </b>".$element["radius"]."<br>");
					 		print_r("<b>spacing: </b>".$element["spacing"]."<br>");
					 		print_r("<b>reverse: </b>".$element["reverse"]."<br>");
					 		print_r("<b>effect: </b>".$element["effect"]."<br>");
					 		print_r("<b>range: </b>".$element["range"]."<br>");
					 		print_r("<b>smallFont: </b>".$element["smallFont"]."<br>");
					 		print_r("<b>largeFont: </b>".$element["largeFont"]."<br>");
					 		$quantity++;
					 	}
					 	else
					 	{
					 		//echo "$element => $value\n";
					 		print_r($element.":".$key);	
					 	}				 		
					 	
				 	}		*/	 
	   			}	   			
	    	} 		   
		}  			
	}
}


function readJSonOLD($filepath)
{
	$string = file_get_contents($filepath);
	$json_a = json_decode($string, true);
	/*echo $json_a['objects'][status];
	echo $json_a['Jennifer'][status];*/
	//print_r($json_a);
	
	$quantity = 1;
	foreach ($json_a as $canvas) 
	{
	    if(is_array($canvas)) 
	    {
	    	foreach ($canvas as $item => $objects) 
			{				
				 if(is_array($objects)) 
	    		 {
					 foreach ($objects as $element) 
					 {
					 	print_r("<br> ");
					 	if (is_array($element))
					 	{

					 		print_r("<b>type: </b>".$element["type"]."<br>");	
					 		print_r("<b>originX: </b>".$element["originX"]."<br>");	
					 		print_r("<b>originY: </b>".$element["originY"]."<br>");	
					 		print_r("<b>left: </b>".$element["left"]."<br>");	
					 		print_r("<b>width: </b>".$element["width"]."<br>");	
					 		print_r("<b>height: </b>".$element["height"]."<br>");	
					 		print_r("<b>fill: </b>".$element["fill"]."<br>");	
					 		print_r("<b>stroke: </b>".$element["stroke"]."<br>");	
					 		print_r("<b>strokeWidth: </b>".$element["strokeWidth"]."<br>");	
					 		print_r("<b>strokeDashArray: </b>".$element["strokeDashArray"]."<br>");	
					 		print_r("<b>strokeLineCap: </b>".$element["strokeLineCap"]."<br>");	
					 		print_r("<b>strokeLineJoin: </b>".$element["strokeLineJoin"]."<br>");	
					 		print_r("<b>strokeMiterLimit: </b>".$element["strokeMiterLimit"]."<br>");	
					 		print_r("<b>scaleX: </b>".$element["scaleX"]."<br>");	
					 		print_r("<b>scaleY: </b>".$element["scaleY"]."<br>");	
					 		print_r("<b>angle: </b>".$element["angle"]."<br>");	
					 		print_r("<b>flipX: </b>".$element["flipX"]."<br>");	
					 		print_r("<b>flipY: </b>".$element["flipY"]."<br>");	
					 		print_r("<b>opacity: </b>".$element["opacity"]."<br>");	
					 		print_r("<b>shadow: </b>".$element["shadow"]."<br>");	

					 		print_r("<b>visible: </b>".$element["visible"]."<br>");
					 		print_r("<b>backgroundColor: </b>".$element["backgroundColor"]."<br>");
					 		print_r("<b>fillRule: </b>".$element["fillRule"]."<br>");
					 		print_r("<b>globalCompositeOperation: </b>".$element["globalCompositeOperation"]."<br>");
					 		print_r("<b>transformMatrix: </b>".$element["transformMatrix"]."<br>");
					 		print_r("<b>skewX: </b>".$element["skewX"]."<br>");
					 		print_r("<b>skewY: </b>".$element["skewY"]."<br>");
					 		print_r("<b>src: </b>".$element["src"]."<br>");

					 		//$pos = strpos($element["src"],'img');
					 		
					 		//$subcadena = substr($element['src'], $pos,strlen($element['src'])); 

					 		//echo $subcadena;

					 		//exec("convert ".$subcadena." -scale 3600x4800 _tmp.png");
					 		//list($pdfImageArrayW, $pdfImageArrayH) = getimagesize($element["src"]);
					 		//print_r("list: ".$pdfImageArrayH,$pdfImageArrayW);
					 		//$previewValueW = 1200;
					 		//$previewValueH= 1500;					 		
					 		//exec('convert  -gravity "' . $garvity . '" -background transparent -depth 8  "' . $flipStr . '" "' . $flopStr . '"  -fill  "' . $txtColor . '" -font "' . $fontTTF . '"  -quality 100   -size 2000x2000 -dither None +antialias label:"' . $text . '"  -trim png32:' . $imageDestName;);
					 		//exec("identify -list format");
					 		

					 		/*if($element["type"] == "image")
					 		{
					 			//rotate done					 			
					 			//exec("convert Bears.png -rotate ".$element["angle"]." BearsFinaly.png");
					 			//put white badground squart in the images
					 			//exec("convert -flatten Crowns.png  Bearsflaten.png");
					 			//change color
					 			//exec("convert Bears.png -fuzz 100%  -fill '#000080' -opaque none BearsFinaly.png");
					 			//draw text
					 			//exec(" convert -size 600x600 xc:none -fill red -stroke black  -font Candice -pointsize 90  -gravity center -draw 'text 0,0 Hello' BearsText.png");
					 			
					 		}*/
					 		
					 		/*exec("convert -size ".$element["width"]."x".$element["height"]." xc:none white.png  -geometry ".$element["width"]."x".$element["height"]." +0+0 -composite   anchor7.png -geometry " . $previewValueW . "x" . $previewValueH ." +0+0 -composite  BearsFinaly.png");
					 		exec("convert BearsFinaly.png -density 300 -units PixelsPerInch BearsFinaly.png");
							exec("convert  BearsFinaly.png -scale 3600x4800 BearsFinaly.png");*/
					 		//exec("convert -size ".$element["width"]."x".$element["height"]." xc:none Crowns.png  -geometry ".$element["width"]."x".$element["height"]." +0+0  BearsFinaly.png");
					 		
					 		if(is_array($element["filters"])) 
	    		 			{
						 		foreach ($element["filters"] as $filter) 
						 		{
						 			print_r("<b>&nbsp;type: </b>".$filter["type"]."<br>");
						 			print_r("<b>&nbsp;color: </b>".$filter["color"]."<br>");
						 			print_r("<b>&nbsp;opacity: </b>".$filter["opacity"]."<br>");						 			
						 		}
					 		}
					 		else
					 		{
					 			print_r("<b>filters: </b>".$element["filters"]."<br>");
					 		}

					 		print_r("<b>resizeFilters: </b>".$element["resizeFilters"]."<br>");

					 		print_r("<b>crossOrigin: </b>".$element["crossOrigin"]."<br>");
					 		print_r("<b>alignX: </b>".$element["alignX"]."<br>");
					 		print_r("<b>alignY: </b>".$element["alignY"]."<br>");
					 		print_r("<b>meetOrSlice: </b>".$element["meetOrSlice"]."<br>");
					 		//propierty unique for text
					 		print_r("<b>text: </b>".$element["text"]."<br>");
					 		print_r("<b>fontSize: </b>".$element["fontSize"]."<br>");
					 		print_r("<b>fontWeight: </b>".$element["fontWeight"]."<br>");
					 		print_r("<b>fontFamily: </b>".$element["fontFamily"]."<br>");
					 		print_r("<b>fontStyle: </b>".$element["fontStyle"]."<br>");
					 		print_r("<b>lineHeight: </b>".$element["lineHeight"]."<br>");
					 		print_r("<b>textDecoration: </b>".$element["textDecoration"]."<br>");
					 		print_r("<b>textAlign: </b>".$element["textAlign"]."<br>");
					 		print_r("<b>textBackgroundColor: </b>".$element["textBackgroundColor"]."<br>");
					 		print_r("<b>radius: </b>".$element["radius"]."<br>");
					 		print_r("<b>spacing: </b>".$element["spacing"]."<br>");
					 		print_r("<b>reverse: </b>".$element["reverse"]."<br>");
					 		print_r("<b>effect: </b>".$element["effect"]."<br>");
					 		print_r("<b>range: </b>".$element["range"]."<br>");
					 		print_r("<b>smallFont: </b>".$element["smallFont"]."<br>");
					 		print_r("<b>largeFont: </b>".$element["largeFont"]."<br>");
					 		$quantity++;
					 	}
					 	else
					 	{
					 		//echo "$element => $value\n";
					 		print_r("element: ".$element);	
					 	}				 		
					 	
				 	}				 
	   			}
	   			else 
			    {
			       print_r("<br><h2>".$item."</h2><br>");
			    }
	    	} 		   
		}   
		else
		{
				print_r("<br><h1>".$canvas."</h1><br>");
		}
	}
}


function setImageResolution($imagePath)
{	
    //$imagick = new \Imagick(realpath($imagePath));  
    //$image = new Imagick($imagePath); // default 72 dpi image
    //$image->setImageUnits(Imagick::RESOLUTION_PIXELSPERINCH);


    //change de resolution 3600X4800 
	//$image->resizeImage(3600,4800,Imagick::FILTER_UNDEFINED,1);
	//change de dpi to 300
	//$wgImageMagickConvertCommand = '/usr/bin/convert';    
	
	//change the dpi
	
	//exec("convert Crowns.png -density 300 -units PixelsPerInch CrownsDensity300.png");
	//exec("convert CrownsDensity300.png Lanczos -distort resize 300% CrownsSharpen.png");
	exec("convert -size 3600x4800 xc:none Crowns.png -geometry 3600x4800 +0+0 -composite anchor1.png -geometry 3600x4800 +0+0 -composite AnchorFinaly.png");

	exec("convert anchor01.png -density 300 -units PixelsPerInch CrownsDensity900.png");
	exec("convert CrownsDensity900.png -scale 3600x4800 CrownsScale3600x4800.png");


	/*$src1 = new \Imagick("anchor1.png");
	$src2 = new \Imagick("Crowns.png");

	$src1->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);
	$src1->setImageArtifact('compose:args', "1,0,-0.5,0.5");
	$src1->compositeImage($src2, Imagick::COMPOSITE_MATHEMATICS, 0, 0);
	$src1->writeImage("AnchorFinaly.png");*/

 //for katie	
	//exec("convert anchor01.png -density 300 -units PixelsPerInch CrownsDensity900.png");
	//exec("convert CrownsDensity900.png -scale 3600x4800 CrownsScale3600x4800.png");

		//exec("convert Crowns.png -liquid-rescale 130x100%\! Crowns2.png");
	
	



/*
-  $filter = ' -scale '. $width . 'x' . $height . ' -filter QUADRATIC';
+  $filter = ' -resize '. $width . 'x' . $height . ' -sharpen 1.5';
*/
	 
//exec("convert Crowns.png -sample 3600x4800 CrownsSample3600x4800.png");
	
	//exec("convert Crowns.png -filter Sinc -resize 3600x4800 CrownsResize3600x4800.png");
	//exec("convert Crowns.png -extent 3600x4800 CrownsExtend3600x4800.png");
	//exec("convert -size 3600x4800 xc:none Crowns.png -geometry 3600x4800 +0+0 -composite Crowns.png -geometry 3600x4800 +0+0 -composite  Crowns300DPI.png");
	//exec("convert Crowns.png -resize 3600x4800 -background white -gravity center -extent 3600x4800 CrownsSuits.png");
//exec("convert -units PixelsPerInch Crowns.png -resample 900 CrownsResample900.png");
	//exec("convert img300dpi: -colorspace LUV  -filter Lanczos  -distort resize 300x \ -colorspace sRGB  imgFinaly.png");
          
	//exec("convert Aligator.png -depth 300 -units pixelsperinch img300dpi.png");
	//exec("convert Aligator.png -sample 3600x4800 imgSample.png");
	//exec("convert imgSample.png -scale 3600x4800 imgScale.png");
	//exec("convert Crowns.png -filter Sinc -resize 3600x4800 imgResize.png");
	//exec("convert imgSample.png -density 300 -units PixelsPerInch imgDensity.png");
	//exec("convert Aligator.png -filter Gaussian -resize 600% imgGaussian.png");
	
	
	
	//exec("convert -size 8x8 pattern:Crowns.png  -virtual-pixel tile \ -magnify -magnify -magnify imgFinaly.png",$output);
	//exec("convert -size 3600x4800 img300dpi.png -virtual-pixel tile -magnify -magnify -magnify imgFinaly.png");
    
    //exec("convert Crowns.png -filter Lanczos  -distort resize 3600x4800 -units PixelsPerInch -density 300x300 imgQuality.png");
  
    //exec("magick display -size 1280x1024 -window Crowns.png imgResize.png ");
	
	

	//exec($wgImageMagickConvertCommand . " -size '" . "3600" . "x" . "4800". "' xc:none '" . "img300dpi.png" . "' -geometry " . "3600" . "x" ."4800" . "+0+0 -composite '" . "img300dpi.png" . "' -geometry " . "3600" . "x" . "4800" . "+0+0 -composite " ."   imgFinaly.png");
	//save the image
	//$image->writeImage("img500dpi.png"); 

	//$imagick = new \Imagick(realpath("Crowns.png"));
	

	
	//$imagick->resizeImage(3600,4800,Imagick::FILTER_UNDEFINED,1);
	//$imagick->adaptiveSharpenImage(10, 10);    
    //$imagick->writeImage("img500dpi.png"); 

	
	//$image->setImageProperty('Exif:Make', 'Imagick');    
     		
	//$imagick->resampleImage (300,300,imagick::FILTER_UNDEFINED,1);
	//$imagick->setImageProperty('Exif:Make', 'Imagick');
	//file_put_contents( $imagePath, $imagick);	
	

	//var_dump($output);

}
/*
function savePDF($fileName)
{
	//print_r($fileName);
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',10);
	$pdf->Write(7,'Signed By:');
	$pdf->Ln(10);

	//signature
	$pdf->Image($fileName,null,null,0,0,'png') ;
	//publish
	$pdf->output("img500.pdf",'I');

	
}



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(200,200,'Hello World!');
$pdf->ln(10);
 
//$image = new Imagick("Crowns.png"); // default 72 dpi image
//$image->setImageUnits(Imagick::RESOLUTION_PIXELSPERINCH);  
//$image->setImageResolution(300, 300);
//$image->resizeImage(595,842,Imagick::FILTER_UNDEFINED,1); 
//$image->writeImage("img500dpi.png"); 
//$pdf->Image("img500dpi.png",null,null,0,0,'png') ;
$pdf->Image("Crowns.png",null,null,0,0,'png') ;
$pdf->Output("Crowns.PDF",'I');
*/

?>

