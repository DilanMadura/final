function board_basis_list_create(event) {

    // this need to do to avoid sloness of creating search list
    var value = remove_front_back_whitespaces(event.target.value);

    if (is_whitespace(value))
    {
        value = '';
    }
    var json_data = {
        board_basis_key: value,
        destination: get_other_val('selected_destination_id'),
        room_type: get_other_val('selected_room_type_id')
    };
    ajaxCall(json_data, function(result) {

        var content = '';

        if (result !== null) {

            result = cleaning_ajax_result(result);

            for (var i = 0; i < result.length; i++) {

                content += '<div class="div_board_basis_list_item" onmousedown="click_board_basis_item(\'' + result[i]['id'] + '\', \'' + result[i]['board_basis'] + '\');">' + result[i]['board_basis'] + '</div>';
            }
        }

        $('#div_board_basis_list').empty();
        $('#div_board_basis_list').append(content);
    });
}

function click_board_basis_item(id, name) {

    set_val('selected_board_basis_name', name);
    set_val('selected_board_basis_id', id);
    set_val('text_board_basis', name);
}

function board_basis_list_clear() {
    $('#div_board_basis_list').empty();
    board_basis_vals_reset();
}

function board_basis_vals_reset() {
    if (get_val('selected_board_basis_name') !== get_val('text_board_basis', '')) {
        set_val('selected_board_basis_name', '');
        set_val('selected_board_basis_id', '');
        set_val('text_board_basis', '');
    }
}
