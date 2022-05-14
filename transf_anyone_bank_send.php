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

error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);


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


             // get personal details from user

              $firstname          =   $obj_secure_data->SECURE_DATA_ENTER($_POST['firstname']);
              $lastname           =   $obj_secure_data->SECURE_DATA_ENTER($_POST['lastname']);                 
              $IBAN               =   $obj_secure_data->SECURE_DATA_ENTER($_POST['IBAN']);
              $main_amount        =   $obj_secure_data->SECURE_DATA_ENTER($_POST['main_amount']);
              $secondary_amount   =   $obj_secure_data->SECURE_DATA_ENTER($_POST['secondary_amount']);
              $total_amount       =   $main_amount ."." .$secondary_amount;
   
   
              
              $sql = "select total_balance from accounts where email = '".$_SESSION['login']."' ";
              $result  = $conn->query($sql);
 
                   while ($row = $result->fetch_assoc())
                      {

                       $total_balance = $row['total_balance'];
                      // $total_balance2 = number_format($total_balance, 2, '.', '');
                       // echo $total_balance2;
  
                        $amount_reserve = 3;
                        $total_amount_with_reserve = $total_amount + $amount_reserve;

                         if ($total_amount_with_reserve > $total_balance)
                            { 
            echo '<script type="text/javascript">alert("You do not have enough balance to do this transfer.");
                </script>';
                              }


                      else if ($total_amount_with_reserve <= $total_balance)
                          {

                 $sql2 = "update accounts set amounts_transferred = amounts_transferred + $total_amount,
                          amounts_from_reserve = amounts_from_reserve + $amount_reserve,
                          total_balance = total_balance - $total_amount_with_reserve
                          where email = '".$_SESSION['login']."'";
                 $result2  = $conn->query($sql2);


                 $sql3 = "update accounts set amounts_from_others = amounts_from_others + $total_amount ,
                          total_balance = total_balance + $total_amount
                          where firstname = '$firstname' and lastname= '$lastname' and IBAN = '$IBAN' ";
                 $result3  = $conn->query($sql3);
                

                          //  if ($result2 == true && $result3 == true)
                                // {
                            
                                 // }
               
                              } // end of else


                           else
                             {
                              exit;
                              }
        
     
                       } // end of while
             


            
        



                   //else
                    // { 
                      //exit;
                       //}



                } // end of secure data input


               } // end of else for connect



            } // end of if for calss exists


        } // end of if isset post transfer button


    } // end of else session login

?>
