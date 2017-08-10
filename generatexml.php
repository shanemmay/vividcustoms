<?php

	$dom = new DOMDocument('1.0','UTF-8');
	$dom->formatOutput = true;
	$root = $dom->createElement('student');
	for ($i=0; $i <3 ; $i++) 
	{
		
		$dom->appendChild($root.$i);
		
	} 
		
	

	/*$result = $dom->createElement('result');
	$root->appendChild($result);

	$result->setAttribute('id', 1);
	$result->appendChild( $dom->createElement('name', 'Opal Kole') );
	$result->appendChild( $dom->createElement('sgpa', '8.1') );
	$result->appendChild( $dom->createElement('cgpa', '8.4') );*/

	echo '<xmp>'. $dom->saveXML() .'</xmp>';
	//$dom->save('result.xml') or die('XML Create Error');
?>