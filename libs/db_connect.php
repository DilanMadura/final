<?php

  class Db_Connect{

   function connect(){

    $conn = new mysqli("localhost","root","1234","db");

    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

     return 0;

    }

    else

     return $conn;

   }  

  }

?>