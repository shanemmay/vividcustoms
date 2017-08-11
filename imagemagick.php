<?php


readJSon("Guest000103_000690_front.json","Guest000103_000690_front");




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
				 			exec(" convert -size  120x160 xc:lightblue  -fill blue -stroke 1 -gravity center -pointsize 40  -draw 'text 0,0 ".$objects["text"]."' floodfill ".$tmpname."_tmpText.png");	
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