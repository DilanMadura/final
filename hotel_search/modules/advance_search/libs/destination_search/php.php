<?php
if (isset($_POST['destination_key']))
{    
    if (($_POST['room_type'] === '-1') && ($_POST['board_basis'] === '-1'))
    {
    send_to_client(selectDB('SELECT TOP 10 id, destination
                             FROM destination
                             WHERE destination LIKE \'' . $_POST['destination_key'] . '%\''));
    }
    else if ($_POST['board_basis'] === '-1')
    {
        send_to_client(selectDB('SELECT DISTINCT TOP 10 d.id, d.destination
                                FROM destination d, ref_destination_hotel rdh, hotel h, ref_hotel_roomtype rhr
                                WHERE ((d.id = rdh.destination AND h.id = rdh.hotel AND h.id = rhr.hotel) AND d.destination LIKE \'' . $_POST['destination_key'] . '%\') AND rhr.room_type = ' . $_POST['room_type']));
    }
    else if ($_POST['room_type'] === '-1')
    {
        send_to_client(selectDB('SELECT DISTINCT TOP 10 d.id, d.destination
                                FROM destination d, ref_destination_hotel rdh, hotel h, ref_hotel_boardbasis rhb
                                WHERE ((d.id = rdh.destination AND h.id = rdh.hotel AND h.id = rhb.hotel) AND d.destination LIKE \'' . $_POST['destination_key'] . '%\') AND rhb.board_basis = ' . $_POST['board_basis']));
    }
    else 
    {
        send_to_client(selectDB('SELECT DISTINCT TOP 10 d.id, d.destination
                                FROM destination d, ref_destination_hotel rdh, hotel h, ref_hotel_boardbasis rhb, ref_hotel_roomtype rhr
                                WHERE (((d.id = rdh.destination AND h.id = rdh.hotel AND h.id = rhb.hotel AND h.id = rhr.hotel) AND d.destination LIKE \'' . $_POST['destination_key'] . '%\') AND rhb.board_basis = ' . $_POST['board_basis'] . ') AND rhr.room_type = ' . $_POST['room_type']));
    }
}
?>