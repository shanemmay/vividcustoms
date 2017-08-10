<?php
    include '../session.php';
?>
<html>  
  <body>
  	<!--table of orders-->
  	


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
