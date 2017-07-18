
<?php
	$frontImageURL = $_POST['frontImageURL'];
	$frontShirtURL = $_POST['frontShirtURL'];
	$rightImageURL = $_POST['rightImageURL'];
	$rightShirtURL = $_POST['rightShirtURL'];
	$backImageURL = $_POST['backImageURL'];
	$backShirtURL = $_POST['backShirtURL'];
	$leftImageURL = $_POST['leftImageURL'];
	$leftShirtURL = $_POST['leftShirtURL'];



$to = $_POST['email'];
$subject = 'Share Design Alpha Test';
$from = "info@vividcustoms.com";
$message = "<!DOCTYPE html>
<html>
<head>
	<title>Design</title>
</head>
<body style='text-align: center; color: #0000ff;''>
<h1>Check out this new design made with Vivid Customs!</h1>
<p>\"I just created this design. Take a look!\"</p>
<table border='0' align='center'>
	<tbody>
		<tr>
			<td><div style='background-image: url(".$frontShirtURL."); background-repeat: no-repeat; background-size: cover; background-position: center center; width: 300px; height: 400px;'>
			<img src='".$frontImageURL."' style='padding-top:45px; padding-left:35px; padding-right:35px; width: 230px; height: 315px; position: relative; margin: auto; '>
			</div> </td>
			<td><div style='background-image: url(".$rightShirtURL."); background-repeat: no-repeat; background-size: cover; background-position: center center; width: 300px; height: 400px;'>
			<img src='".$rightImageURL."' style='padding-top:40px; padding-left:30px; padding-right:30px; width: 240px; height: 320px; position: relative; margin: auto; '>
			</div></td>
			<td><div style='background-image: url(".$backShirtURL."); background-repeat: no-repeat; background-size: cover; background-position: center center; width: 300px; height: 400px;'>
			<img src='".$backImageURL."' style='padding-top:40px; padding-left:30px; padding-right:30px; width: 240px; height: 320px; position: relative; margin: auto; '>
			</div> </td>
			<td><div style='background-image: url(".$leftShirtURL."); background-repeat: no-repeat; background-size: cover; background-position: center center; width: 300px; height: 400px;'>
			<img src='".$leftImageURL."' style='padding-top:40px; padding-left:30px; padding-right:30px; width: 240px; height: 320px; position: relative; margin: auto; '>
			</div></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
<h3>Our representative is available to assist you!</h3>
<p>Monday - Friday | 9:00 AM - 5:00 PM Central Standard Time</p>
<table border='0' align='center'>
	<tbody>
		<tr>
			<td><h3>Phone : (832) 429-7699 |</h3></td>
			<td><h3>Online : Live Chat! |</h3></td>
			<td><h3>Email : info@vividcustoms.com |</h3></td>
			<td><h3>In Person : 6222 Gessner Rd unit C, Houston Texas 77040</h3></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>


</body>
</html>";

$headers = "From: johnsmith@vividcustoms.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 

mail($to, 	$subject, 	$message, $headers);

//header("Location: index.php"); 
?>

<script type="text/javascript">
 	window.location.href = "http://vividcustoms.com/vivid_customs2";
</script>

 <table>
<?php 


    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }


?>
</table>