<?php




 session_start();

   if(!isset($_SESSION['step1']))
    {
     header('Location: page-register.php');
      }


 else if(!isset($_SESSION['step2']))
    {
     header('Location: page-register.php');
      }

  
  
 else if(!isset($_SESSION['step3']))
    {
     header('Location: page-register.php');
      }


?>


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Easybank </title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link rel="shortcut icon" href="favicon.png" type="image/png">
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
   
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    

<style>
body {
    background-image: url("/images/bg1.jpg");
    background-repeat: no-repeat, repeat;
    background-size: 100%;
}




.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}




.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload
{
height: 40%;
width: 100%;
}


</style>




<script>

$(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		}); 	
	});


</script>







<script type = 'text/javascript' >
function changeHashOnLoad() 
{
     window.location.href += '#';
     setTimeout('changeHashAgain()', '50'); 
}
 
function changeHashAgain()
 {
  window.location.href += '1';
}
 
var storedHash = window.location.hash;
window.setInterval(function () 
{
    if (window.location.hash != storedHash) {
         window.location.hash = storedHash;
    }
}, 50);
window.onload=changeHashOnLoad;
</script> 





</head>



<body onload="doLogout(); return false;">



    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <img src="images/logo4.png" height="130" width="27%">
                    <img src="images/bg5.png" height="130" width="33%">
                    <img src="images/logo5.png" height="130" width="27%">
                </div>
                <div class="login-form"  style="width: 550px; position: relative; left: 0%;">
                    <form action="" method="post" enctype="multipart/form-data">


                       <h3 align="center"> 
                         <font color="black"> <b> <i> 
                            &dollar; &dollar; EASYBANK ACCOUNT &euro; &euro; 
                         </i> </b> </font>
                       </h3> <hr>
                      
                      <h2 align="center"> <font color="black"> <b> Step 3: Your documents </b> </font> </h3>


                      <div class="container">
                        <div class="col-md-12">
                          <div class="form-group">

                      <div align="center"> <label> Back image of identity </label> </div>
                      <div class="input-group">
                        <span class="btn btn-default btn-file glyphicon glyphicon-open-file">
                         Browse… <input type="file" name="identity_back" id="imgInp" required>
                       </span>
                     <input type="text" class="form-control" readonly>
                   </div>
                 <img id='img-upload'/>
               </div>

              </div>
            </div>

          


                    <div class="checkbox" align="center">
                            <label>
                                <input type="checkbox" required> Agree the terms and policy
                            </label>
                        </div>

                         <div class="wrapper">
                         <span class="group-btn">     
                       <button type="submit" name="submit_end" class="btn btn-primary btn-flat m-b-30 m-t-30"> 
                          Register <i class="glyphicon glyphicon-ok-circle"></i>
                      </button>
                        </span>
                         </div>

                    </form>
                </div>
            </div>
        </div>
    </div>







</body>
</html>



<?php

error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);


