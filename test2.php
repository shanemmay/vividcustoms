<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </head>
  <body>
  <div class="container">
 <div class="col-lg-6">
    <div class="input-group">
      <input id ="search" type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="Scan();">Search</button>	
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div>

<script type="text/javascript">
	
	/*function Scan()
	{
		var clipart = document.getElementById('search').value;

		$.ajax({
            type: "POST",
            url: "scan.php",
            data: {clipart : clipart},
            success: function(data)
            {            	
                console.log(data);
                //document.getElementById('clipArtTable2').innerHTML = data;
                //document.getElementById('clipArtTable2').style.display = "block";
            },
            error: function(data){
            	alert("there was an error processing your ajax function");
            }
        })                  
	} */

	function Scan() 
	{	
		var clipart = document.getElementById('search').value;			
	    var xhttp = new XMLHttpRequest();
	    xhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
	             console.log( this.responseText);
	        }
	    };
	    xhttp.open("GET", "scan.php?clipart="+clipart, true);
	    xhttp.send(); 
	}
</script>
  </body>
</html>