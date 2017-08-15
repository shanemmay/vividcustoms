<h1>Download Design</h1>
<p>Getting Designs</p>

<a href="../Guest000100/Guest000100_000641/Guest000100_000641_front.json" download="../Guest000100/Guest000100_000641/Guest000100_000641_front.json">Download JSON Test</a>
<?php
	$dir = "../";

	if($dh = opendir($dir)){
		while (($file = readdir($dh)) !== false) {
			//echo gettype($file);
			//echo "filename : " . $file . "<br>";
			//finding out if the $file has the name 'guest' in it and if it can be open
			if (strpos($file, "Guest") !== false && is_dir($dir ."/". $file) ) {
				
				echo "<hr>";
				echo  "File is Directory : " .is_dir($dir ."/". $file) . "<br>";
				$file_arr = scandir($dir."/".$file);
				print_r($file_arr);
				
				//now finding json file and opening its
				echo '<a href="'.'../'.$file."/".$file_arr[2]."/".$file_arr[2]."_front.json".'" download="'.'../'.$file."/".$file_arr[2]."/".$file_arr[2]."_front.json".'">Download JSON Test</a>';
				echo "<br>" ."../".$file."/".$file_arr[2]."/".$file_arr[2]."_front.json" . "<br>";
				$json_design_file = fopen("../".$file."/".$file_arr[2]."/".$file_arr[2]."_front.json" , "r"); //you may want to change the second parameter later
				echo fread($json_design_file, filesize("../".$file."/".$file_arr[2]."/".$file_arr[2]."_front.json" ));
				fclose($json_design_file);

				echo "<hr>";
			}
		}
		closedir($dh);
	}
?>