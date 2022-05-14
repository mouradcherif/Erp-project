<?php



 session_start();

?>

<!doctype html>

<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <title> Easybank </title>
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

body 
{
background-image: url("images/bg1.jpg");
background-repeat: no-repeat;
background-size: 100% 100%;
background-color: ;
}


.alert 
{
max-width: 550px;
margin: auto; 
}


</style>




</head>


<body>


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                       <img src="images/logo4.png" height="130" width="27%">
                       <img src="images/bg5.png" height="130" width="33%">
                       <img src="images/logo5.png" height="130" width="27%">
                </div>
                <div class="login-form" style="background-color:white; 
                                               border-style:solid; border-width:0.5em; 
                                               border-radius: 2em;">
                    <form action="" method="post" >

                      <h3 align="center"> 
                         <font color="black"> <b> <i> 
                            &dollar; &dollar; EASYBANK &euro; &euro; 
                         </i> </b> </font>
                       </h3> <hr>

                        <div class="form-group">
                            <label>Email address</label>
                              <div class="input-group">
              <span class="input-group-addon  col-sm-1"">
                <i class="glyphicon glyphicon-user" style="font-size:20px; vertical-align: middle;"></i>
              </span>
              <input type="email" name="email" class="form-control" style="font-size:17px; font-weight:bold;"  
                     placeholder="Email" required>
                        </div>
                        </div>


                        <div class="form-group">
                            <label>Password</label>
                           <div class="input-group">
              <span class="input-group-addon col-sm-1">
               <i class="glyphicon glyphicon-lock" style="font-size:20px; vertical-align: middle;"></i>
                     </span>
            <input type="password" name="password" class="form-control" style="font-size:17px; font-weight:bold; color:red;"
                       placeholder="Password" required>
                             </span>
                        </div>
                       </div>


                       <div class="form-group">
                            <label>Pin</label>
                           <div class="input-group">
                <span class="input-group-addon col-sm-1">
                 <i class="glyphicon glyphicon-info-sign" style="font-size:20px; vertical-align: middle;"></i> 
              </span>
           <input type="password" name="pin" class="form-control" style="font-size:17px; font-weight:bold; color:red;"
                  placeholder="Pin" required>
                        </div>
                       </div>


                        <div class="checkbox" align="center">
                                          
                        </div>

                            <br>

                           <div class="wrapper">
                            <span class="group-btn">     
             <button type="submit" name="submit_login" class="btn btn-success btn-flat m-b-30 m-t-30"> Sign in <i class="fa fa-sign-in"></i></button>
                        </span>
                         </div>

                          <br><br>

                        <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="page-register.php"> Sign Up Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


</body>
</html>




<?php

error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);


  if (isset($_POST['submit_login']))
      {

          require_once('__SRC__/secure_data.php');

        if (class_exists('SECURE_INPUT_DATA_AVAILABLE'))
            {
 
             $obj_secure_data = new SECURE_INPUT_DATA;
              

             $email     =  $obj_secure_data->SECURE_DATA_ENTER($_POST['email']);
             $password  =  $obj_secure_data->SECURE_DATA_ENTER($_POST['password']);
             $pin       =  $obj_secure_data->SECURE_DATA_ENTER($_POST['pin']);

            
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

                    $email     =  $conn->real_escape_string($email);
                    $password  =  $conn->real_escape_string($password);
                    $pin       =  $conn->real_escape_string($pin);
  
                    $password  =  md5($password);


              
                    $sql = "select email,password,pin,account_type from customers where email='$email'";
                    $result = $conn->query($sql);
                    $count =  $result->num_rows;
                   
                         

                      if($count == 1) 
                         {
                  

                      while  ($row = $result->fetch_assoc())
                               {

                      if ($row['account_type'] != 'active')
                              {
                              echo"
                         <div class='alert alert-danger' role='alert'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                         <strong> Your account is not activated </strong>.
                       </div>";
                              }


                        else if ($row['account_type'] == 'active')
                             {                   

                     if ($row['email'] != $email)
                              {
                              echo"
                         <div class='alert alert-danger' role='alert'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                         <strong> Your Login </strong> Email is invalid.
                       </div>";
                              }

                        if ($row['password'] != $password)
                             {
                              echo"
                         <div class='alert alert-danger' role='alert'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                         <strong> Your Login </strong> Password is invalid.
                       </div>";
                              }


                        if ($row['pin'] != $pin)
                             {
                              echo"
                         <div class='alert alert-danger' role='alert'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                         <strong> Your Login </strong> Pin is invalid.
                       </div>";
                              }

                  
                    if ($row['email'] == $email && $row['password'] == $password && $row['pin'] == $pin)
                                {
                                 $_SESSION['login'] = $email;
                                 $_SESSION['timestamp']=time();
                                 echo ("<script>location.href='home.php'</script>");
                                 }


                               } 

                              } 

                           } 



                       else 
                         {

                              } 



                        }

                         $conn->close();


                     }

 


                 } 



         
              else
               {
                
                } 



      

     } 



?>
