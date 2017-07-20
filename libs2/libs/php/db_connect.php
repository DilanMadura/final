<?php

class Db_Connect {

    function connect() {
        $serverName = 'localhost';

        $connectionInfo = array("Database" => "research_db_2");

        $conn = sqlsrv_connect($serverName, $connectionInfo);

        if ($conn) {

            return $conn;
            
        } else {

            die(print_r(sqlsrv_errors(), true));

            return 0;
        }
    }

}

?>