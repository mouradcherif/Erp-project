<?php


 class DATABASE_CONNECT
 {

 public $connect = array();

 public function __construct()
 {

  $this->connect[0] = "localhost";
  $this->connect[1] = "root";
  $this->connect[2] = "";
  $this->connect[3] = "easybank";
  
  }



public function __destruct()
  {
  $this->connect[0] = null;
  $this->connect[1] = null;
  $this->connect[2] = null;
  $this->connect[3] = null;
   }


  }

?>


