<?php

	$dir = "img/clip_art";
	$files = array();
	$elements = 1;
	print_r('<table id="clipArtTable2" class="table table-fixed">');
	print_r('<tbody>');   
	$response = scan($dir);
	print_r('</tbody>');
	print_r('</table>');

	function scan($dir)
	{		
		print_r('    <tr>') ; 
		if(file_exists($dir)){
		
			foreach(scandir($dir) as $f)
			 {			
				if(!$f || $f[0] == '.') {
					continue; // Ignore hidden files
				}
				if(is_dir($dir . '/' . $f)) 
				{				
					scan($dir . '/' . $f);
				}			
				else 
				{
					if (strpos($f, $_GET['clipart']) !== false)
					{					
						/*$files[] = array(
							"name" => $f,
							"type" => "file",
							"path" => $dir . '/' . $f,
							"size" => filesize($dir . '/' . $f) // Gets the size of this file
						);*/
						if ($elements == 3 )
						{
							 print_r('    <tr>') ; 
						}	               
			            print_r('    <td height="100px" width="130px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
			            print_r('<img class="hover" src="'.$dir . '/' . $f.'" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
			            print_r('    </td>') ;
			            if ($elements == 3)
						{
							print_r('    </tr>') ; 
						}  
					}				
				}
				$elements++;
			}
		}
		print_r('    </tr>') ;	
	 }
?>