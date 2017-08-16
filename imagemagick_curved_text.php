<?php

date_default_timezone_set("UTC"); 
echo "UTC:".time(); 
echo "<br>"; 
echo "<a href='imagemagick.php'>Link to imagemagick</a><br>";
//fill = text color || size = size of image || pointsize = fontsize || label: = text || 
/*
TEXT:
-fill blue = text color blue
-font Candice = font of text
-size 3600x4800 = size of image
-pointsize 72 = font size
-gravity center = centers the text on the image
-units PixelsPerInch image -density 300 = changes dpi to 300
+antialias = sets rigid edge so there is no blue
label: someText = sets the text of the label/image
IMAGE:

*/
//creating text
//exec("convert -background none -fill green -font Candice -size 3600x4800 -pointsize 144 -gravity center -units PixelsPerInch image -density 300 +antialias label:Shane text_300dpi.png");
//creating image
//exec("convert  clip.png -filter spline -resize 1800x2400  img_300dpi_spline.png"); //-filter box -resize 3600x4800   +antialias
//exec("convert clip.png -unsharp 30x40+0+0 -resize 1800x2400 img_300dpi_unsharpFirst.png");
//exec("convert clip.png -resize 1800x2400  -unsharp 3x4+0+0 img_300dpi_unsharpSecond.png");
//exec("convert clip.png -resize 1800x2400  img_300dpi_resize.png");

//text with image
//exec("convert -size 3600x4800 xc:none clip.png -geometry 1600x2400+1800+2400 -composite text_300dpi.png -geometry 720x960+1800+2400 -composite   composite.png ");
//generating pdf
//exec("convert text_300dpi.png clip.png composite.png shane.pdf");
//exec("convert img_text.png  -density 300 -unit PixelsPerInch img_text_300dpi.png");

//readJSon("Guest000103_000690_front.json","Guest000103_000690_front");

//reading  json file
$json_file_name = "Guest000110_000700_front.json";
$json_file = fopen($json_file_name, "r");
$json_contents = fread($json_file, filesize($json_file_name));
fclose($json_file);
$json = json_decode($json_contents);
//print_r($json);
print_r($json->objects[0]);
echo "<hr>";
print_r($json->objects[1]);
echo "<hr>";
print_r($json->objects[2]);
echo "<hr>";

