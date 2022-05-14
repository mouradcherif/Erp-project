<?php

session_start();
    

 if(!isset($_SESSION['login']))
    {
     header('Location: index.php');
    
      }


   else
    {

session_start();

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


             // get personal details from user


            $_to_customer_lastname     =   $obj_secure_data->SECURE_DATA_ENTER($_POST['lastname']);    
            $_to_customer_firstname    =   $obj_secure_data->SECURE_DATA_ENTER($_POST['firstname']);                  
            $_to_customer_IBAN         =   $obj_secure_data->SECURE_DATA_ENTER($_POST['IBAN']);
            $reason                    =   $obj_secure_data->SECURE_DATA_ENTER($_POST['reason']);
            $main_amount               =   $obj_secure_data->SECURE_DATA_ENTER($_POST['main_amount']);
            $secondary_amount          =   $obj_secure_data->SECURE_DATA_ENTER($_POST['secondary_amount']);
            $amount                    =   $main_amount ."." .$secondary_amount;



              $length_number = 16;
              $transaction_number = substr(str_shuffle("0123456789"),0, $length_number);


              
              $sql = "select firstname, lastname, IBAN from customers 
                      where email = '".$_SESSION['login']."' ";
              $result  = $conn->query($sql);
 
                   while ($row = $result->fetch_assoc())
                       {
        
                        $amount_reserve = 3;
                        $total_amount = $amount + $amount_reserve;

                        $_from_customer_lastname = $row['lastname'];
                        $_from_customer_firstname = $row['firstname'];
                        $_from_customer_IBAN = $row['IBAN'];


                        $sql2 = "insert into transactions_anyone_bank  
                                 (_from_customer_lastname, _from_customer_firstname, _from_customer_IBAN,
                                  _to_customer_lastname, _to_customer_firstname, _to_customer_IBAN,
                                  reason, transaction_number, 
                                  amount_from_reserve, amount, total_amount)
                                   values  
                                  ('$_from_customer_lastname', '$_from_customer_firstname',
                                   '$_from_customer_IBAN',
                                   '$_to_customer_lastname', '$_to_customer_firstname',
                                   '$_to_customer_IBAN',
                                   '$reason', '$transaction_number', 
                                   '$amount_reserve', '$amount', '$total_amount')";

                        $result2 = $conn->query($sql2);



                        $sql3 = "insert into transactions_all  
                                 (_from_customer_lastname, _from_customer_firstname, _from_customer_accno_iban,
                                  _to_customer_lastname, _to_customer_firstname, _to_customer_accno_iban,
                                  reason, transaction_number, amount)
                                   values  
                                  ('$_from_customer_lastname', '$_from_customer_firstname',
                                   '$_from_customer_IBAN',
                                   '$_to_customer_lastname', '$_to_customer_firstname',
                                   '$_to_customer_IBAN',
                                   '$reason', '$transaction_number', '$amount')";

                        $result3 = $conn->query($sql3);





                       $sql4 = "insert into easybank_reserve_currency
                                   (_from_customer_lastname, _from_customer_firstname, _from_customer_IBAN,
                                    _to_customer_lastname, _to_customer_firstname, _to_customer_IBAN,
                                    transaction_number, amount_reserve)
                                   values  
                                  ('$_from_customer_lastname', '$_from_customer_firstname',
                                   '$_from_customer_IBAN',
                                   '$_to_customer_lastname', '$_to_customer_firstname',
                                   '$_to_customer_IBAN',
                                   '$transaction_number', '$amount_reserve')";

                        $result4 = $conn->query($sql4);



                        $sql5 = "update easybank_all_reserves 
                                 set TOTAL_RESERVE = TOTAL_RESERVE + '$amount_reserve'
                                 where EASY_BANK_ID = 'EASY_BANK_1410'";
                        $result5 = $conn->query($sql5);



                // printf("Errormessage: %s\n", $conn->error);

                           if ($result2 == true && $result3 == true && $result4 == true && $result5 == true) 
                               {
                          echo '<script type="text/javascript">alert("This transfer was held successfully.");
                         </script>';
                        echo ("<script>location.href='transf_anyone_bank.php'</script>");
                            exit;
                                }


                           //  } // end of big result


                           else
                             {
                             //exit;
                              echo "Error";
                               }
                
     
                       } // end of while
             


            
        



                   //else
                    // { 
                      //exit;
                       //}



                } // end of secure data input


               } // end of else for connect



            } // end of if for calss exists secure data


        } // end of if isset post transfer button


    } // end of else session login

 

?>
