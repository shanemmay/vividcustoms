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

	 $ses_sql = mysqli_query($db,"Select Quantity From consecutive where Name = 'Order'");	   
	 $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);		   
	 $route = $route.'/'.$login_session.'_'.sprintf("%06d", $row['Quantity']);		   
	 //if (!is_dir($route)) {
	   mkdir($route,0777,true);
	//}  
	 $ses_sql = mysqli_query($db,"Update consecutive set Quantity = Quantity + 1 where Name = 'Order'");	


     for ($i=0; $i < count($data) -1 ; $i++) {     
           		
     	$filteredData = substr($data[$i], strpos($data[$i], ",")+1);        
		 $decodedData=base64_decode($filteredData);

	    $name = "";        
	   	switch ($i) {
	   		case 0:
	   			$name = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_front";
	   			createFile($decodedData,1,$name,$route);  	
	   			break;
	   		case 1:
	   			$name = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_right";
	   			createFile($decodedData,1,$name,$route);  	
	   			break;
			case 2:
					$name = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_back";
					createFile($decodedData,1,$name,$route);  	
	   			break;
	   		case 3:
					$name = $login_session.'_'.sprintf("%06d", $row['Quantity'])."_left";
					createFile($decodedData,1,$name,$route);  	
	   			break;
	   		default:
	   			$name = $login_session.rand(1000,9999);	   	
	   			createFile($decodedData,1,$name,$route);  			
	   			break;
	   	}	   	           	   
    }    
   
	$file = $login_session.'_'.sprintf("%06d", $row['Quantity']).'.json';
	file_put_contents($route.'/'.$file, $data[count($data)-1]);


	//print_r('The desing "'.$login_session.'_'.sprintf("%06d", $row['Quantity']). '" was save successful.'); 
	print_r($login_session.'_'.sprintf("%06d", $row['Quantity'])); 
	
	//return 'The desing "'.$login_session.'_'.sprintf("%06d", $row['Quantity']). '" was save successful.';
     
   }     

        
	function createFile($decodedData,$resolution,$filename,$route)
	{        
	    //$fic_name = 'image_'.rand(1000,9999).'.png';
	    $fic_name = $route.'/'.$filename.'.png';        
	    $fp = fopen($fic_name, 'wb');
	    $ok = fwrite( $fp, $decodedData);
	    fclose( $fp );
	    if($resolution == 1)
	    {
	        setImageResolution($fic_name,$filename,$route);	       
	    }      
	}


function setImageResolution($imagePath,$filename,$route)
{	
    $imagick = new \Imagick(realpath($imagePath));  
	$imagick->setImageUnits(Imagick::RESOLUTION_PIXELSPERINCH);	
	$imagick->resampleImage  (300,300,imagick::FILTER_UNDEFINED,1);	
	file_put_contents( $imagePath, $imagick);
	//$finalimage = new Imagick();
	//$finalimage = $imagick;
	
    //imagecreatefrompng($imagick);
	/*$combined   =   new Imagick();
	$combined->addImage( $imagick );
	$combined->setImageFormat("pdf");   
	file_put_contents ($route.'/'.$filename.".pdf", $combined); 	
	unlink($route.'/'.$filename.".png");*/	
	
}
?>