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

 if (isset($_POST['transfer_easy_bank'])) 
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


            $i_code1           =   $obj_secure_data->SECURE_DATA_ENTER($_POST['i_code1']);
            $i_code2           =   $obj_secure_data->SECURE_DATA_ENTER($_POST['i_code2']);
            $i_code3           =   $obj_secure_data->SECURE_DATA_ENTER($_POST['i_code3']);
            $i_code4           =   $obj_secure_data->SECURE_DATA_ENTER($_POST['i_code4']);
            

           //$i_code_end =  $_SESSION['i_code_end'];

           //echo $i_code1.$i_code2.$i_code3.$i_code4."<br>";

        $sql = "select i_code, i_code_time from accounts where  email = '".$_SESSION['login']."' ";
        $result = $conn->query($sql);


                  while  ($row = $result->fetch_assoc())
                            {
                       
                          //  echo $row['i_code'];
                         
                         
                        if ($i_code1.$i_code2.$i_code3.$i_code4 != $row['i_code'])
                             {
                             //echo"
                           //<div class='alert alert-danger' role='alert'>
                           // The verification code is a mistake <strong> You can not make out the trans. </strong>
                           //</div>";  
                             //  exit;
                            echo '<script type="text/javascript">alert("i_code error. Please try again.");
                            </script>';
                           echo ("<script>location.href='transf_easy_bank.php'</script>");
                               }
                              

                        
                        if ($i_code1.$i_code2.$i_code3.$i_code4 = $row['i_code'])
                              {
                          $time_db = $row['i_code_time'];

                          $time_now = strtotime($time_db);
                           if (time() - $time_now > 10 * 60) 
                               {
                               
                             /*
                          echo"
                         <div class='alert alert-info' role='alert'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                          <strong> Verification code expired </strong> Get new code to finish transferring.
                         </div>";
                              exit; 
                             */

                     echo '<script type="text/javascript">alert("Verification code expired  Get new code to finish transferring.");
                         </script>';
                       echo ("<script>location.href='transf_easy_bank.php'</script>");

                             }


                       $sql2 = "update accounts set i_code = null where email = '".$_SESSION['login']."' ";     
                       $result2 = $conn->query($sql2);
  

                      // echo '<script type="text/javascript">alert("i_code is ok");
                       //  </script>';
                      // echo ("<script>location.href='transf_easy_bank.php'</script>");

                            } 


                          
                         else
                            {
                         echo"
                           <div class='alert alert-danger' role='alert'>
                            The verification code is a mistake <strong> You can not make out the trans. </strong>
                           </div>";  
                               exit;
                                }




                          }  // end of while




                } // end of secure data input


               } // end of else for connect



            } // end of if for calss exists


      } // end of if isset post transfer button


    } // end of else session login


?>

