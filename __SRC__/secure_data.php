<?php




    class SECURE_INPUT_DATA
    { 
    
      public function SECURE_DATA_ENTER($data)
        {
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        $data = trim($data);
        $data = stripslashes($data);  
        $data = stripcslashes ($data);
          if ($data == true)
           {
          return ($data);
            }          
          else
            {
            return (!$data);
             }
         } 

    
      } 
      
      


  class SECURE_INPUT_DATA_AVAILABLE extends SECURE_INPUT_DATA
    { 
    
      public function SECURE_DATA_ENTER($data)
        {
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        $data = trim($data);
        $data = stripslashes($data);  
        $data = stripcslashes ($data);
          if ($data == true)
           {
          return ($data);
            }          
          else
            {
            return (!$data); 
             }
         } 
    
      } 


?>
