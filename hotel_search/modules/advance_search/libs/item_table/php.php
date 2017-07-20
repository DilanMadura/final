<?php

if (isset($_POST['table_load'])) {
    
    $from = 'FROM hotel h, predict_hotel p';
    
    $where = 'WHERE h.hotel = p.hotel AND MONTH(p.predicted_time) = DATEPART(MM, \''.$_POST['table_load']['month'].'\')';
    
    if ($_POST['table_load']['destination'] !== '-1')
    {
        $from .= ', ref_destination_hotel rdh';
        
        $where .= ' AND h.id = rdh.hotel AND rdh.destination = '.$_POST['table_load']['destination'];
    }
    
    if ($_POST['table_load']['room_type'] !== '-1')
    {
        $from .= ', ref_hotel_roomtype rhr';
        
        $where .= ' AND h.id = rhr.hotel AND rhr.room_type = '.$_POST['table_load']['room_type'];
    }
    
    if ($_POST['table_load']['board_basis'] !== '-1')
    {
        $from .= ', ref_hotel_boardbasis rhb';
        
        $where .= ' AND h.id = rhb.hotel AND rhb.board_basis = '.$_POST['table_load']['board_basis'];
    }
    
    $sql = 'SELECT hotel, population
            FROM (
            SELECT DISTINCT ROW_NUMBER() OVER (ORDER BY p.population DESC) as row, h.hotel, p.population
            '. $from .'
            '. $where .'
            ) AS MyDerivedTable
            WHERE row BETWEEN '. get_start_limit($_POST['table_load']['page']) .' AND '. get_end_limit($_POST['table_load']['page']);
    
    //echo $sql;
            
    $result = selectDB($sql);
    
    $final_result[0] = '';
    
    if (isset($result['hotel']))
    {
        $final_result[0] = $result;
    }
    else
    {
        $final_result = $result;
    }
    
    $count_sum = selectDB('SELECT COUNT(row) AS pages
                           FROM (
                           SELECT DISTINCT ROW_NUMBER() OVER (ORDER BY p.population DESC) as row, h.hotel, p.population
                           '. $from .'
                           '. $where .'
                           ) AS MyDerivedTable');
    
    $grand_final_result['page'] = ceil($count_sum[0]['pages']/20);
    $grand_final_result['result'] = $final_result;
    
    send_to_client($grand_final_result);
    
    /*if ($_POST['table_load']['date_1'] !== '' && $_POST['table_load']['date_2'] !== '') {
        $where .= ' AND (date BETWEEN \'' .date_convert($_POST['table_load']['date_1']) . '\' AND \'' . date_convert($_POST['table_load']['date_2']) . '\')';
    } else if ($_POST['table_load']['date_1'] !== '') {
        $where .= ' AND date =\'' . date_convert($_POST['table_load']['date_1']).'\'';
    } else if ($_POST['table_load']['date_2'] !== '') {
        $where .= ' AND date =\'' . date_convert($_POST['table_load']['date_2']).'\'';
    }

    if ($_POST['table_load']['company_id'] !== '') {
        $where .= ' AND company =' . $_POST['table_load']['company_id'];
    }

    if ($_POST['table_load']['paid'] !== '') {
        $where .= ' AND paid =' . $_POST['table_load']['paid'];
    }

    $limit = get_start_limit($_POST['table_load']['page']).', 20';
    
    $result = selectDB('purchase_orders p, company c', 'p.id AS poid, p.date, c.name AS company, p.grand_total', $where, 'date desc', $limit);
    
    $final_result[0] = '';
    
    if (isset($result['date']))
    {
        $final_result[0] = $result;
    }
    else
    {
        $final_result = $result;
    }
    
    $count_sum = selectDB('purchase_orders p, company c', 'COUNT(p.id) AS count, SUM(p.grand_total) AS net_value', $where, '', '');
    
    $grand_final_result['page'] = ceil($count_sum['count']/20);
    $grand_final_result['net_value'] = format_to_price($count_sum['net_value']);
    $grand_final_result['result'] = $final_result;
    
    send_to_client($grand_final_result);*/
}

function get_start_limit($page) {
    return ($page - 1) * 20;
}

function get_end_limit($page)
{
    return get_start_limit($page) + 20;
}

?>