<?php

function pagination($table, $required, $requirePage) {

    $count = selectDB($table, 'COUNT(id)');
    $count = $count['COUNT(id)'];
    $pages = ceil($count / 20);

    $arr = selectDB($table, $required, '', 'id DESC', ((($requirePage - 1) * 20)) . ',20');

    $msg_pagination['pages'] = $pages;
    $msg_pagination['results'] = $arr;

    send_to_client($msg_pagination);
}

function selectDB($sql) {

    $dbCon = new Db_Connect();

    $conn = $dbCon->connect();      //var_dump($stmt);

    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {

        die(print_r(sqlsrv_errors(), true));
    } else {
        
       $first_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        
        if ($first_row === null) {
            
            $data = null;
            
        } else {
            
            $data[] = $first_row;
            
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

                $data[] = $row;
            }
        }
    }
    sqlsrv_free_stmt($stmt);
    
    return $data; 
}

function insertDB($sql) {

    $dbCon = new Db_Connect();

    $conn = $dbCon->connect();      //var_dump($stmt);

    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {

        die(print_r(sqlsrv_errors(), true));
    } else {
        
       //$first_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        
        /*if ($first_row === null) {
            
            $data = null;
            
        } else {
            
            $data[] = $first_row;
            
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

                $data[] = $row;
            }
        }*/
       
       $data = '1';
    }
    sqlsrv_free_stmt($stmt);
    
    return $data; 
}

/* function selectDB($table, $require = "*", $where = "", $orderBy = "", $top = "") {

  $data = '';

  if (!empty($where))
  $where = ' WHERE ' . $where;
  if (!empty($orderBy))
  $orderBy = ' ORDER BY ' . $orderBy;
  if (!empty($top))
  $top = 'TOP ' . $top . ' ';

  $sql = 'SELECT ' . $top . $require . ' FROM ' . $table . $where . $orderBy;  //echo $sql;

  $dbCon = new Db_Connect();

  $conn = $dbCon->connect();      //var_dump($stmt);

  $stmt = sqlsrv_query($conn, $sql);

  if ($stmt === false) {

  die(print_r(sqlsrv_errors(), true));
  } else {

  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

  $data[] = $row;
  }
  }
  sqlsrv_free_stmt($stmt);

  return $data;
  } */

function selectDB_count($table, $require = "id", $where = "") {
    $count = selectDB('inventory', 'COUNT(' . $require . ')', $where, '', '');
    return $count['COUNT(code_string)'];
}

function insertDB_Raw($table, $arr) {

    $sql = 'INSERT INTO `' . $table . '`(`';
    $cols = '';
    $vals = '';

    foreach ($arr as $key => $val) {

        $cols .= $key . '`,`';

        $vals .= $val . '","';
    }

    $cols = rtrim(rtrim($cols, '`'), ',');

    $vals = rtrim(rtrim($vals, '"'), ',');

    $sql = $sql . $cols . ') VALUES ("' . $vals . ')';    //echo $sql;


    $dbCon = new Db_Connect();

    $conn = $dbCon->connect();

    $msg = '';

    if ($conn->query($sql) === TRUE) {
        $msg['state'] = true;
        $msg['msg'] = $conn->insert_id;
    } else {
        $msg['state'] = false;
        $msg['msg'] = $conn->error;
    }

    $conn->close();

    return $msg;
}

function updateDB($table, $arr, $where) {

    $sql = 'UPDATE `' . $table . '` SET ';

    foreach ($arr as $key => $val) {
        $sql .= '`' . $key . '`="' . $val . '",';
    }

    $sql = rtrim($sql, ',');

    $sql .= ' WHERE ' . $where;     //echo $sql;

    $dbCon = new Db_Connect();

    $conn = $dbCon->connect();

    $msg = '';

    if ($conn->query($sql) === TRUE) {
        $msg['state'] = true;
        $msg['msg'] = true; //$conn->insert_id;
    } else {
        $msg['state'] = false;
        $msg['msg'] = $conn->error;
    }

    $conn->close();

    return $msg;
}

function deleteDB($table, $where) {

    $sql = 'DELETE FROM ' . $table . ' WHERE ' . $where;    //echo $sql;

    $dbCon = new Db_Connect();

    $conn = $dbCon->connect();

    $msg = '';

    if ($conn->query($sql) === TRUE) {
        $msg['state'] = true;
        $msg['msg'] = true;
    } else {
        $msg['state'] = false;
        $msg['msg'] = $conn->error;
    }

    $conn->close();

    return $msg;
}

function call_procedure($sql) {

    $dbCon = new Db_Connect();

    $conn = $dbCon->connect();

    $result = $conn->query('CALL ' . $sql);
    //$hash	= 0;
    $row_count = $result->num_rows;
    if ($result) {
        if ($row_count > 0) {

            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (count($data) == "1") {

                $data = $data[0];
            }
        } else {
            $data = null;
        }
    } else {
        $data = null;
    }
    $conn->close();
    return $data;
}

function send_to_client($msg) {

    echo json_encode($msg);
}

// convert date to Y-m-d format which compatiable for my sql date variable type
function date_convert($date) {
    return date("Y-m-d", strtotime($date));
}

// input -> 150     output  ->  150.00
function format_to_price($number) {
    return number_format((float) $number, 2, '.', '');
}

?>