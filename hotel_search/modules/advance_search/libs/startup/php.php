<?php
if (isset($_POST['startup'])) {    
    
    send_to_client(selectDB('SELECT CONVERT(CHAR(4), predicted_time, 100) + CONVERT(CHAR(4), predicted_time, 120) AS month
                             FROM predict_board_basis
                             WHERE board_basis = \'BB\''));
    

}
?>