function table_load(page)
{
    var arr = {};
    
    arr['month'] = get_val_dropdown('month');
    arr['destination'] = get_other_val('selected_destination_id');
    arr['room_type'] = get_other_val('selected_room_type_id');
    arr['board_basis'] = get_other_val('selected_board_basis_id');
    arr['page'] = page;
    
     var json_data = {
                table_load: arr
            };
    ajaxCall(json_data, function(result) 
    {
        
        
        console.log(result);
        console.log(result['page']);
        //alert('cam');
        
        print_table(result['result']);
        
        //set_val_text('net_value', result['net_value']);
        set_pages(result['page']);
        
        document.getElementById('page').selectedIndex = page-1;
    });
}

function print_table(result)
{
    var content = '';
    
    //alert(object_size(result));
    for (var i=0; i<object_size(result); i++)
    {   
        content += '<div> <div class="item_table_cell_left_align">'+result[i]['hotel']+'</div> <div class="item_table_cell_left_align">'+result[i]['population']+'</div></div>';
    }
    $('#table_body').empty();
    $('#table_body').append(content);
}

function set_pages(pages)
{
    make_dropdown_empty('page');
    
    var element = document.getElementById('page');
     
     for (var i=1; i<=pages; i++)
     {
        element.options[element.options.length] = new Option(i, i);
     }
    /*var content = ''
    
    for (var i=1; i<=pages; i++)
     {
        content += '<option value="'+i+'">'+i+'</option>';
     }
     $('#page').empty();
     $('#page').append(content);*/
}

function open_po_page(poid)
{
    window.location = '../purchase_order_update/index.html?'+poid;
}
