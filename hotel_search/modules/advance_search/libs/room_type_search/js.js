function room_type_list_create(event) {

    // this need to do to avoid sloness of creating search list
    var value = remove_front_back_whitespaces(event.target.value);

    if (is_whitespace(value))
    {
        value = '';
    }

    var json_data = {
        room_type_key: value,
        destination: get_other_val('selected_destination_id'),
        board_basis: get_other_val('selected_board_basis_id')
    };
    ajaxCall(json_data, function(result) {

        var content = '';

        if (result !== null) {

            result = cleaning_ajax_result(result);

            for (var i = 0; i < result.length; i++) {

                content += '<div class="div_room_type_list_item" onmousedown="click_room_type_item(\'' + result[i]['id'] + '\', \'' + result[i]['room_type'] + '\');">' + result[i]['room_type'] + '</div>';
            }
        }

        $('#div_room_type_list').empty();
        $('#div_room_type_list').append(content);
    });
}

function click_room_type_item(id, name) {

    set_val('selected_room_type_name', name);
    set_val('selected_room_type_id', id);
    set_val('text_room_type', name);
}

function room_type_list_clear() {
    $('#div_room_type_list').empty();
    room_type_vals_reset();
}

function room_type_vals_reset() {
    if (get_val('selected_room_type_name') !== get_val('text_room_type', '')) {
        set_val('selected_room_type_name', '');
        set_val('selected_room_type_id', '');
        set_val('text_room_type', '');
    }
}