if (isset($_POST['submit_end']))
    {

      require_once('__SRC__/secure_data.php');

        if (class_exists('SECURE_INPUT_DATA_AVAILABLE'))
            {
 
             $obj_secure_data = new SECURE_INPUT_DATA;


        
      
        $identity_back_name  =  $_FILES['identity_back']['name'];
        $identity_back_type  =  $_FILES['identity_back']['type'];
        $identity_back_size  =  $_FILES['identity_back']['size'];
        $identity_back_data  =  addslashes(file_get_contents($_FILES ['identity_back']['tmp_name']));
        
        $allowed_imgs = array( "image/pjpeg","image/jpeg","image/jpg","image/png","image/x-png","image/gif");


    


     if (!in_array($identity_back_type, $allowed_imgs)) 
         {
          echo '<script type="text/javascript">alert("This file not image");
            </script>';
          echo ("<script>location.href='page-register4.php'</script>"); 
         exit;
         }



       else
         {

          
  
         $first_name = $_SESSION['first_name'];  
         $last_name = $_SESSION['last_name'];
         $day =  $_SESSION['day'];
         $month =  $_SESSION['month'];
         $year = $_SESSION['year'];
         $date_of_birth = $day ."-" .$month ."-" .$year;
         $nationality =  $_SESSION['nationality'];  
         $id_document_number = $_SESSION['identity_number'];
         $mobile_area_code =  $_SESSION['area_code'];
         $mobile_number = $_SESSION['mobile_number'];    
         $country = $_SESSION['country_code'];
         $city =  $_SESSION['city'];
         $street = $_SESSION['street'];
         $street_number = $_SESSION['number'];          
         $post_code = $_SESSION['post_code'];        
         $tax_residence = $_SESSION['tax_residence'];  
         $tax_id_number = $_SESSION['tax_id_number'];    
         $identity_front_name = $_SESSION['identity_front_name'];  
         $identity_front_type = $_SESSION['identity_front_type'];
         $identity_front_size = $_SESSION['identity_front_size'];
         $identity_front_data = $_SESSION['identity_front_data'];
         $email = $_SESSION['email'];  
         $password =  $_SESSION['password'];
         $ip_instant_register = $_SERVER['REMOTE_ADDR'];
             
 

 

    $length_pin = 4;
    $pin = substr(str_shuffle("0123456789"),0, $length_pin);
 

    $length_bank_code = 2;
    $number_bank_code = substr(str_shuffle("0123456789"),0, $length_bank_code);


   $length_account = 10;
   $account_number = substr(str_shuffle("0123456789"),0, $length_account);



     

   $bank_iso = "EB";
   $bank_code = $number_bank_code;
   $bank_identity = "1411";
   $bank_acc_begin =  substr($account_number, 0, -7);
   $bank_default_number = "000000";
   $bank_account_user =  $account_number;

   
     $iban_check = $bank_identity .$bank_acc_begin .$bank_default_number .$bank_account_user .$bank_identity .$bank_code;

      $iban_check = $iban_check / 97;
      
      $iban_check =  substr($iban_check, 0, -15);

      if($iban_check > 1 && $iban_check < 1.9)
        {

    $IBAN = $bank_iso .$bank_code .$bank_identity .$bank_acc_begin .$bank_default_number .$bank_account_user;
    
          }


    else
      {
       exit;
       }



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



 



            $sql = "insert into customers (firstname, lastname, date_of_birth, nationality, id_document_number, mobile_area_code,
                                           mobile_number, country, town_city, street, street_number, post_code, tax_residence, tax_id_number,
                                           identity_front_name, identity_front_type, identity_front_size, identity_front_data,
                                           identity_back_name, identity_back_type, identity_back_size, identity_back_data,
                                           email, password, pin, account_number, IBAN, account_type, instant_register, ip_instant_register)
                        values  ('$first_name', '$last_name', '$date_of_birth', '$nationality', '$id_document_number', '$mobile_area_code',
                                 '$mobile_number', '$country', '$city', '$street', '$street_number', '$post_code', '$tax_residence', '$tax_id_number', 
                                 '$identity_front_name', '$identity_front_type', '$identity_front_size', '$identity_front_data',
                                 '$identity_back_name' ,'$identity_back_type', '$identity_back_size', '$identity_back_data',
                                 '$email', '$password', '$pin', '$account_number', '$IBAN', 'block', NOW(), '$ip_instant_register')";



  


  $sql2 = "insert into accounts (currency, email, lastname, firstname, account_no, IBAN, 
                                 limit_per_day_transfer, over_transfer, amounts_transferred, amounts_from_reserve,	  
                                 amounts_from_you, amounts_from_others, total_balance, account_statement, 
                                 i_code, i_code_time)
                       values   ('Euro','$email','$last_name', '$first_name', '$account_number', '$IBAN',
                                 '20000.00', '0.00', '', '',
                                 'rejected', '0.00', '0.00', 'on_hold',
                                 'unused', '')";
 





  $sql3 = "insert into notifications (email, lastname, firstname, title, message)
           values ('$email', '$last_name', '$first_name', 'Welcome', 'Welcome to Easy Bank');";
  $sql3.= "insert into notifications (email, lastname, firstname, title, message)
           values ('$email', '$last_name', '$first_name', 'Balance', 'Your balance is 0.00 Euro');";
  $sql3.= "insert into notifications (email, lastname, firstname, title, message)
           values ('$email', '$last_name', '$first_name', 'Account', 'Your account is activated')";




  $result = $conn->query($sql);
  $result2 = $conn->query($sql2);   
  $result3 = $conn->multi_query($sql3);



   
    
 
        
       shell_exec('__ROOT__/./unlock.sh');
  
       require_once('__TMP__/backup_databases.php');

       shell_exec('__ROOT__/./lock.sh');



   $results = array("result1", "result2", "result3", "result4", "result5", "result6");


    if (in_array("result1", $results) && in_array('result2',$results) && in_array('result3',$results)
                  && in_array("result4", $results) && in_array("result5", $results)
                  && in_array("result6", $results))
                  {





$msg = " Mr,s $email your pin is: $pin ";

$headers = "";
$headers .= "From: Easybank <easybank@easybank.no-reply> \r\n";
$headers .= "Reply-To:" . $email . "\r\n" ."X-Mailer: PHP/" . phpversion();
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 


$send = mail("$email","Easybank pin code",$msg,$headers);

     if(!$send)
               {
                echo '<script type="text/javascript">alert("Pin error. Please suport with us.");
                </script>';
            echo ("<script>location.href='index.php'</script>");
                 }

               
                else
                  {

              echo '<script type="text/javascript">alert("Chech your mail for pin code.");
                </script>';
                  echo ("<script>location.href='logout.php'</script>");

                          }  



                           } 


                        else
                          {
                           echo '<script type="text/javascript">alert("Error2");
                          </script>';

                      echo $conn->error;

                           }


                  }
 
                  $conn->close();

 

        
             }

 
              }



             } 

         }  


?>