?>
<hr>
<h1>start of page</h1>
<?php
//arrays to hold information
$resizes = array();
$locations = array();
$img_names = array();
//loop through objects in json file
$counter = 0;
$arr = $json->objects;
while ($counter < count($arr)) {
	$obj = $arr[$counter];
	printObjectDetails($obj);
	//determining the type of object
	if ($obj->type == "image"){
		$src = $obj->src;
		$angle = "-rotate " . $obj->angle;
		if(isset($obj->filters[ count($obj->filters) - 1]->color)){
			$color = '-fuzz 90% -fill "'.$obj->filters[ count($obj->filters) - 1]->color.'" -opaque white';
		}else{
			$color = '';
		}
		$width = ($obj->width / 462) * 3600 * $obj->scaleX;
		$height = ($obj->height / 608)* 4800 * $obj->scaleX;
		$resize =  ($width) . "x" . ($height);//$resize =  ($obj->width*$obj->scaleX) . "x" . ($obj->height*$obj->scaleX);
		array_push($resizes, $resize);
		$x = ($obj->left / 462) * 3600 / $obj->scaleX;
		$y = ($obj->top / 608) * 4800 / $obj->scaleX;
		$location = "+".$x."+".$y;//$location = "+".($obj->left)."+".($obj->top);//$location = "+".($obj->left*7.79/$obj->scaleX)."+".($obj->top*7.89/$obj->scaleX);
		array_push($locations, $location);
		$img_name = $obj->type . "_" . $counter . ".png";
		array_push($img_names, $img_name);
		exec('convert -background none '.$src.' '.$color.' ' . $angle  . ' -units PixelsPerInch image -density 300  '. $img_name);
		echo "<hr>";
		echo "<hr>";
	}else if($obj->type == "text"){
		
		$color  = "-fill " . $obj->fill;
		$strokeColor = "-stroke " . $obj->stroke;
		$strokeWidth = "-strokewidth " . ($obj->strokeWidth*$obj->scaleX);
		$font = "-font fonts/".$obj->fontFamily.".ttf"; //after -size 3600x4800
		$fontSize = "-pointsize " . ($obj->fontSize*$obj->scaleX);//after -gravity center -units PixelsPerInch image -density 300 +antialias
		$angle = "-rotate " . $obj->angle;
		//creating text file and using it since imagemagick cannot handles spaces
		//$fileName = createTXT($counter,$obj->text);
		$text = "label:\"".$obj->text.'"';//read text file here
		$width = ($obj->width / 462) * 3600 * $obj->scaleX;
		$height = ($obj->height / 608)* 4800 * $obj->scaleX;
		$resize =  ($width) . "x" . ($height);//$resize =  ($obj->width*$obj->scaleX) . "x" . ($obj->height*$obj->scaleX);
		array_push($resizes, $resize);
		$x = ($obj->left / 462) * 3600 ;
		$y = ($obj->top / 608) * 4800 ;
		echo "top/608 : " . ($obj->top/608*4800) . " left/462 : " . ($obj->left/462*3600) . " <br>";
		echo "x: " . $x . " y: " . $y . " <br>";
		$location = "+".$x."+".$y;//$location = "+".($obj->left)."+".($obj->top);//$location = "+".($obj->left*7.79/$obj->scaleX)."+".($obj->top*7.89/$obj->scaleX);
		array_push($locations, $location);
		$img_name = $obj->type . "_" . $counter . ".png";
		array_push($img_names, $img_name);
		exec("convert -background none ". $color . " ". $strokeColor . " " . $strokeWidth . " " . $font . " " . $angle . " " . $fontSize . " -gravity center  -units PixelsPerInch image -density 300 +antialias " . $text . " " . $img_name);
		echo "<hr>";
		print_r(getimagesize($img_name));
		echo "<hr>";
	}else{
		// Text to write 
		$text = $obj->text;

		// Create Imagick objects 
		$image = new Imagick();
		$draw = new ImagickDraw();
		$background = new ImagickPixel('none'); // Transparent

		// Font properties 
		$draw->setFont('Arial');
		$draw->setFontSize($obj->fontSize*$obj->scaleX*7.84);
		$draw->setStrokeWidth($obj->strokeWidth*$obj->scaleX*7.84);
		$draw->setFillColor($obj->fill);
		$draw->setStrokeColor($obj->stroke);
		$draw->setStrokeAntialias(true);
		$draw->setTextAntialias(true);
		$draw->setTextKerning ($obj->spacing*$obj->scaleX*7.84);

		// Get font metrics 
		$metrics = $image->queryFontMetrics($draw, $text);

		// Create text 
		$draw->annotation(0, $metrics['ascender'], $text);

		// Create image 
		$image->newImage($metrics['textWidth'], $metrics['textHeight'], $background);
		$image->setImageFormat('png');
		$image->drawImage($draw);
		
		// Fill new visible areas with transparent 
		$image->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);

		// Activate matte 
		//$image->setImageMatte(true);
		if($obj->radius < 0){
			$distort = array( 360 - ($obj->radius*-1), 180  );// , 180 to reverse curve
			$image->rotateImage('transparent', 180);
		}else{
			$distort = array( 360 - $obj->radius  );// , 180 to reverse curve
		}
		$image->distortImage(Imagick::DISTORTION_ARC, $distort, TRUE );
		$image->rotateImage('transparent',  $obj->angle);

		$image->setImageUnits(Imagick::RESOLUTION_PIXELSPERINCH);
		$image->setImageResolution(300,300);

		$width = ($obj->width / 462) * 3600 * $obj->scaleX;
		$height = ($obj->height / 608)* 4800 * $obj->scaleX;
		$resize =  ($width) . "x" . ($height);//$resize =  ($obj->width*$obj->scaleX) . "x" . ($obj->height*$obj->scaleX);
		array_push($resizes, $resize);
		$x = ($obj->left / 462) * 3600 ;
		$y = ($obj->top / 608) * 4800 ;
		
		$location = "+".$x."+". $y;//$location = "+".($obj->left)."+".($obj->top);//$location = "+".($obj->left*7.79/$obj->scaleX)."+".($obj->top*7.89/$obj->scaleX);
		array_push($locations, $location);
		$img_name = $obj->type . "_" . $counter . ".png";
		array_push($img_names, $img_name);
		file_put_contents($obj->type . "_" . $counter . ".png", $image);
		echo "<hr>";
		print_r(getimagesize($img_name));
		echo "<hr>";
	}
	$counter++;
}

//composite (combining all) images
//exec("convert text_300dpi.png clip.png composite.png shane.pdf");
//exec("convert -size 3600x4800 xc:none clip.png -geometry 1600x2400+1800+2400 -composite text_300dpi.png -geometry 720x960+1800+2400 -composite   composite.png ");
$str_cmd = "convert -size 3600x4800 xc:none";
$i = 0;
print_r(array_values($resizes));
print_r(array_values($locations));
print_r(array_values($img_names));
while ( $i < count($img_names)){
	$str_cmd .= " " . $img_names[$i] . " -geometry " . $resizes[$i] . $locations[$i] . /*. $resizes[$i].$locations[$i].*/ " -composite";
	$i++;
}
$str_cmd .= " -units PixelsPerInch image -density 300 design.png";
echo "<hr>";
echo($str_cmd);
echo "<hr>";
exec($str_cmd);
exec("convert design.png design.png DESIGN.pdf");

