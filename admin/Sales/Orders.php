<?php
    include '../session.php';
    include '../config.php';
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/table.css">
</head>  
  <body> 
  <!--start of sortable table of orders-->
  <table id="order_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Order Number</th>
                <th> Shipping Type</th>
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th> Total</th>
                <th>Shipped</th>
                <th>Details</th>
            </tr>
        </thead>

        <tbody>


            <?php
	        	//getting data from table from database
		         $sql = "SELECT * FROM `sale` ";
		         $result = $db->query($sql);
		         //displaying data to table on dashboard
		         while ($row = $result->fetch_array(MYSQLI_ASSOC) ) {
		         	echo "<tr>";
		         	echo "<td>". $row['Name'] . "</td>";
		         	echo "<td>". $row['Phone'] . "</td>";
		         	echo "<td>". $row['Email'] . "</td>";
		         	echo "<td>". $row['OrderNumber'] . "</td>";
		         	echo "<td>". $row['ShippingType'] . "</td>";
		         	echo "<td>". $row['shipStreet'] . "</td>";
		         	echo "<td>". $row['shipCity'] . "</td>";
		         	echo "<td>". $row['shipState'] . "</td>";
		         	echo "<td>". $row['shipZip'] . "</td>";
		         	echo "<td>". $row['total'] . "</td>";
		         	echo "<td>". $row['Shipped'] . "</td>";
		         	echo "<td><a href='main.php?folder=Sales&page=OrderDetails&OrderNumber=".$row['OrderNumber']."&Name=".$row['Name']."&Phone=".$row['Phone']."&Email=".$row['Email']."&ShippingType=".$row['ShippingType']."&shipStreet=".$row['shipStreet']."&shipCity=".$row['shipCity']."&shipState=".$row['shipState']."&shipZip=".$row['shipZip']."&total=".$row['total']."&Shipped=".$row['Shipped']."&nameOnCard=".$row['nameOnCard']."&cardNumber=".$row['cardNumber']."&expirationDate=".$row['expirationDate']."&securityCode=".$row['securityCode']."&billingStreet=".$row['billingStreet']."&billingCity=".$row['billingCity']."&billingState=".$row['billingState']."&billingZip=".$row['billingZip']."''><button class='btn btn-info'> Details </button></a></td>";
		         	echo "</tr>";
		         }
	         
        	?> 

        </tbody>
    </table>

    <script type="text/javascript">
    	$(document).ready(function() {
		    $('#order_table').DataTable();
		} );
    </script>


  <div class="row">
  <div class="col-4">
  	<div class="card sm" id="LifetimeSales" name="LifetimeSales">
	  <div class="card-header">
	    Lifetime Sales
	  </div>
	  <div class="card-block">
	    
	  </div>
	</div>
	<br>
	<div class="card" id="AverageOrders" name="AverageOrders">
	  <div class="card-header">
	    Average Orders
	  </div>
	  <div class="card-block">
	    
	  </div>
	</div>
	<br>
	<div class="card" id="Last5Orders" name="Last5Orders">
	  <div class="card-header">
	    Last 5 Orders
	  </div>
	  <div class="card-block">
	    
	  </div>
	</div>
	<br>
	<table class="table ">
	  <thead class="thead-inverse">
	    <tr>	      
	      <th>Customer</th>
	      <th>Items</th>
	      <th>Grand Total</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>	      
	      <td>Mark</td>
	      <td align="right">2</td>
	      <td align="right">99.6</td>
	    </tr>
	    <tr>	     
	      <td>Jacob</td>
	      <td align="right">31</td>
	      <td align="right">187.26</td>
	    </tr>
	    <tr>	      
	      <td>Larry</td>
	      <td align="right">90</td>
	      <td align="right">800.36</td>
	    </tr>
	  </tbody>
	</table>
  </div>
  <div class="col-8">
  	<div class="card text-center">
		  <div class="card-header">
		    <ul class="nav nav-tabs card-header-tabs">
		      <li class="nav-item">
		        <a class="nav-link active" href="#NavOrders">Orders</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#NavAmounts">Amounts</a>
		      </li>
		    </ul>
		  </div>
		  <div class="card-block">		    
		  </div>
		</div>
  </div>  
</div>
  </body>
</html>
