<?php
if (isset($_POST['room_type_key'])) {    
    
    if (($_POST['destination'] === '-1') && ($_POST['board_basis'] === '-1'))
    {
    send_to_client(selectDB('SELECT TOP 10 id, room_type
                             FROM room_type
                             WHERE room_type LIKE \'' . $_POST['room_type_key'] . '%\''));
    }
    else if ($_POST['board_basis'] === '-1')
    {
        send_to_client(selectDB('SELECT DISTINCT TOP 10 r.id, r.room_type
                                FROM room_type r, ref_hotel_roomtype rhr, ref_destination_hotel rdh
                                WHERE ((r.id = rhr.room_type AND rhr.hotel = rdh.hotel) AND r.room_type LIKE \'' . $_POST['room_type_key'] . '%\') AND rdh.destination = ' . $_POST['destination']));
    }
    else if ($_POST['destination'] === '-1')
    {
        send_to_client(selectDB('SELECT DISTINCT TOP 10 r.id, r.room_type
                                 FROM room_type r, ref_hotel_roomtype rhr, ref_hotel_boardbasis rhb
                                 WHERE ((r.id = rhr.room_type AND rhr.hotel = rhb.hotel) AND r.room_type LIKE \'' . $_POST['room_type_key'] . '%\') AND rhb.board_basis = ' . $_POST['board_basis']));
    }
    else 
    {
        send_to_client(selectDB('SELECT DISTINCT TOP 10 r.id, r.room_type
                                FROM room_type r, ref_hotel_roomtype rhr, ref_hotel_boardbasis rhb, ref_destination_hotel rdh
                                WHERE (((r.id = rhr.room_type AND rhr.hotel = rhb.hotel  AND rhr.hotel = rdh.hotel) AND r.room_type LIKE \'' . $_POST['room_type_key'] . '%\') AND rhb.board_basis = ' . $_POST['board_basis'] . ') AND rdh.destination = ' . $_POST['destination']));
    }
}
?>