function createTXT($counter,$value)
{
	$fp = fopen("text_".$counter.".txt", 'wb');
	$ok = fwrite( $fp, $value);
	fclose( $fp );
	return "@text_".$counter.".txt";
}

function printObjectDetails($obj){
	echo "<h2>Start of Object Details</h2>";
	if ($obj->type == "image"){
		echo "image" . "<br>";
		echo "src : ".$obj->src . "<br>";
		echo "left ".$obj->left . "<br>";
		echo "top ".$obj->top . "<br>";
		echo "width ".$obj->width . "<br>";
		echo "height ".$obj->height . "<br>";
		if(isset($obj->filters[0]->color)){
			echo "color ".$obj->filters[0]->color . "&nbsp;";
			print_r($obj->filters ); echo "<br>";	
		}
		echo "angle ".$obj->angle . "<br>";
	}elseif($obj->type == "text"){
		echo "text" . "<br>";
		echo "text : ". $obj->text . "<br>";
		echo "left ".$obj->left . "<br>";
		echo "top ".$obj->top . "<br>";
		echo "width ".$obj->width . "<br>";
		echo "height ".$obj->height . "<br>";
		echo "fill color : ". $obj->fill . "<br>";
		echo "stroke color : " . $obj->stroke . "<br>";
		echo "font size : " . $obj->fontSize . "<br>";
		echo "-font fonts/".$obj->fontFamily.".ttf". "<br>";
	}else{
		echo "curved text<br>";
		echo "radius : " . $obj->radius*1.2 . "<br>";
		echo "spacing : " . $obj->spacing . "<br>";
		echo "text : ". $obj->text . "<br>";
		echo "left ".$obj->left . "<br>";
		echo "top ".$obj->top . "<br>";
		echo "width ".$obj->width . "<br>";
		echo "height ".$obj->height . "<br>";
		echo "fill color : ". $obj->fill . "<br>";
		echo "stroke color : " . $obj->stroke . "<br>";
		echo "font size : " . $obj->fontSize . "<br>";
		echo "-font fonts/".$obj->fontFamily.".ttf". "<br>";
	}
}
//###############################################################################################################################################################################################


function readJSon($filepath, $tmpname)
	{
		$string = file_get_contents($filepath);		
		$json_a = json_decode($string, true);
		exec("convert ".$tmpname.".png -alpha set -channel a -evaluate set 1% +channel ".$tmpname."_baseImage.png");	
		list($width, $height) = getimagesize($tmpname.".png");
		foreach ($json_a as $canvas) 
		{
		    if(is_array($canvas)) 
		    {
		    	foreach ($canvas as $item => $objects) 
				{				
					if(is_array($objects)) 
		    		{
		    			
						if ($objects["type"] == 'image')
				 		{
				 			$color = 'black';				 			
				 			if(is_array($objects["filters"])) 
				 			{
						 		foreach ($objects["filters"] as $filter) 
						 		{
						 			$color=$filter["color"];						 								 			
						 		}
					 		}
				 			$pos = strpos($objects["src"],'img');				 		
				 			$OrigenIMG = substr($objects['src'], $pos, strlen($objects['src'])); 
				 									 		
				 			//put later -scale 3600x4800
				 			exec("convert ".$OrigenIMG." -fuzz 100%  -fill blue -opaque black  -scale 120x160 ".$tmpname."_tmpImage.png");				 			
				 			//good
				 			//exec("convert -size ".$width."x".$height." xc:none ".$tmpname."_tmpImage.png  -geometry ".$objects["width"]."x".$objects["height"]."+".$objects["top"]."+".$objects["left"]." -composite  ".$tmpname."_baseImage.png -geometry ".$width."x".$height." +0+0 -composite  ".$tmpname."_baseImage.png");
				 			//unlink($route.'/'.$filename."_tmpImage.png");
				 		}
				 		if ($objects["type"] == 'text') 
				 		{
				 			exec(" convert -size  360x480 xc:none  -fill blue -stroke 1 -gravity center -pointsize 40  -draw 'text 0,0 ".$objects["text"]."' +antialias ".$tmpname."_tmpText.png");	
				 			echo $objects["text"];	
				 			//good
				 			//exec("convert -size ".$width."x".$height." xc:none ".$tmpname."_tmpText.png  -geometry ".$objects["width"]."x".$objects["height"]."+0+0 -composite  ".$tmpname."_baseImage.png -geometry ".$width."x".$height." +0+0 -composite  ".$tmpname."_baseImage.png");	
				 			//unlink($route.'/'.$filename."_tmpText.png");	 			
				 		}					 		
					}	
		   		}		   		
		    } 		    
		}

		//finaly convertion
		//exec("convert ".$tmpname."_baseImage.png -density 300 -units PixelsPerInch ".$tmpname."_Final.png");
		//exec("convert  ".$tmpname."_Final.png -scale 3600x4800 ".$tmpname."_Final.png");
		
	}


?>
