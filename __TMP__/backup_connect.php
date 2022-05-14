<?php


 class DATABASE_CONNECT_BACKUP
 {

 public $connect = array();
 public $connect_db1 = array();
 public $connect_db2 = array();

 public function __construct()
 {

  $this->connect[0] = "localhost";
  $this->connect[1] = "root";
  $this->connect[2] = "";

  $this->connect_db1[0] = "localhost";
  $this->connect_db1[1] = "root";
  $this->connect_db1[2] = "";
  $this->connect_db1[3] = "easybank";

  $this->connect_db2[0] = "localhost";
  $this->connect_db2[1] = "root";
  $this->connect_db2[2] = "";
  $this->connect_db2[3] = "easybank";
  
  }



public function __destruct()
  {

  $this->connect[0] = null;
  $this->connect[1] = null;
  $this->connect[2] = null;

  $this->connect_db1[0] = null;
  $this->connect_db1[1] = null;
  $this->connect_db1[2] = null;
  $this->connect_db1[3] = null;

  $this->connect_db2[0] = null;
  $this->connect_db2[1] = null;
  $this->connect_db2[2] = null;
  $this->connect_db2[3] = null;

   }


  }

?>

