<?php
    include '../session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vivid Admin</title>

    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

 
   <link href="css/sb-admin.css" rel="stylesheet">

   <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.min.js"></script>
   <!-- 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    -->
<style type="text/css">
    html {
  font-size: 14px;
}

@include media-breakpoint-up(sm) {
  html {
    font-size: 16px;
  }
}

@include media-breakpoint-up(md) {
  html {
    font-size: 20px;
  }
}

@include media-breakpoint-up(lg) {
  html {
    font-size: 28px;
  }
}
</style>
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="main.php">Vivid Customs Admin Panel</a>
        <div class="collapse navbar-collapse" id="navbarExample">
            <ul class="sidebar-nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="main.php?page=Dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Sale"><i class="fa fa-line-chart""></i> Sale</a>
                    <ul class="sidebar-second-level collapse" id="Sale">
                        <li>
                            <a href="main.php?folder=Sales&page=Orders">Orders</a>                            
                        </li>
                        <li>
                            <a href="main.php?folder=Sales&page=Invoices">Invoices</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Sales&page=Shipments">Shipments</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Sales&page=CreditMemos">Credit Memos</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Sales&page=Transactions">Transactions</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Sales&page=RecurringProfiles">Recurring Profiles</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Sales&page=Orders">Billing Agreements</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Sales&page=BillingAgreements">Termns and conditions</a>
                        </li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#Tax">Tax</a>
                            <ul class="sidebar-third-level collapse" id="Tax">
                                <li>
                                    <a href="main.php?folder=Sales&page=ManageTaxRules">Manage Tax Rules</a>
                                </li>
                                <li>
                                    <a href="main.php?folder=Sales&page=ManageTaxZoneRates">Manage Tax Zone &amp; Rates</a>
                                </li>
                                <li>
                                    <a href="main.php?folder=Sales&page=ImportExportTaxRates">Import / Export Tax Rates</a>
                                </li>
                                <li>
                                    <a href="main.php?folder=Sales&page=CustomerTaxClasses">Customer Tax Classes</a>
                                </li>
                                <li>
                                    <a href="main.php?folder=Sales&page=ProductTaxClasses">Product Tax Classes</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Catalog"><i class="fa fa-folder-o"></i> Catalog</a>
                    <ul class="sidebar-second-level collapse" id="Catalog">
                        <li>
                            <a href="main.php?folder=Catalog&page=ManageProducts">Manage Products</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Catalog&page=ManageCategories">Manage Categories</a>
                        </li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#Attributes">Attributes</a>
                            <ul class="sidebar-third-level collapse" id="Attributes">
                                <li>
                                    <a href="main.php?folder=Catalog&page=ManageAttributes">Manage Attributes</a>
                                </li>
                                <li>
                                    <a href="main.php?folder=Catalog&page=ManageAttributesSet">Manage Attributes Set</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="main.php?folder=Catalog&page=URLRewriteManagement">URL Rewrite Management</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Catalog&page=SearchTerms">Search Terms</a>
                        </li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#Reviews">Reviews and Ratings</a>
                            <ul class="sidebar-third-level collapse" id="Reviews">
                                <li>
                                    <a href="main.php?folder=Catalog&page=CustomerReviews">Customer Reviews</a>
                                </li>
                                <li>
                                    <a href="main.php?folder=Catalog&page=ManageRatings">Manage Ratings</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#Tags">Tags</a>
                            <ul class="sidebar-third-level collapse" id="Tags">
                                <li>
                                    <a href="main.php?folder=Catalog&page=AllTags">All Tags</a>
                                </li>
                                <li>
                                    <a href="main.php?folder=Catalog&page=PendingsTags">Pendings Tags</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="main.php?folder=Catalog&page=GoogleSitemap">Google Sitemap</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Customers"><i class="fa fa-user-o"></i> Customers</a>
                    <ul class="sidebar-second-level collapse" id="Customers">
                        <li>
                            <a href="main.php?folder=Customers&page=Manage Customers">Manage Customers </a>
                        </li>
                        <li>
                            <a href="main.php?folder=Customers&page=ManageGroups">Manage Groups</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Customers&page=OnlineCustomers">Online Customers</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti"><i class="fa fa-podcast"></i> Promotions</a>
                    <ul class="sidebar-second-level collapse" id="collapseMulti">
                        <li>
                            <a href="main.php?folder=Promotions&page=CatalogPriceRules">Catalog Price Rules</a>
                        </li>
                        <li>
                            <a href="main.php?folder=Promotions&page=ShoppingCartPriceRules">Shopping Cart Price Rules</a>
                        </li>                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main.php?folder=Shane&page=index"><i class="fa fa-fw fa-dashboard"></i> Shane</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="messagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-envelope"></i> <span class="hidden-lg-up">Messages <span class="badge badge-pill badge-primary">12 New</span></span>
                        <span class="new-indicator text-primary hidden-md-down"><i class="fa fa-fw fa-circle"></i><span class="number">12</span></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">New Messages:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>David Miller</strong> <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>Jane Smith</strong> <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>John Doe</strong> <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">
                            View all messages
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="alertsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i> <span class="hidden-lg-up">Alerts <span class="badge badge-pill badge-warning">6 New</span></span>
                        <span class="new-indicator text-warning hidden-md-down"><i class="fa fa-fw fa-circle"></i><span class="number">6</span></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                        <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                    </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fa fa-fw fa-sign-out"></i> Logout <?php   echo($_SESSION['login_user']); ?> </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper py-3">

        <div class="container-fluid">

            <!-- Breadcrumbs -->
            <ol class="breadcrumb" id="DashboardMenu">                
                 <?php 
                    if(!empty($_GET["page"]) && !empty($_GET["page"])) 
                    {
                        //main.php?folder=Catalog&page=GoogleSitemap
                        echo '<li class="breadcrumb-item">'.$_GET["folder"].'</li>';    
                        echo '<li class="breadcrumb-item"><a href="main.php?folder='.$_GET["folder"]."&page=".$_GET["page"].'">'.$_GET["page"].'</a></li>'; 
                    }
                    else
                    {
                         echo '<li class="breadcrumb-item"><a href="main.php">Dashboard</a></li>'; 
                    }
                ?>

            </ol>

            <!-- Icon Cards -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card card-inverse card-primary o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5">
                                26 New Messages!
                            </div>
                        </div>
                        <a href="#" class="card-footer clearfix small z-1">
                            <span class="float-left">View Details</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card card-inverse card-success o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">
                                11 New Tasks!
                            </div>
                        </div>
                        <a href="#" class="card-footer clearfix small z-1">
                            <span class="float-left">View Details</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card card-inverse card-warning o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-shopping-cart"></i>
                            </div>
                            <div class="mr-5">
                                123 New Orders!
                            </div>
                        </div>
                        <a href="#" class="card-footer clearfix small z-1">
                            <span class="float-left">View Details</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card card-inverse card-danger o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-support"></i>
                            </div>
                            <div class="mr-5">
                                13 New Tickets!
                            </div>
                        </div>
                        <a href="#" class="card-footer clearfix small z-1">
                            <span class="float-left">View Details</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Area Chart Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-area-chart"></i> 
                    <?php 
                        if(!empty($_GET["page"])) 
                           echo $_GET["page"];
                        else
                           echo "Dashboard";
                    ?>
                </div>
                <div class="card-block">
       
                   <?php

                        if(!empty($_GET["folder"]) && !empty($_GET["page"]))
                        {
                           if (file_exists($_GET["folder"]."/".$_GET["page"].".php"))
                            {
                                include($_GET["folder"]."/".$_GET["page"].".php");  
                            }
                            else
                            {
                               echo' <div class="alert alert-danger" role="alert">
                                  <strong>Oh snap!</strong> We are sorry. The website is under construction.
                                </div>


                                ';
                            }                            
                        }
                        else
                        {
                            if (file_exists($_GET["page"].".php"))
                            {
                                include($_GET["page"].".php");  
                            }
                            else
                            {
                               echo' <div class="alert alert-danger" role="alert">
                                  <strong>Oh snap!</strong> We are sorry. The website is under construction.
                                </div>


                                ';
                            }       
                        }

                   ?>
                   <script type="text/javascript">
                       document.getElementById('')
                   </script>
                </div>
                <!-- /.container-fluid -->

            </div>
    <!-- /.content-wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
    <body>

</html>
