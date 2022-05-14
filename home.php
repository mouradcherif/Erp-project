<?php



 session_start();

  
 if(!isset($_SESSION['login']))
    {
     header('Location: index.php');
      }


$idletime=898;

if (time()-$_SESSION['timestamp']>$idletime)
   {
    session_destroy();
    session_unset();
     }

  else
    {
    $_SESSION['timestamp']=time();
     }


?>



<!doctype html>

 <html class="no-js" lang="">
<head>

<meta HTTP-EQUIV="REFRESH" content="900; url=/logout.php">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title> Easybank </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

         <link rel="shortcut icon" href="favicon.png" type="image/png">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
  
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    

<script>
function bigImg(x) {
    x.style.height = "36px";
    x.style.width = "36px";
}

function normalImg(x) {
    x.style.height = "32px";
    x.style.width = "32px";
}
</script>




<style>
.modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 80%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

.modal-content {
  background-color: silver;
}
.modal-body {
  background-color: white;
}


.modal-backdrop {
  
   background-color: grey !important;
   opacity:`1;


 
}
</style>





</head>



<body>



    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="home.php"> EasyBank </a>
                <a class="navbar-brand active" href="home.php"><img src="images/logo5.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                   


                    <h3 class="menu-title"> statements </h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-handshake-o"></i> Transactions </a>
                        <ul class="sub-menu children dropdown-menu">
                <li><i class="fa fa fa-money"></i><a href="transac_deposits.php"> Deposits </a></li>
                <li><i class="fa fa fa fa-credit-card"></i><a href="transac_withdrawals.php"> Withdrawals  </a></li>
                        </ul>
                    </li>


         <li class="menu-item-has-children dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
            <i class="menu-icon fa fa-credit-card-alt"></i> Transfers</a>
            <ul class="sub-menu children dropdown-menu">
             <li><i class="fa fa-credit-card-alt"></i><a href="transf_easy_bank.php?i_code_true"> Easy Bank </a></li>
             <li><i class="fa fa-credit-card"></i><a href="transf_anyone_bank.php?i_code_true"> Anyone Bank  </a></li>
            </ul>
         </li>







                    <h3 class="menu-title"> Settings </h3>

                    <li>
               <a href="account.php"> <i class="menu-icon fa fa-user"></i> Account </a>
                    </li>

                    <li>	
                        <a href="notifications.php"> <i class="menu-icon ti-bell"></i> Notifications </a>
                    </li>

                    <li>
                        <a href="statics.php"> <i class="menu-icon fa fa-bar-chart"></i> Statics </a>
                    </li>

                   


                    <h3 class="menu-title"> Extras </h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i> Services </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-info"></i><a href="informations.php"> Informations </a></li>
                            <li><i class="menu-icon fa fa-comments"></i><a href="support.php"> Support </a></li>
                        </ul>
                    </li>
                </ul>
            </div><
        </nav>
    </aside>


    <div id="right-panel" class="right-panel">

      
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                       <?php echo date("d.m.Y"); ?>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
  
                         <?php  echo "Auto logout in ";  ?>    <span id="countdown"></span>



<script>
function countdown( elementName, minutes, seconds )
{
    var element, endTime, hours, mins, msLeft, time;

    function twoDigits( n )
    {
        return (n <= 9 ? "0" + n : n);
    }

    function updateTimer()
    {
        msLeft = endTime - (+new Date);
        if ( msLeft < 1000 ) {
            element.innerHTML = "countdown's over!";
        } else {
            time = new Date( msLeft );
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
            setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
        }
    }

    element = document.getElementById( elementName );
    endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
    updateTimer();
}

countdown( "countdown", 15, 0 );
</script>


                       
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                     
<a href="#" data-toggle="modal" data-target="#logoutModal">
   <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" class="user-avatar rounded-circle" src="images/menu/logout.png" title="Logout">
 </a>




<div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Log Out <i class="fa fa-lock"></i></h4>
      </div>
      <div class="modal-body">
        <p><i class="fa fa-question-circle"></i> Are you sure you want to Logout? <br /></p>
        <div class="actionsBtns">
          <form>
           <button class="btn btn-default btn-lg" data-dismiss="modal"> Cancel
             <i class="fa fa-close"></i>
           </button>
              &nbsp;
           <input type="hidden" name="${_csrf.parameterName}" value="${_csrf.token}"/>
           <button type="submit" class="btn btn-default btn-primary btn-lg" data-dismiss="modal"  onclick="window.location.href='logout.php'"/> Logout
            <i class="fa fa-check"></i>
          </button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
                      

               
  <script>
    function logout() 
      {
     if (confirm("Do you want logout?"))
        {
        location.href='logout.php';
       }
     }
 </script>


                    </div>


                </div>
            </div>

        </header>


<?php



require_once('__SRC__/connect.php');


     if (class_exists('DATABASE_CONNECT'))
            {
 
             $obj_conn  = new DATABASE_CONNECT;
            
             $host = $obj_conn->connect[0];
             $user = $obj_conn->connect[1];
             $pass = $obj_conn->connect[2];
             $db   = $obj_conn->connect[3];

 
              $conn = new mysqli($host,$user,$pass,$db);
 
                 if ($conn->connect_error)
                      {
                       die ("Cannot connect " .$conn->connect_error);
                        }


                else
                  {

                 $email = $_SESSION['login'];

                 $sql_details_user = "select lastname, firstname, account_number, IBAN 
                                      from customers 
                                      where email = '$email'"; 
                 $result_details_user = $conn->query($sql_details_user);
                 $row_details_user = $result_details_user->fetch_assoc();

                 $lastname  = ucfirst($row_details_user['lastname']);
                 $firstname = ucfirst($row_details_user['firstname']);
                 $acc_number = $row_details_user['account_number'];
                 $iban = $row_details_user['IBAN'];



       echo "<div class='breadcrumbs'>

            <div class='col-sm-12'>
                <div class='page-header float-left'>
                    <div class='page-title'>
                        <h1> Welcome to Easy Bank <b> $lastname $firstname <b> </h1>
                    </div>
                </div>
            </div>";



        $sql0 = "select total_balance from accounts where email = '".$_SESSION['login']."'";
        $result0 = $conn->query($sql0);
           

            while ($row0 = $result0->fetch_assoc())
               {

           echo "<div class='col-sm-12'>
                <div class='page-header float-right'>
                    <div class='page-title'>
                        <ol class='breadcrumb text-right'>
                             <li> Account Number: $acc_number </li>
                             <li> IBAN: $iban </li>
                            <li class='active'>  Your balance: {$row0['total_balance']} <i class='fa fa-euro'></i> </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>";
       
         } // end ehile of balance


       echo '<div class="content mt-3">';

  
          echo "<div class='col-sm-12'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <span class='badge badge-pill badge-success'> 
                      You have successfully joined  $lastname $firstname
                    </span>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
            </div>";



       } 

    $conn->close();

    } 


?>



     <div align="center">

        <p> <h3> Available credit and debit cards </h3> </p>

           <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-cc-visa text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text"> Visa </div>
                                <div class="stat-digit"> <i class="fa fa-euro"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-cc-stripe text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text"> Stripe </div>
                                <div class="stat-digit"> <i class="fa fa-euro"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-cc-paypal text-warning border-warning"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text"> Paypal </div>
                                <div class="stat-digit"> <i class="fa fa-euro"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


   
         
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-cc-jcb text-info border-info"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text"> Jcb </div>
                                <div class="stat-digit"> <i class="fa fa-euro"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


  
      <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-cc-mastercard text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text"> Mastercard </div>
                                <div class="stat-digit"> <i class="fa fa-euro"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-cc-discover text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text"> Discover </div>
                                <div class="stat-digit"> <i class="fa fa-euro"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-cc-amex text-warning border-warning"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text"> American Express </div>
                                <div class="stat-digit"> <i class="fa fa-euro"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


   
         
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-cc-diners-club text-info border-info"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text"> Diners Club </div>
                                <div class="stat-digit"> <i class="fa fa-euro"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




         <div>
   
          




        </div> 
    </div>

   

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

</body>
</html>
