<?php



   
   session_start();

    
 if(!isset($_SESSION['login']))
    {
     header('Location: index.php');
      }


   else
    {

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

           $length_code = 4;
           $i_code = substr(str_shuffle("123456789"),0, $length_code);
 
     
           $sql = "update accounts set i_code = '$i_code', i_code_time = NOW() where email = '$email'";
           $result = $conn->query($sql);


       if ($result == true)
           {                    
   





$msg = " Mr,s $email your i_code for the confirm transaction is: $i_code ";

$headers = "";
$headers .= "From: Easybank <easybank@easybank.no-reply> \r\n";
$headers .= "Reply-To:" . $email . "\r\n" ."X-Mailer: PHP/" . phpversion();
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

$send = mail("$email","Easybank",$msg,$headers);

     if(!$send)
               {
                echo '<script type="text/javascript">alert("i_code error. Please try again.");
                </script>';
            echo ("<script>location.href='transf_anyone_bank.php'</script>");
                 }

               
                else
                  {

              echo '<script type="text/javascript">alert("Chech your mail for i_code");
                </script>';
                  echo ("<script>location.href='transf_anyone_bank.php?i_code_one'</script>");

                          }  


                      } 



                   else
                     { 
                      exit;
                       }



               } 



            } 


    } 

?>
