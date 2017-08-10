<?php
    include '../../session.php';
    include '../../config.php';
?>

<?php
	echo "php function triggered!";
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//$txt = $_POST['mData'].".\n";
//fwrite($myfile, $txt);
//$txt = $_POST['foo'].".\n";
//fwrite($myfile, $txt);
$txt = $_POST['mFile'].".\n";
fwrite($myfile, $txt);
fclose($myfile);
	//$dir getcwd();
	//move_uploaded_file($_FILES["image"]["test_product"], $dir . $_FILES["image"]["test_product"]);
?>