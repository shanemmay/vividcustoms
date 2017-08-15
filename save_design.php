<?php
	include("config.php");
    session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {      
      
     $data = explode('*',file_get_contents("php://input"));	  
     if (isset($_SESSION['login_user'])) {
          $login_session =$_SESSION['login_user'];	
      }
      else
      {
      	  if (empty($_SESSION['Guest'])) {
      	  	 $ses_sql = mysqli_query($db,"Select Quantity From consecutive where Name = 'Guest'");	   
			 $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);		   
			 $login_session = "Guest". sprintf("%06d", $row['Quantity']);
			 $_SESSION['Guest'] = $login_session;
			 $ses_sql = mysqli_query($db,"Update consecutive set Quantity = Quantity + 1 where Name = 'Guest'");	
      	  }  
      	  else
      	  {
      	  	$login_session = $_SESSION['Guest'];
      	  }   	
      } 
     
     $route = dirname(__FILE__).'/'.$login_session;
     if (!is_dir($route)) {
	   mkdir($route,0777,true);
	 }

	 $ses_sql = mysqli_query($db,"Select Quantity From consecutive where Name = 'Design'");	   
	 $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);		   
	 $route = $route.'/'.$login_session.'_'.sprintf("%06d", $row['Quantity']);		   
	 //if (!is_dir($route)) {
	   mkdir($route,0777,true);
	//}  
	 $ses_sql = mysqli_query($db,"Update consecutive set Quantity = Quantity + 1 where Name = 'Design'");	
	
	//$file = $login_session.'_'.sprintf("%06d", $row['Quantity']).'.json';
	//file_put_contents($route.'/'.$file, $data[count($data)-1]);

     for ($i=0; $i < 4; $i++) {     
           		
     	 $filteredData = substr($data[$i], strpos($data[$i], ",")+1);        
		 $decodedData=base64_decode($filteredData);

	    $name = "";        
	   	switch ($i) {
	   		case 0:
	   				$file = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_front.json";
					file_put_contents($route.'/'.$file,$data[$i+4]);
		   			$name = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_front";
		   			createFile($decodedData,1,$name,$route,$file);
		   			  	
	   			break;
	   		case 1:
	   				$file = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_right.json";
					file_put_contents($route.'/'.$file,$data[$i+4]);
		   			$name = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_right";
		   			createFile($decodedData,1,$name,$route,$file);  		   			 	
	   			break;
			case 2:					 	
					$file = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_back.json";
					file_put_contents($route.'/'.$file,$data[$i+4]); 
					$name = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_back";
					createFile($decodedData,1,$name,$route,$file); 
	   			break;
	   		case 3:					
					$file = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_left.json";
					file_put_contents($route.'/'.$file,$data[$i+4]); 	
					$name = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_left";
					createFile($decodedData,1,$name,$route,$file);  
	   			break;
	   		default:
	   			//$file = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_".$i.'.json';
				//file_put_contents($route.'/'.$file,$data[$i]);  			
	   			break;
	   	}	   	           	   
    }    
   
	


	//print_r('The desing "'.$login_session.'_'.sprintf("%06d", $row['Quantity']). '" was save successful.'); 
	print_r($login_session.'_'.sprintf("%06d", $row['Quantity'])); 
	
	//return 'The desing "'.$login_session.'_'.sprintf("%06d", $row['Quantity']). '" was save successful.';
     
   }     

        
	function createFile($decodedData,$resolution,$filename,$route,$file)
	{        
	    //$fic_name = 'image_'.rand(1000,9999).'.png';
	    //$tmproute = $route.'/'.$filename;
	    $fic_name = $route.'/'.$filename.'.png';        
	    $fp = fopen($fic_name, 'wb');
	    $ok = fwrite( $fp, $decodedData);
	    fclose( $fp );
	    if($resolution == 1)
	    {
	    	readJSon($route.'/'.$file, $route.'/'.$filename);
	        //setImageResolutionNew($fic_name);
	        //setImageResolution($fic_name,$filename,$route);	       
	    }      
	}

	/*function setImageResolutionNew($imagePath)
	{	
	 	exec("convert img/clip_art/Shapes/Crowns/anchor1.png -density 300 -units PixelsPerInch ".$imagePath);
		exec("convert  ".$imagePath." -scale 3600x4800 ".$imagePath);
		exec(" convert -size 600x600 xc:none -fill red -stroke black  -font Candice -pointsize 90 -rotate 30 -gravity center -draw 'text example 0,0 Hello' BearsText.png");
		exec("convert -size 3600x4800 xc:none ".$imagePath." -geometry 3600x4800 +0+0 -composite BearsText.png -geometry 3600x4800 +0+0 -composite  ".$imagePath);
		//exec("convert ".$imagePath." -depth 300 -units pixelsperinch".$imagePath);
		//exec("convert ".$imagePath." -sample 3600x4800".$imagePath);
		//exec("convert ".$imagePath." -filter Sinc -resize 3600x4800".$imagePath);
		//exec("convert ".$imagePath." -filter Gaussian -resize 600%".$imagePath);
	}*/


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
						 			/*print_r("<b>&nbsp;type: </b>".$filter["type"]."<br>");
						 			$color=.$filter["color"]."<br>");
						 			print_r("<b>&nbsp;opacity: </b>".$filter["opacity"]."<br>");*/						 			
						 		}
					 		}
				 			$pos = strpos($objects["src"],'img');				 		
				 			$OrigenIMG = substr($objects['src'], $pos, strlen($objects['src'])); 						 		
				 			//put later -scale 3600x4800
				 			exec("convert ".$OrigenIMG." -fuzz 100%  -fill '".$color."' -opaque black -rotate ".$objects["angle"]."  -scale ".$objects["width"]."x".$objects["height"]." +antialias ".$tmpname."_tmpImage.png");				 			
				 			//good
				 			exec("convert -size ".$width."x".$height." xc:none ".$tmpname."_tmpImage.png  -geometry ".$objects["width"]."x".$objects["height"]."+".$objects["top"]."+".$objects["left"]." -composite  ".$tmpname."_baseImage.png -geometry ".$width."x".$height." +0+0 -composite  ".$tmpname."_baseImage.png");

				 			//exec("convert -size ".$width."x".$height." xc:none ".$OrigenIMG." -rotate ".$objects["angle"]." -fill '".$color."' -virtual-pixel tile -geometry ".$objects["width"]."x".$objects["height"]."+0+0 -composite  ".$tmpname."_baseImage.png -geometry ".$width."x".$height." +0+0 -composite  ".$tmpname."_baseImage.png");

				 			//unlink($route.'/'.$filename."_tmpImage.png");
				 		}
				 		if ($objects["type"] == 'text') 
				 		{				 			

				 			//exec("convert -size ".$objects["width"]."x".$objects["height"]." xc:none -font 'css/".$objects["fontFamily"].".ttf"."' -density 100 -fill '".$objects["fill"]."' -stroke '".$objects["stroke"]."'  -pointsize '".$objects["fontSize"]."'  -annotate +25+25 '".$objects["text"]."' ".$tmpname."_tmpText2.png");

				 			exec(" convert -size  ".$objects["width"]."x".$objects["height"]." xc:none  -fill '".$objects["fill"]."' -stroke '".$objects["stroke"]."' -font 'css/".$objects["fontFamily"].".ttf' -gravity center -pointsize '".$objects["fontSize"]."'  -draw 'text 0,0 ".$objects["text"]."' floodfill ".$tmpname."_tmpText.png");		
				 			//good
				 			exec("convert -size ".$width."x".$height." xc:none ".$tmpname."_tmpText.png  -geometry ".$objects["width"]."x".$objects["height"]."+0+0 -composite  ".$tmpname."_baseImage.png -geometry ".$width."x".$height." +0+0 -composite  ".$tmpname."_baseImage.png");	

				 			//unlink($route.'/'.$filename."_tmpText.png");	 			
				 		}					 		
					}	
		   		}

		   		
		    } 
		    //exec("convert -size ".$width."x".$height." xc:none ".$tmpname."_tmpImage.png  -geometry ".$width."x".$height."+".$objects["top"]."+".$objects["top"]." -composite  ".$tmpname."_tmpText.png -geometry ".$width."x".$height." ".$objects["top"]."+".$objects["left"]." -composite  ".$tmpname."_Image.png");
		    //exec("convert -size ".$width."x".$height." xc:none ".$tmpname."_baseImage.png  -geometry ".$width."x".$height."+".$objects["top"]."+0 -composite  ".$tmpname."_tmpText.png -geometry ".$width."x".$height." +0+0 -composite  ".$tmpname."_baseImage1.png");
		   // exec("convert -size ".$width."x".$height." xc:none ".$tmpname."_baseImage.png  -geometry ".$width."x".$height."+".$objects["top"]."+0 -composite  ".$tmpname."_tmpImage.png -geometry ".$width."x".$height." +0+0 -composite  ".$tmpname."_baseImage2.png");
		    //exec("convert -size ".$width."x".$height." xc:none ".$tmpname."_baseImage1.png  -geometry ".$width."x".$height."+".$objects["top"]."+0 -composite  ".$tmpname."_baseImage2.png -geometry ".$width."x".$height." +0+0 -composite  ".$tmpname."_baseImage.png");
		    //exec("convert -size ".$width."x".$height." xc:none  ".$tmpname."_baseImage.png  -geometry ".$width."x".$height."+".$objects["top"]."+0 -composite  ".$tmpname."_tmpText.png  -geometry ".$width."x".$height."+".$objects["top"]."+0 -composite  ".$tmpname."_tmpImage.png -geometry ".$width."x".$height." +0+0 -composite  ".$tmpname."_baseImage2.png");
		}

		//finaly convertion
		exec("convert ".$tmpname."_baseImage.png -density 300 -units PixelsPerInch ".$tmpname."_Final.png");
		exec("convert  ".$tmpname."_Final.png -scale 3600x4800 ".$tmpname."_Final.png");
		
	}

	/*function setImageResolution($imagePath,$filename,$route)
	{	

	 //$imagick = new \Imagick(realpath($imagePath));  
	    $image = new Imagick($imagePath); // default 72 dpi image
	    $image->setImageUnits(Imagick::RESOLUTION_PIXELSPERINCH);
	    $image->setImageResolution(300, 300);
	    //$image->setOption('density','3600x4800');
	    //$image->resizeimage(3600,4800,Imagick::FILTER_LANCZOS,1);
	    //$image->blurImage(7,7);
		//$image->resampleImage (300,300,imagick::FILTER_UNDEFINED,1);
		$image->writeImage($imagePath); 

	   // $imagick = new \Imagick(realpath($imagePath));  
		//$imagick->setImageUnits(Imagick::RESOLUTION_PIXELSPERINCH);	
		//$imagick->resampleImage (300,300,imagick::FILTER_UNDEFINED,1);
		//$imagick->setResolution(3000,3000);
		//$imagick->setImageProperty('Exif:Make', 'Imagick');

		//file_put_contents( $imagePath, $imagick);*
		//$finalimage = new Imagick();
		//$finalimage = $imagick;
		
	    //imagecreatefrompng($imagick);
		//$combined   =   new Imagick();
		//$combined->addImage( $imagick );
		//$combined->setImageFormat("pdf");   
		//file_put_contents ($route.'/'.$filename.".pdf", $combined); 	
		//unlink($route		
	}*/
?>