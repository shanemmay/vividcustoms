<?php
    include '../session.php';
    include '../config.php';
?>


<!--ADD PRODUCT-->
<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#add_product_form" aria-expanded="false" aria-controls="add_product_form">
+Product
</button>
<div class="collapse" id="add_product_form">
  <div class="card card-block">

		<form action="Catalog/add_product.php" method="post">
		  <div class="form-group">
		    <label for="style_number_input">Style Number</label>
		    <input type="text" class="form-control" id="style_number_input" placeholder="" name="style_number_input">
		  </div>
		  <div class="form-group">
		    <label for="image_input">Image</label>
		    <input type="file" class="form-control-file" id="image_input" aria-describedby="fileHelp" name="image_input" onchange="saveProductImage(this.files);">
		    <small id="fileHelp" class="form-text text-muted">Make sure image meets specifications.</small>
		  </div>
		  <div class="form-group">
		    <label for="name_input">Name</label>
		    <input type="text" class="form-control" id="name_input" placeholder="" name="name_input">
		  </div>
		  <div class="form-group">
		    <label for="sku_input">SKU</label>
		    <input type="text" class="form-control" id="sku_input" placeholder=" " name="sku_input">
		  </div>
		  <div class="form-group">
		    <label for="price_input">Price</label>
		    <input type="number" class="form-control" id="price_input" placeholder=" " name="price_input">
		  </div>
  		  <div class="form-group">
		    <label for="quantity_input">Quantity</label>
		    <input type="number" class="form-control" id="quantity_input" placeholder=" " name="quantity_input">
		  </div>
		  <div class="form-group">
		    <label for="visibility">Visibility</label>
		    <select class="form-control" id="visibility">
		      <option value="visibility">Visible</option>
		      <option value="invisible">Invisible</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="status">Status  </label>
		    <select class="form-control" id="status">
		      <option value="enabled">Enabled</option>
		      <option value="disabled">Disabled</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="brand_input">Brand</label>
		    <input type="text" class="form-control" id="brand_input" placeholder="" name="brand_input">
		  </div>
		  <div class="form-group">
		    <label for="product_description_input">Product Description</label>
		    <textarea class="form-control" id="product_description_input" rows="7" name="product_description_input"></textarea>
		  </div>
		  <div class="form-group">
		    <label for="size">Size</label>
		    <select class="form-control" id="size">
		    	<option value="yxs">yxs</option>
				<option value="ys">ys</option>
				<option value="ym">ym</option>
				<option value="yl">yl</option>
				<option value="yxl">yxl</option>
				<option value="s">s</option>
				<option value="m">m</option>
				<option value="l">l</option>
				<option value="xl">xl</option>
				<option value="2xl">2xl</option>
				<option value="3xl">3xl</option>
				<option value="4xl">4xl</option>
				<option value="5xl">5xl</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="small_colors">Small Quantity Colors</label>
		    <small id="small_colors_hint" class="form-text text-muted" >Hex colors separated by a comma</small>
		    <textarea class="form-control" id="small_colors" rows="3" aria-describedby="small_colors_hint" name="small_colors"></textarea>
		  </div>
		  <div class="form-group">
		    <label for="large_colors">Large Quantity Colors</label>
		    <small id="large_colors_hint" class="form-text text-muted" >Hex colors separated by a comma</small>
		    <textarea class="form-control" id="large_colors" rows="3" aria-describedby="large_colors_hint" name="large_colors"></textarea>
		  </div>
		  <div class="form-group">
		    <label for="categories">Categories</label>
		    <small id="categories_hint" class="form-text text-muted" >Categories separated by a comma</small>
		    <textarea class="form-control" id="categories" rows="3" aria-describedby="categories_hint" name="categories"></textarea>
		  </div>
		  <div class="form-group">
		    <label for="tags">Tags</label>
		    <small id="tags_hint" class="form-text text-muted" >Tags separated by a comma</small>
		    <textarea class="form-control" id="tags" rows="3" aria-describedby="tags_hint" name="tags"></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
  </div>
