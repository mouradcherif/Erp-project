<?php


require_once('backup_connect.php');

    if (class_exists('DATABASE_CONNECT_BACKUP'))
        {
 
         $obj_conn  = new DATABASE_CONNECT_BACKUP;
            
         
         $host = $obj_conn->connect[0];
         $user = $obj_conn->connect[1];
         $pass = $obj_conn->connect[2];

         $host2 = $obj_conn->connect_db2[0];
         $user2 = $obj_conn->connect_db2[1];
         $pass2 = $obj_conn->connect_db2[2];
         $db2   = $obj_conn->connect_db2[3];

    
         $host1 = $obj_conn->connect_db1[0];
         $user1 = $obj_conn->connect_db1[1];
         $pass1 = $obj_conn->connect_db1[2];
         $db1   = $obj_conn->connect_db1[3];


         $conn = new mysqli($host,$user,$pass);
         $conn2 = new mysqli($host2,$user2,$pass2,$db2);
         $conn1 = new mysqli($host1,$user1,$pass1,$db1);

          set_time_limit(0);

           if ($conn->connect_error or $conn2->connect_error or $conn1->connect_error)
               {
                 die ("Cannot connect " .$conn->connect_error .$conn2->connect_error .$conn1->connect_error);
                   }


    else
      {

    $tables = $conn->query("SHOW TABLES FROM $db1");

while ($line = $tables->fetch_row()) 
     {
    $tab = $line[0];
    $conn->query("DROP TABLE IF EXISTS $db2.$tab");
    $conn->query("CREATE TABLE $db2.$tab LIKE $db1.$tab") or die(mysql_error());
    $conn->query("INSERT INTO $db2.$tab SELECT * FROM $db1.$tab");
   // echo "Table: <b>" . $line[0] . " </b>Done<br>";
     }

       } // end of else connect



 } // end of class connect backup exists



?>
