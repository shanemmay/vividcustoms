<?php
    include '../session.php';
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Vivid Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!-- Bootstrap core JS  -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- Custom styles for this template -->
    <!--jQuery CDN-->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <!--W3.JS (for sorting tables)-->
    <script src="https://www.w3schools.com/lib/w3.js"></script> 
    <style type="text/css">
      /*
      * Base structure
      */

      /* Move down content because we have a fixed navbar that is 50px tall */
      body {
        padding-top: 50px;
      }

      /*
       * Typography
       */

      h1 {
        margin-bottom: 20px;
        padding-bottom: 9px;
        border-bottom: 1px solid #eee;
      }

      /*
       * Sidebar
       */

      .sidebar {
        position: fixed;
        top: 51px;
        bottom: 0;
        left: 0;
        z-index: 1000;
        padding: 20px;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        border-right: 1px solid #eee;
      }

      /* Sidebar navigation */
      .sidebar {
        padding-left: 0;
        padding-right: 0;
      }

      .sidebar .nav {
        margin-bottom: 20px;
      }

      .sidebar .nav-item {
        width: 100%;
      }

      .sidebar .nav-item + .nav-item {
        margin-left: 0;
      }

      .sidebar .nav-link {
        border-radius: 0;
      }

      /*
       * Dashboard
       */

       /* Placeholders */
      .placeholders {
        padding-bottom: 3rem;
      }

      .placeholder img {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Dashboard</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault" style="display: block; margin-top: auto ; margin-bottom: auto ;">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active" style="display: block; margin-top: auto ; margin-bottom: auto ;">
            <a class="nav-link" href="#" style="display: block; margin-top: auto ; margin-bottom: auto ;">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item" style="display: block; margin-top: auto ; margin-bottom: auto ;">
            <a class="nav-link" href="#" style="display: block; margin-top: auto ; margin-bottom: auto ;">Settings</a>
          </li>
          <li class="nav-item" style="display: block; margin-top: auto ; margin-bottom: auto ;">
            <a class="nav-link" href="#" style="display: block; margin-top: auto ; margin-bottom: auto ;">Profile</a>
          </li>
          <li class="nav-item" style="display: block; margin-top: auto ; margin-bottom: auto ;">
            <a class="nav-link" href="#" style="display: block; margin-top: auto ; margin-bottom: auto ;">Help</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0" >
          <input class="form-control mr-sm-2" type="text" placeholder="Search" style="display: block; margin-top: auto ; margin-bottom: auto ; position: relative; top: 25%;">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="display: block; margin-top: auto ; margin-bottom: auto ; position: relative; top: 25%;">Search</button>
        </form>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">Overview <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Analytics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Export</a>
            </li>
          </ul>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">Nav item</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Nav item again</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">One more nav</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Another nav item</a>
            </li>
          </ul>

          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">Nav item again</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">One more nav</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Another nav item</a>
            </li>
          </ul>
        </nav>

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" style="margin-top: 1%;">

          <p>
  <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Link with href
  </a>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Button with data-target
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-block">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  </div>
</div>

        <table id="dashboard_sales_table" class="table table-striped">
        <tr>
          <th  onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(1)')">Order Number</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(2)')">Name</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(3)')">Phone</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(4)')">Email</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(5)')">Shipping Type</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(6)')">Street</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(7)')">City</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(8)')">State</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(9)')">Zip</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(10)')">Total</th>
          <th onclick="w3.sortHTML('#dashboard_sales_table','.sale', 'td:nth-child(11)')">Shipped</th>
        </tr>
        <?php
          //storing all data from cart in an array
          $cartResults = mysqli_query($db,"SELECT * FROM cart");
          $cartArr = [];
          $cartArrIndex = 0;
          while($cartRow = mysqli_fetch_array($cartResults)){
              $cartArr[$cartArrIndex] = $cartRow['OrderNumber'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['Product'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['yxs'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['ys'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['ym'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['yl'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['yxl'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['s'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['m'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['l'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['xl'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['_2xl'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['_3xl'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['_4xl'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['_5xl'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['_front'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['_right'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['_back'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['_left'];
              $cartArrIndex++;
              $cartArr[$cartArrIndex] = $cartRow['Price'];
              $cartArrIndex++;
          }
          //storing all data from sale in an array
           $saleResults = mysqli_query($db,"SELECT * FROM sale"); 
           $saleArr = [];
           $saleArrIndex = 0;
           while( $saleRow = mysqli_fetch_array($saleResults) ){ 
              $saleArr[$saleArrIndex] = $saleRow['OrderNumber'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['Name'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['Phone'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['Email'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['ShippingType'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['shipStreet'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['shipCity'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['shipState'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['shipZip'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['total'];
              $saleArrIndex++;
              $saleArr[$saleArrIndex] = $saleRow['Shipped'];
              $saleArrIndex++;
           }
            
            //printing table
            $cartCounter = 0;
            $saleCounter = 0;
            //used to see if there are multiple cart items in a sale
            $temp = "";
            for ($i=0; $i < count($cartArr) && $i < count($saleArr) ; $i++) { 
              //see if order number match, if not move on to the next sale in saleArr
              //echo "<br> saleArr i : ". $saleArr[$saleCounter];
              //echo "<br> cartArr i : ". $cartArr[$cartCounter];
              if ($saleArr[$saleCounter] == $cartArr[$cartCounter]) {
                //checking to see if this is the first item in the sale
                if($temp != $saleArr[$saleCounter]){
                  //creating row of sale 
                  echo '<tr>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+1].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+2].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+3].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+4].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+5].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+6].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+7].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+8].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+9].'</a></td>
                            <td><a data-toggle="collapse" href="#cart'.$saleArr[$saleCounter].'" aria-expanded="true" >'.$saleArr[$saleCounter+10].'</a></td>
                        </tr>';
                }
                echo '<tr><td colspan="11"><div class="collapse" id="cart'.$cartArr[$cartCounter].'">
                          <div class="card card-block">
                            <table>';
                $cartItems =   '<tr>
                                  <td>'.$cartArr[$cartCounter].'</td>
                                  <td>'.$cartArr[$cartCounter+1].'</td>
                                  <td>'.$cartArr[$cartCounter+2].'</td>
                                  <td>'.$cartArr[$cartCounter+3].'</td>
                                  <td>'.$cartArr[$cartCounter+4].'</td>
                                  <td>'.$cartArr[$cartCounter+5].'</td>
                                  <td>'.$cartArr[$cartCounter+6].'</td>
                                  <td>'.$cartArr[$cartCounter+7].'</td>
                                  <td>'.$cartArr[$cartCounter+8].'</td>
                                  <td>'.$cartArr[$cartCounter+9].'</td>
                                  <td>'.$cartArr[$cartCounter+10].'</td>
                                  <td>'.$cartArr[$cartCounter+11].'</td>
                                  <td>'.$cartArr[$cartCounter+12].'</td>
                                  <td>'.$cartArr[$cartCounter+13].'</td>
                                  <td>'.$cartArr[$cartCounter+14].'</td>
                                  <td>'.$cartArr[$cartCounter+15].'</td>
                                  <td>'.$cartArr[$cartCounter+16].'</td>
                                  <td>'.$cartArr[$cartCounter+17].'</td>
                                  <td>'.$cartArr[$cartCounter+18].'</td>
                                  <td>'.$cartArr[$cartCounter+19].'</td>
                                </tr>';
                    //adding any additional items to cartItems
                    $j = 20;
                    while($cartArr[$cartCounter+$j] == $saleArr[$saleCounter]){
                      $cartItems .=   '<tr>
                                  <td>'.$cartArr[$cartCounter+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+1+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+2+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+3+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+4+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+5+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+6+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+7+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+8+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+9+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+10+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+11+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+12+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+13+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+14+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+15+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+16+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+17+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+18+$j].'</td>
                                  <td>'.$cartArr[$cartCounter+19+$j].'</td>
                                </tr>';
                                $j += 20;
                    }
                    echo $cartItems;
                    echo      '</table>
                          </div>
                        </div><td></tr>';
                        $temp = $cartArr[$cartCounter];
                      $cartCounter += 20 ;
              }else{
                  $saleCounter++;
              }
            }

          /*$results = mysqli_query($db,"SELECT * FROM sale");

            $cartId = 0;
            while( $row = mysqli_fetch_array($results) ){
              


              $cart = "";
              foreach ($cartRow as $key => $value) {
                print_r(" key : " . $key );
                print_r(" value : " . $value );
                print_r(" row : " . $row['OrderNumber']  . "<br>");
                if($value == $row['OrderNumber']){
                  $cart = '<tr><td colspan="11"><div class="collapse" id="cart'.$cartId.'">
                          <div class="card card-block">
                            <table>
                                <tr>
                                  <td>'.$row['OrderNumber'].'</td><td>'.$key.'</td><td>'.$value.'</td>
                                </tr>
                            </table>
                          </div>
                        </div><td></tr>';             
                }
              }
              echo  ' <tr class="sale">
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="true" >'. $row['OrderNumber'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['Name'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['Phone'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['Email'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['ShippingType'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['shipStreet'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['shipCity'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['shipState'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['shipZip'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['total'].'</a></td> 
                       <td><a data-toggle="collapse" href="#cart'.$cartId.'" aria-expanded="false"  >'. $row['Shipped'].'</a></td> 
                      </tr>'.$cart;
              
              $cartId++;
            }*/

          ?>
          </table>

          <h4>Sales!</h4>
          <table id="dashboard_sales_table1" class="table table-striped" >
            <thead>
              <tr >
                <th >#</th>
                <th onclick="w3.sortHTML('#dashboard_sales_table1','.item', 'td:nth-child(2)')">First Name</th>
                <th onclick="w3.sortHTML('#dashboard_sales_table1','.item', 'td:nth-child(3)')">Last Name</th>
                <th onclick="w3.sortHTML('#dashboard_sales_table1','.item', 'td:nth-child(4)')">Username</th>
              </tr>
            </thead>
            <tbody>
              <tr class="item">
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr class="item">
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr class="item">
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>

          <script type="text/javascript">
            //alert('js working');
          </script>
        </div>
        <!--
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h1>Dashboard</h1>

          <section class="row text-center placeholders">
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <div class="text-muted">Something else</div>
            </div>
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          </section>

          <h2>Orders</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr class="row">
                  <th>#</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                </tr>
              </thead>
              <tbody>
                <tr class="row">
                  <td>1,001</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>dolor</td>
                  <td>sit</td>
                </tr>
                <tr class="row">
                  <td>1,002</td>
                  <td>amet</td>
                  <td>consectetur</td>
                  <td>adipiscing</td>
                  <td>elit</td>
                </tr>
                <tr class="row">
                  <td>1,003</td>
                  <td>Integer</td>
                  <td>nec</td>
                  <td>odio</td>
                  <td>Praesent</td>
                </tr>
                <tr class="row">
                  <td>1,003</td>
                  <td>libero</td>
                  <td>Sed</td>
                  <td>cursus</td>
                  <td>ante</td>
                </tr>
                <tr class="row">
                  <td>1,004</td>
                  <td>dapibus</td>
                  <td>diam</td>
                  <td>Sed</td>
                  <td>nisi</td>
                </tr>
                <tr class="row">
                  <td>1,005</td>
                  <td>Nulla</td>
                  <td>quis</td>
                  <td>sem</td>
                  <td>at</td>
                </tr>
                <tr class="row">
                  <td>1,006</td>
                  <td>nibh</td>
                  <td>elementum</td>
                  <td>imperdiet</td>
                  <td>Duis</td>
                </tr>
                <tr class="row">
                  <td>1,007</td>
                  <td>sagittis</td>
                  <td>ipsum</td>
                  <td>Praesent</td>
                  <td>mauris</td>
                </tr>
                <tr class="row">
                  <td>1,008</td>
                  <td>Fusce</td>
                  <td>nec</td>
                  <td>tellus</td>
                  <td>sed</td>
                </tr>
                <tr class="row">
                  <td>1,009</td>
                  <td>augue</td>
                  <td>semper</td>
                  <td>porta</td>
                  <td>Mauris</td>
                </tr>
                <tr class="row">
                  <td>1,010</td>
                  <td>massa</td>
                  <td>Vestibulum</td>
                  <td>lacinia</td>
                  <td>arcu</td>
                </tr>
                <tr class="row">
                  <td>1,011</td>
                  <td>eget</td>
                  <td>nulla</td>
                  <td>Class</td>
                  <td>aptent</td>
                </tr>
                <tr class="row">
                  <td>1,012</td>
                  <td>taciti</td>
                  <td>sociosqu</td>
                  <td>ad</td>
                  <td>litora</td>
                </tr>
                <tr class="row">
                  <td>1,013</td>
                  <td>torquent</td>
                  <td>per</td>
                  <td>conubia</td>
                  <td>nostra</td>
                </tr>
                <tr class="row">
                  <td>1,014</td>
                  <td>per</td>
                  <td>inceptos</td>
                  <td>himenaeos</td>
                  <td>Curabitur</td>
                </tr>
                <tr class="row">
                  <td>1,015</td>
                  <td>sodales</td>
                  <td>ligula</td>
                  <td>in</td>
                  <td>libero</td>
                </tr>
              </tbody>
            </table>
          </div>
        </main>
        -->
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
