<?php
require 'libs/db_connect.php';

$month = $_POST['month'];

//echo $_POST['destination'];

if($_POST['key']==='destination') {
    
    $arr = send_to_client(selectDB('destinations', 'destination, population', 'month(predicted_time)='.$month, 'population desc', '10'));
    
} else if($_POST['key']==='board_basis') {
    
    $arr = send_to_client(selectDB('board_basis', 'board_basis, population', 'month(predicted_time)='.$month, 'population desc', '10'));
} else if($_POST['key']==='hotels') {
    
    $arr = send_to_client(selectDB('hotels', 'hotel, population', 'month(predicted_time)='.$month, 'population desc', '10'));
}else if($_POST['key']==='room_type') {
    
    $arr = send_to_client(selectDB('room_type', 'room_type, population', 'month(predicted_time)='.$month, 'population desc', '10'));
}

//echo $arr[0]['destination'];
//send_to_client($msg);

function selectDB($table, $require = "*", $where = "", $orderBy = "", $limit = "") {
    $dbCon = new Db_Connect();

    $conn = $dbCon->connect();

    $data = '';

    if (!empty($where))
        $where = ' WHERE ' . $where;
    if (!empty($orderBy))
        $orderBy = ' ORDER BY ' . $orderBy;
    if (!empty($limit))
        $limit = ' LIMIT ' . $limit;

    $sql = 'SELECT ' . $require . ' FROM ' . $table . $where . $orderBy . $limit;  //echo $sql;
    $result = $conn->query($sql);
    //$hash	= 0;
    if ($result) {
        
        $row_count = $result->num_rows;
        
        if ($row_count > 0) {

            //$data = $result;

            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (count($data) == "1") {

                $data = $data[0];
            }
        } else {
            $data = null;
        }
    }
    else
        $data = 'ee';
    $conn->close();
    return $data;
}

function send_to_client($msg) {
    echo json_encode($msg);
}

?>