<?php
    include '../session.php';
    include '../config.php';
?>

<!--<h1>Order Details!</h1>-->

<?php
	//storing customer information in variables
	$OrderNumber = $_GET['OrderNumber'];
	$Name = $_GET['Name'];
	$Phone = $_GET['Phone'];
	$Email = $_GET['Email'];
	$ShippingType = $_GET['ShippingType'];
	$shipStreet = $_GET['shipStreet'];
	$shipCity = $_GET['shipCity'];
	$shipState = $_GET['shipState'];
	$shipZip = $_GET['shipZip'];
	$total = $_GET['total'];
	$shipped = $_GET['Shipped'];

	//storing payment informatin into variables
	$nameOnCard = $_GET['nameOnCard'];
	$cardNumber = $_GET['cardNumber'];
	$expirationDate = $_GET['expirationDate'];
	$securityCode = $_GET['securityCode'];
	$billingStreet = $_GET['billingStreet'];
	$billingCity = $_GET['billingCity'];
	$billingState = $_GET['billingState'];
	$billingZip = $_GET['billingZip'];

	//showing error if there was no order number
	if( !empty($_GET['OrderNumber']) ){
		//echo $OrderNumber;
	}else{
		echo '<div class="alert alert-info" role="alert">
			  <strong>Wait a minute...</strong> You forgot to ask for an order number. How the heck am I suppose to help you? 
			</div>';
	}
	//displaying info of customer
	/*echo "<h3>Info</h3>";
	echo "Name : " . $Name;
	echo "Phone : " . $Phone;
	echo "Email : " . $Email;
	echo "ShippingType : " . $ShippingType;
	echo "shipStreet : " . $shipStreet;
	echo "shipCity : " . $shipCity;
	echo "shipState : " . $shipState;
	echo "shipZip : " . $shipZip;
	echo "Total : " . $Total;
	echo "Shipped : " . $shipped;*/

	//Getting order details from `cart` details
	$sql = "SELECT * FROM `cart` WHERE `OrderNumber` = '".$OrderNumber."' ";	
	$result = $db->query($sql);

	//displaying item details
	/*echo "<h3>Items</h3>
		<table>";
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		echo "<tr>";
		echo "<td>".$row['OrderNumber']."</td>";
		echo "<td>".$row['Product']."</td>";
		echo "<td>".$row['yxs']."</td>";
		echo "<td>".$row['ys']."</td>";
		echo "<td>".$row['ym']."</td>";
		echo "<td>".$row['yl']."</td>";
		echo "<td>".$row['yxl']."</td>";
		echo "<td>".$row['s']."</td>";
		echo "<td>".$row['m']."</td>";
		echo "<td>".$row['l']."</td>";
		echo "<td>".$row['xl']."</td>";
		echo "<td>".$row['_2xl']."</td>";
		echo "<td>".$row['_3xl']."</td>";
		echo "<td>".$row['_4xl']."</td>";
		echo "<td>".$row['_5xl']."</td>";
		echo "<td>".$row['_front']."</td>";
		echo "<td>".$row['_right']."</td>";
		echo "<td>".$row['_back']."</td>";
		echo "<td>".$row['_left']."</td>";
		echo "<td>".$row['Price']."</td>";
		echo "</tr>";
	}
	echo "</table>";*/
?>

<!--version 1-->
<div class="row">
	<div class="col">
		<div class="card card-outline-info mb-3 text-center">
		  <div class="card-block">
		    <h4>Info</h4>
		    <p>Name: <?php echo $Name; ?></p>
		    <p>Phone: <?php echo $Phone; ?></p>
		    <p>Email: <?php echo $Email; ?></p>
		  </div>
		</div>
	</div>
	<div class="col">
		<div class="card card-outline-info mb-3 text-center">
		  <div class="card-block">
		    <h4>Shipping</h4>
		    <p>Type of shipping: <?php echo $ShippingType;?></p>
		    <p>Address: <?php echo $shipStreet . "<br>" . $shipCity . ", " . $shipState . " " . $shipZip; ?></p>
		    <p><?php if($shipped == "0"){ echo '<div class="alert alert-danger" role="alert"> <strong>Not Shipped!</strong> </div>'; }else{ echo '<div class="alert alert-info" role="alert"> <strong>It\'s Shipped!</strong> Good Job Team! </div>';} ?></p>
		  </div>
		</div>
	</div>
	<div class="col">
		<div class="card card-outline-info mb-3 text-center">
		  <div class="card-block">
		    <h4>Billing</h4>
		    <p> <?php echo "Name : ".$nameOnCard.", Card Number : ".$cardNumber.", Expiration Date : ".$expirationDate.", Security Code : ".$securityCode;?></p>
		    <p>Address: <?php echo $billingStreet . "<br>" . $billingCity . ", " . $billingState . " " . $billingZip; ?></p>
		    <p>Total: $<?php echo $total; ?></p>
		  </div>
		</div>
	</div>
