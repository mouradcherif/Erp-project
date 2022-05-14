<?php




   $length_bank_code = 2;
   $number_bank_code = substr(str_shuffle("0123456789"),0, $length_bank_code);

   echo $number_bank_code ."<br>";


   $length_account = 10;
   $account_number = substr(str_shuffle("0123456789"),0, $length_account);


    echo $account_number ."<br>";


     

   $bank_iso = "EB";
   $bank_code = $number_bank_code;
   $bank_identity = "1411";
   $bank_acc_begin =  substr($account_number, 0, -7);
   $bank_default_number = "000000";
   $bank_account_user =  $account_number;

   
     $iban_check = $bank_identity .$bank_acc_begin .$bank_default_number .$bank_account_user .$bank_identity .$bank_code;

      $iban_check = $iban_check / 97;
      
      $iban_check =  substr($iban_check, 0, -15);


      echo  $iban_check ."<br>";

      if($iban_check > 1 && $iban_check < 1.9)
        {

    $IBAN = $bank_iso .$bank_code .$bank_identity .$bank_acc_begin .$bank_default_number .$bank_account_user;
 
       echo $IBAN;       
  
          }





    else
      {

      echo "DO not generate iban";

       }

   

?>
