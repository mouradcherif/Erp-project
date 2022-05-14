<?php


  session_start();

    
 if(!isset($_SESSION['login']))
    {
     header('Location: index.php');
      }


   else
    {

$idletime=898;//after 60 seconds the user gets logged out

if (time()-$_SESSION['timestamp']>$idletime)
   {
    session_destroy();
    session_unset();
     }

  else
    {
    $_SESSION['timestamp']=time();
     }


 if (isset($_POST['transfer_anyone_bank'])) 
      {

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

          require_once('__SRC__/secure_data.php');

          if (class_exists('SECURE_INPUT_DATA_AVAILABLE'))
              {

            $obj_secure_data = new SECURE_INPUT_DATA;


            $main_amount       =   $obj_secure_data->SECURE_DATA_ENTER($_POST['main_amount']);
            $secondary_amount  =   $obj_secure_data->SECURE_DATA_ENTER($_POST['secondary_amount']);
            $total_amount      =   $main_amount .'.' .$secondary_amount;



        $sql = "select limit_per_day_transfer, over_transfer from accounts where  email = '".$_SESSION['login']."' ";
        $result = $conn->query($sql);


                  while  ($row = $result->fetch_assoc())
                            {


                       if ($row['over_transfer'] == 'accepted')
                             {

                         if ($total_amount > $row['limit_per_day_transfer'])
                              {
                              echo"
                         <div class='alert alert-danger' role='alert'>
                          You have exceeded the <strong> overtransfer limit. </strong>
                       </div>";  
                               exit;
                               }        

                              }

                        
                       if ($row['over_transfer'] == 'rejected')
                              {

                          if ($total_amount > $row['limit_per_day_transfer'])
                              {
                              echo"
                         <div class='alert alert-danger' role='alert'>
                          You have exceeded the transfer limit <strong> Apply for overtransfer. </strong>
                       </div>"; 
                               exit;
                               }        

                             }


                          }  // end of while




                } // end of secure data input


               } // end of else for connect



            } // end of if for calss exists


        } // end of if isset post transfer button


    } // end of else session login


?>