</div>
<!--begin table testing-->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap4.min.css">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>OrderNumber</th>
                <th>Product</th>
                <th>yxs</th>
                <th>ys</th>
                <th>ym</th>
                <th>yl</th>
                <th>yxl</th>
                <th>s</th>
                <th>m</th>
                <th>l</th>
                <th>xl</th>
                <th>2xl</th>
                <th>3xl</th>
                <th>4xl</th>
                <th>5xl</th>
                <th>front</th>
                <th>right</th>
                <th>back</th>
                <th>left</th>
                <th>Price</th>
            </tr>
        </thead>
       
        <tbody>
	        <?php
	        	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	        		//attemping to change 'product' so that it will show up as a message.
	        		//$product = substr_replace($row['Product'], '\'../../', 4, 1);
	        		//$product = substr_replace($product, '\'', -2, 1);
	        		$product = substr($row["Product"],5,-2);
	        		//echo $product;
					echo "<tr>";
					echo "<td>".$row['OrderNumber']."</td>";
					echo "<td style=\"background-image: url('https://vividcustoms.com/vivid_customs2/".$product."'); background-repeat: no-repeat; background-size: cover; background-position: center center; \"></td>";//<img src='https://vividcustoms.com/vivid_customs2/".$product."'>
					echo "<td>".$row['yxs']."</td>";
					echo "<td>".$row['ys']."</td>";
					echo "<td>".$row['ym']."</td>";
					echo "<td>".$row['yl']."</td>";
					echo "<td>".$row['yxl']."</td>";
					echo "<td>".$row['s']."</td>";
					echo "<td>".$row['m']."</td>";
					echo "<td>".$row['l']."</td>";
					echo "<td>".$row['xl']."</td>";
					echo "<td>".$row['_2xl']."</td>";
					echo "<td>".$row['_3xl']."</td>";
					echo "<td>".$row['_4xl']."</td>";
					echo "<td>".$row['_5xl']."</td>";
					echo "<td><img src='".$row['_front']."' style='height:104px;'></td>";
					echo "<td><img src='".$row['_right']."' style='height:104px;'></td>";
					echo "<td><img src='".$row['_back']."' style='height:104px;'></td>";
					echo "<td><img src='".$row['_left']."' style='height:104px;'></td>";
					echo "<td>".$row['Price']."</td>";
					echo "</tr>";
				}
			?>
            
        </tbody>
    </table>
	<script type="text/javascript">
		$(document).ready(function() {
		    var table = $('#example').DataTable( {
		        lengthChange: true//,
		        //buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
		    } );
		 
		   // table.buttons().container()
		    //    .appendTo( '#example_wrapper .col-md-6:eq(0)' );
		} );
	</script>
<!--end table testing-->

<!--
<div class="card-columns">
  <div class="card text-center">
    <div class="card-block">
      <h4 class="card-title">Customer</h4>
      <p class="card-text">Name: <?php echo $Name; ?></p>
      <p class="card-text">Phone: <?php echo $Phone; ?></p>
      <p class="card-text"> Email: <?php echo $Email; ?></p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card text-center">
    <div class="card-block">
      <h4 class="card-title">Shipping</h4>
      <p class="card-text">Type of shipping: <?php echo $ShippingType;?></p>
      <p class="card-text">Address: <?php echo $shipStreet . "<br>" . $shipCity . ", " . $shipState . " " . $shipZip; ?></p>
      <p class="card-text"> <?php if($shipped == "0"){ echo '<div class="alert alert-danger" role="alert"> <strong>Not Shipped!</strong> Hurry up Jerson! </div>'; }else{ echo '<div class="alert alert-info" role="alert"> <strong>It\'s Shipped!</strong> Good Job Team! </div>';} ?></p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <div class="card-block">
      <h4 class="card-title">Billing</h4>
      <p class="card-text">Payment: <?php echo "Name : Card Number : Expiration Date : Security Code : ";?></p>
      <p class="card-text">Address: <?php echo $shipStreet . "<br>" . $shipCity . ", " . $shipState . " " . $shipZip; ?></p>
      <p class="card-text">Total: $<?php echo $total; ?></p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
-->