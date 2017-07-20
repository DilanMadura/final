function ajaxCall(data_json, callBack) {

    $.ajax({
        type: 'post',
        url: "script.php",
        data: data_json,
        timeout: 100000, // sets timeout for the request (10 seconds)

        error: function(xhr, status, error) {

            alert('Error: ' + xhr.status + ' - ' + error);

        },
        success: function(result) {

            if (callBack && typeof(callBack) === "function") {

                callBack(JSON.parse(result));

            }

        }

    });

}

function removeElement(id) {
    document.getElementById(id).parentElement.removeChild(document.getElementById(id));
}

function is_element_exist(id) {
    if ($('#' + id).length === 0) {
        return false;
    } else {
        return true;
    }
}

function reset_input(id) {
    $('#' + id).val('');
}

function get_val(id) {
    return $('#' + id).val();
}

function get_other_val(id)
{
    var val = get_val(id);

    if (val === '')
    {
        return '-1';
    }
    else
    {
        return val;
    }
}

function set_val(id, val) {
    $('#' + id).val(val);
}

function get_val_text(id)
{
    return $('#' + id).text();
}

function set_val_text(id, val)
{
    document.getElementById(id).innerHTML = val;
}

// if check box is checked return 1 else return 0
function get_val_check(id)
{
    if (document.getElementById(id).checked === true)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

// if num = 1  -> check    else -> uncheck
function set_val_check(id, check_bit)
{
    check_bit = parseInt(check_bit);

    if (check_bit === 1)
    {
        document.getElementById(id).checked = true;
    }
    else
    {
        document.getElementById(id).checked = false;
    }
}

function get_val_dropdown(id)
{
    var e = document.getElementById(id);
    return e.options[e.selectedIndex].value;
}

function select_option(id, val) {
    document.getElementById(id).value = val;
}

function to_uppercase_each_word(str) {

    return str.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });

}

// check str contains only a white spaces
// can use for validate input required field
function is_whitespace(str) {

    if (!(/\S/.test(str))) {

        return true;

    } else {

        return false;

    }

}

// further this function can convert big white spaces to single one
function remove_front_back_whitespaces(str) {

    return str.replace(/\s\s+/g, ' ').trim();//str.replace(/\s+$/, '');
}

// eg :- is_contains('sara _ nga', '_')     ->      true
function is_contains(str, peticuar_string) {

    if (str.indexOf(peticuar_string) > -1)
    {
        return true;
    } else {
        return false;
    }

}

function is_special_character(str) {

    return /[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);

}

function is_special_character_forText(str) {

    return !/[~`!#$%\^&*+=\[\]\\;/{}|\\":<>\?\_]/g.test(str);

}

function is_below_length(str, length) {

    if (add_slash(str).length < length) {

        return true;

    } else {

        return false;

    }

}

function is_contains_noOfTimes(str, match, number) {

    if (count_occurrences(str, match) === number) {

        return true;

    } else {

        return false;

    }

}

function count_occurrences(str, value) {
    /*var regExp = new RegExp(value, "gi");
     console.log(regExp);
     console.log(value);
     console.log((str.match(regExp) || []));
     return (str.match(regExp) || []).length;*/
    return (str.match(/\./gi) || []).length;
}

function is_only_digits(str) {
    return !/\D/.test(str);
}

function add_slash(str) {
    return str.replace(/\)/g, '\\)').replace(/-/g, '\\-').replace(/'/g, "\\'").replace(/,/g, '\\,').replace(/@/g, '\\@').replace(/\(/g, '\\(');
}

function remove_slash(str) {
    return str.replace(/\\/g, '');
}

function remove_last_char(str) {
    return str.substring(0, str.length - 1);
}

function increse_string_number(element_id) {
    $('#' + element_id).val(parseInt($('#' + element_id).val()) + 1);
}

function prepare_for_insert(val) {
    return add_slash(remove_front_back_whitespaces(val));
}

// this function is used for search text box
function cleaning_ajax_result(result) {
    var arr = [];
    if (result.length === undefined) {
        arr[0] = result;
    } else {
        arr = result;
    }
    return arr;
}
// msg is optional parameter
function is_empty(id, msg)
{
    if (document.getElementById(id).value === '')
    {
        if (msg !== undefined)
        {
            alert(msg);
            $('#' + id).focus();
        }
        return true;
    }
    else
    {
        return false;
    }
}

function object_size(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key))
            size++;
    }
    return size;
}

function make_dropdown_empty(id)
{
    document.getElementById(id).innerHTML = "";
}