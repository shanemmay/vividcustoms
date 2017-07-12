<?php
   include('session.php');
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

  <script type="text/javascript">
    function ModifyInfo()
    {
        document.getElementById("infomessage").style.display = 'block';
    }

    function SearchDesing()
    {
      document.getElementById("errormessage").style.display = 'block';
    }

     function isMobile() 
      {
        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        if (isMobile) 
        {         
          //alert('mobile');   
          window.location.replace("uimobile.php");       
        }
        else
        {         
          //alert('windows');   
           window.location.replace("ui.php");       
        }          
           
    }
  </script>
</head>

<body>

 <div class="card text-center">
    <div class="card-header" align="right">
     <?php 
            if (!isset($_SESSION['Guest'])) {
                echo 'Welcome: '.$login_session; 
                echo  '<p><a href = "logout.php">Sign Out</a></p>';    
            }  
             else 
            {
              echo ("<center> Order number: ".$_SESSION['Guest']."</center>");         
            }           
      ?>
    </div>
    <div class="card-block">
    
    <ul class="nav nav-tabs justify-content-center" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#Desings" role="tab">Make Desings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#Orders" role="tab">Previous Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#Info" role="tab">Change Personal Information</a>
      </li>     
    </ul>
     <!-- <h4 class="card-title">Special title treatment</h4>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>-->
      <div class="tab-content" style=" ">
        <div class="tab-pane active" id="Desings" role="tabpanel" style="">
          <center><div class="card" style="width: 50rem;">
            <div class="card-header">
              Make Desings
              </div>
               <div class="card-block">
                <div class="container">  
                    <div class="card card-inverse card-info mb-3 text-center">
                      <div class="card-block">
                        <blockquote class="card-blockquote">
                          <p>Here at VividCustoms we create custom quality apperal. Whether it's for business or a birthday, we got you covered!</p>
                          <footer>
                            <a href="javascript:isMobile();" class="btn btn-outline-primary btn-sm">Start now</a>
                            <cite title="Source Title">                              
                            </cite>
                          </footer>
                        </blockquote>
                      </div>
                    </div>
                </div>
               </div>
            </div></center>

        </div>
        <div class="tab-pane" id="Orders" role="tabpanel" style=""> 
          <center><div class="card" style="width: 50rem;">
            <div class="card-header">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errormessage" style="display: none;">
              <strong>Oh snap!</strong> Change a few things up and try submitting again.
            </div>
              Previous Orders
            </div>
             <div class="card-block">
              <div class="container">
               <div class="col-lg-6">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search desing...">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" onclick="SearchDesing();">Go!</button>
                  </span>
                </div>
              </div>
              </div>
             </div>
          </div></center> 
        </div>
        <div class="tab-pane" id="Info" role="tabpanel" style="">
         <center><div class="card" style="width: 50rem;">
            <div class="card-header">
            <div class="alert alert-info alert-dismissible fade show" role="alert" id="infomessage" style="display: none;">
              <strong>Well done!</strong> You personal information was modify successfully.
            </div>
              Personal Information
            </div>
             <div class="card-block">
              <div class="container">
                <form>
                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">First Name</label>
                    <div class="col-10">
                      <input class="form-control" type="text"  id="firstname" placeholder="First Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Last Name</label>
                    <div class="col-10">
                      <input class="form-control" type="text"  id="lastname" placeholder="Last Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="example-tel-input" class="col-2 col-form-label">Telephone</label>
                    <div class="col-10">
                      <input class="form-control" type="tel" id="phone" placeholder="Telephone">
                    </div>
                  </div>                 
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="button" class="btn btn-primary" onclick="ModifyInfo();">Modify</button>
                    </div>
                  </div>
                </form>
              </div>
             </div>
          </div></center>
         

        </div>        
      </div>

    </div>    
    <div class="card-footer text-muted">
      2 days ago
    </div>
  </div>



</body>
</html>