</div>

<br><br>

<!--TABLE OF PRODUCTS-->
  <table id="order_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>StyleNumber</th>
                <th>Image</th>
                <th>Name</th>
                <!--<th>Type</th>-->
                <th> Sku</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Visibility</th>
                <!--<th>Status</th>-->
                <th> Brand</th>
                <!--<th>Style</th>-->
                <!--<th>Department</th>-->
                <!--<th>Person</th>-->
                <th>Description</th>
                <th>Size</th>
                <th>SmallColors</th>
                <th>LargeColors</th>
                <th> Categories</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>


            <?php
	        	//getting data from table from database
		         $sql = "SELECT * FROM `product` ";
		         $result = $db->query($sql);
		         //displaying data to table on dashboard
		         while ($row = $result->fetch_array(MYSQLI_ASSOC) ) {
		         	echo "<tr>";
		         	echo "<td>". $row['StyleNumber'] . "</td>";
		         	echo "<td>". $row['Image'] . "</td>";
		         	echo "<td>". $row['Name'] . "</td>";
		         	//echo "<td>". $row['Type'] . "</td>";
		         	echo "<td>". $row['Sku'] . "</td>";
		         	echo "<td>". $row['Price'] . "</td>";
		         	echo "<td>". $row['Quantity'] . "</td>";
		         	echo "<td>". $row['Visibility'] . "</td>";
		         	//echo "<td>". $row['Status'] . "</td>";
		         	echo "<td>". $row['Brand'] . "</td>";
		         	//echo "<td>". $row['Style'] . "</td>";
		         	//echo "<td>". $row['Department'] . "</td>";
		         	//echo "<td>". $row['Person'] . "</td>";
		         	echo "<td>". $row['Description'] . "</td>";
		         	echo "<td>". $row['Size'] . "</td>";
		         	echo "<td>". $row['SmallColors'] . "</td>";
		         	echo "<td>". $row['LargeColors'] . "</td>";
		         	echo "<td>". $row['Categories'] . "</td>";
		         	echo "<td>". $row['Tags'] . "</td>";
		         	echo "<td><a href='#'><button class='btn btn-info'> Edit </button></a></td>";
		         	echo "</tr>";
		         }
	         
        	?> 

        </tbody>
    </table>

    <script type="text/javascript">
    	$(document).ready(function() {
		    $('#order_table').DataTable();
		} );

		function saveProductImage(file){
			console.log(file);
			//alert(file);
			if( file != undefined){
				//var formData = new FormData();
				//formData.append("image", file);
				$.ajax({
					url : "save_product_image.php",
					type : " POST ",
					//data : {d:"data"},
					success: function (x){
						alert(x.status);
					},
					error: function(){
						alert("error occured!");
						console.log("an error has occured!");
					}
				});
			}
		}
    </script>


<script>
  $(document).ready(function() {
    $('#add').click(function () {
      var name = $('#add').attr("data_id");
      var id = $('#add').attr("uid");
      var data = 'this could be where image data goes'; // this where i add multiple data using  ' & '

      $.ajax({
        type:"POST",
        cache:false,
        url:"Catalog/save_product_image.php",
        data : { foo : 'bar', bar : 'foo', mData : data },    // multiple data sent using ajax
        success: function (html) {
          $('#add').val('data sent sent');
          $('#msg').html(html);
        }
      });
      return false;
    });
  });
</script>

<span>
  <input type="button" class="gray_button" value="send data" id="add" data_id="1234" uid="4567" />
</span>
<span id="msg"></span>

<input type="file" name="file" id="file"  onchange="save_product_image(this);">
<script type="text/javascript">
	function save_product_image(input){
		console.log("start of js function");
		var reader = new FileReader();
		var image = new Image();
		var src = "";
		reader.onload = function (e){
			//src = e.target.result;
			//console.log(e.target.result);
			//src = reader.readAsDataURL(input.files[0]);
			image.src = reader.result;
		}
		reader.readAsDataURL(input.files[0]);


		console.log(reader);
		console.log(src);
	}
</script>