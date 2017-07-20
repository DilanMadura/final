<?php

function create_item_code($name) {
    
    $code_string = create_code_string($name);
    
    return $code_string.get_code_no($code_string);
}

function get_code_no($code_string) {    
     
     //$no = selectDB_count('inventory', 'code_string', 'code_string = "'.$code_string.'"');
     $result = selectDB('inventory', 'code', 'code_string = "'.$code_string.'" ORDER BY code desc LIMIT 1');
     
     return (str_replace($code_string,'',$result['code']))+1;
}

function create_code_string($name) {
    
    //return substr($name, 1);
    $arr = explode(' ', $name);
    $str = '';
    
    for($i = 0; $i<count($arr); $i++) {
        
        //$str += $arr[$i];
        if (!empty($arr[$i])) {
        
            $str .= strtoupper(substr($arr[$i], 0, 1));
        }
    }    
    return $str;
}
?>