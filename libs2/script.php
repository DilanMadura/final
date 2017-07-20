<?php

require 'libs/php/db_connect.php';
require 'libs/php/other.php';

session_start();

if (isset($_POST['population'])) {

    $_POST['date'] = $_POST['date'] . ' 00:00:00.000';

    $msg = '0';

    $msg = insertDB('insert into source_hotel values (1, ' . $_POST['population'] . ', \'' . $_POST['hotel'] . '\', \'' . $_POST['date'] . '\')');

    if ($msg === '1') {
        $msg = insertDB('insert into source_destination values (1, ' . $_POST['population'] . ', \'' . $_POST['destination'] . '\', \'' . $_POST['date'] . '\')');

        if ($msg === '1') {
            $msg = insertDB('insert into source_room_type values (1, ' . $_POST['population'] . ', \'' . $_POST['room_type'] . '\', \'' . $_POST['date'] . '\')');
        }
        if ($msg === '1') {
            $msg = insertDB('insert into source_board_basis values (1, ' . $_POST['population'] . ', \'' . $_POST['board_basis'] . '\', \'' . $_POST['date'] . '\')');
        }
    }

    send_to_client($msg);
} else if (isset($_POST['feedback'])) {
    //echo 'came';
    $msg = insertDB('insert into feed_back values (\'' . $_POST['feedback'] . '\', \'' . $_POST['name'] . '\', \'' . $_POST['country'] . '\', \'' . $_POST['email'] . '\')');

    send_to_client($msg);
} else if (isset($_POST['view_feedback'])) {    
    
        send_to_client(selectDB('SELECT * FROM feed_back'));
    
} 
else if (isset($_POST['hotel_analyze'])) {
    //echo 'came';

    send_to_client(selectDB('SELECT TOP 10 hotel, population 
                             FROM predict_hotel
                             WHERE MONTH(predicted_time) = \'' . $_POST['month'] . '\'
                             ORDER BY population desc'));
}

 else if (isset($_POST['board_basis_analyze'])) {
    //echo 'came';

    send_to_client(selectDB('SELECT TOP 10 board_basis, population 
                             FROM predict_board_basis
                             WHERE MONTH(predicted_time) = \'' . $_POST['month'] . '\'
                             ORDER BY population desc'));
} else if (isset($_POST['destination_analyze'])) {
    //echo 'came';

    send_to_client(selectDB('SELECT TOP 10 destination, population 
                             FROM predict_destination
                             WHERE MONTH(predicted_time) = \'' . $_POST['month'] . '\'
                             ORDER BY population desc'));
} else if (isset($_POST['room_type_analyze'])) {
    //echo 'came';

    send_to_client(selectDB('SELECT TOP 10 room_type, population 
                             FROM predict_room_type
                             WHERE MONTH(predicted_time) = \'' . $_POST['month'] . '\'
                             ORDER BY population desc'));
}
else if (isset($_POST['username']))
{
    $msg = '';
    
    if (isset($_SESSION['username']))
    {
        session_destroy();
    }
    
        $result = selectDB('SELECT password
                             FROM login_tab
                             WHERE name = \''. $_POST['username'] .'\'');
        
        $password = $result[0]['password'];
        
        /*var_dump($result);
        var_dump($_POST);*/
        
        if ((strcmp($password, $_POST['password']) === 0) && (strcmp('', $_POST['password']) !== 0))
        {
            $msg = true;
            $_SESSION['username'] = $_POST['username'];
        }
        else 
        {
            $msg = false;
        }
    
    send_to_client($msg);
}
?>