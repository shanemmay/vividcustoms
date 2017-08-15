<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login Admin Panel</title>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  
  

</head>

<body>
<div class="row justify-content-md-center">
  <div class="col-sm"></div>
  <div class="col-sm">
      <div class="card text-center">
        <div class="card-header">
        </div>
        <div class="card-block">
          <h4 class="card-title">Login Admin Panel</h4>
         <form class="form-horizontal" id="Loginform" method="POST" action="login.php">
            <div class="input-group">
              <span class="input-group-addon">Username:</span>
              <input id="username" class="form-control" name="username" placeholder="Enter username" type="text">
            </div>     
            <br>                      
            <div class="input-group">
              <span class="input-group-addon">Passwoord:</span>
              <input id="password" class="form-control" name="password" placeholder="Enter passwoord" type="text">
            </div> 
            <br>  
              <button class="btn btn-primary" type="submit">Login</button>
          </form>
        </div>
        <div class="card-footer text-muted">          
        </div>
    </div>
  </div>
  <div class="col-sm"></div>
</div>
</body>
</html>




