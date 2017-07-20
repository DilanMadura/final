<?php

if (isset($_POST['board_basis_key'])) {
    
    if (($_POST['destination'] === '-1') && ($_POST['room_type'] === '-1'))
    {
    send_to_client(selectDB('SELECT TOP 10 id, board_basis
                             FROM board_basis
                             WHERE board_basis LIKE \'%' . $_POST['board_basis_key'] . '%\''));
    }
    else if ($_POST['room_type'] === '-1')
    {
        send_to_client(selectDB('SELECT DISTINCT TOP 10 r.id, r.board_basis
                                FROM board_basis r, ref_hotel_boardbasis rhr, ref_destination_hotel rdh
                                WHERE ((r.id = rhr.board_basis AND rhr.hotel = rdh.hotel) AND r.board_basis LIKE \'' . $_POST['board_basis_key'] . '%\') AND rdh.destination = ' . $_POST['destination']));
    }
    else if ($_POST['destination'] === '-1')
    {
        send_to_client(selectDB('SELECT DISTINCT TOP 10 r.id, r.board_basis
                                 FROM board_basis r, ref_hotel_boardbasis rhr, ref_hotel_roomtype rhb
                                 WHERE ((r.id = rhr.board_basis AND rhr.hotel = rhb.hotel) AND r.board_basis LIKE \'' . $_POST['board_basis_key'] . '%\') AND rhb.room_type = ' . $_POST['room_type']));
    }
    else 
    {
        send_to_client(selectDB('SELECT DISTINCT TOP 10 r.id, r.board_basis
                                FROM board_basis r, ref_hotel_boardbasis rhr, ref_hotel_roomtype rhb, ref_destination_hotel rdh
                                WHERE (((r.id = rhr.board_basis AND rhr.hotel = rhb.hotel  AND rhr.hotel = rdh.hotel) AND r.board_basis LIKE \'' . $_POST['board_basis_key'] . '%\') AND rhb.room_type = ' . $_POST['room_type'] . ') AND rdh.destination = ' . $_POST['destination']));
    }
}   
    
?>