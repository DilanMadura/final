function destination_list_create(event) {
    //console.log('came');
    // this need to do to avoid sloness of creating search list
    var value = remove_front_back_whitespaces(event.target.value);

    if (is_whitespace(value))
    {
        value = '';
    }
    var json_data = {
        destination_key: value,
        room_type: get_other_val('selected_room_type_id'),
        board_basis: get_other_val('selected_board_basis_id')
    };

    ajaxCall(json_data, function(result) {

        var content = '';

        if (result !== null) {

            result = cleaning_ajax_result(result);

            for (var i = 0; i < result.length; i++) {

                content += '<div class="div_destination_list_item" onmousedown="click_destination_item(\'' + result[i]['id'] + '\', \'' + result[i]['destination'] + '\');">' + result[i]['destination'] + '</div>';
            }
        }
        $('#div_destination_list').empty();
        $('#div_destination_list').append(content);
    });
}

function click_destination_item(id, name) {

    set_val('selected_destination_name', name);
    set_val('selected_destination_id', id);
    set_val('text_destination', name);
}

function destination_list_clear() {
    $('#div_destination_list').empty();
    destination_vals_reset();
}

function destination_vals_reset() {
    if (get_val('selected_destination_name') !== get_val('text_destination', '')) {
        set_val('selected_destination_name', '');
        set_val('selected_destination_id', '');
        set_val('text_destination', '');
    }
}
