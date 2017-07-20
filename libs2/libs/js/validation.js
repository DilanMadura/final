// use in onkeypress=""
function input_validate_keypress(event, length, vlidate_type) {

    var pressed_str = String.fromCharCode(event.keyCode);
    // this if condition negotiate validate the enter key press
    if (event.keyCode !== 13)
    {
        if (vlidate_type === undefined) {
            // text validate        
            if (!is_below_length(event.target.value, length)) {
                //console.log('length');
                alert('maxsimun length exceeded (' + length + ')');
                // bug in firefox - when press backspace this work
                event.preventDefault();

            } else if (!is_special_character_forText(pressed_str)) {

                alert('not allowed special characters. but you can use ( ) - \' , . and @ ');
                // bug - when press backspace this work
                event.preventDefault();
            }

        } else {
            // nuber validate
            if (!is_below_length(event.target.value, length)) {

                alert('maxsimun length exceeded (' + length + ')');
                // bug - when press backspace this work
                event.preventDefault();

            } else if (!is_number_valiate_keypress(event.target.value, pressed_str)) {

                alert('invalied price value');
                // bug - when press backspace this work
                event.preventDefault();
            }

        }
    }
}

// can also use in onkeyup=""
function input_validate_focusout(event, length, vlidate_type) {

    var str = event.target.value;

    length++;

    if (vlidate_type === undefined) {
        // text validate        
        if (!is_below_length(event.target.value, length)) {
            //console.log('length');
            alert('maxsimun length exceeded (' + length + ')');
            // bug in firefox - when press backspace this work
            $("#" + event.target.id).val('');

        } else if (!is_special_character_forText(str)) {

            alert('not allowed special characters. but you can use ( ) - \' , . and @ ');
            // bug - when press backspace this work
            $("#" + event.target.id).val('');
        }

    } else {
        // nuber validate
        if (!is_below_length(event.target.value, length)) {

            alert('maxsimun length exceeded (' + length + ')');
            // bug - when press backspace this work
            $("#" + event.target.id).val('');

        } else if (!is_number_valiate(str)) {

            alert('please enter only nubers');
            // bug - when press backspace this work
            $("#" + event.target.id).val('');
        }

    }

}

// call when click on search div -> in if condition -> validate pated value is ok -> this function use to avoid create new field when user ckick "create new" after pated a invalied value to input field
function input_pasteValidate_avoidCreateList(str, length, vlidate_type) {

    if (vlidate_type === undefined) {
        console.log('came');
        // text validate        
        if (!is_below_length(str, length)) {
            //console.log('length');
            //alert('maxsimun length exceeded ('+length+')'); 
            //console.log('length');
            return false;

        } else if (!is_special_character_forText(str)) {

            //alert('not allowed special characters. but you can use ( ) - \' , . and @ ');
            //console.log('special char');
            return false;

        } else {
            //console.log('true');
            return true;
        }

    } else {
        // nuber validate
        if (!is_below_length(str, length)) {

            //alert('maxsimun length exceeded ('+length+')');

            return false;

        } else if (!is_number_valiate(str)) {

            //alert('please enter only nubers');            
            return false;
        } else {

            return true;
        }
        //alert('saranga : sill working');

    }

}

function is_number_valiate(str) {

    if ((str.match(/\./gi) || []).length === 1 || (str.match(/\./gi) || []).length === 0) {//is_contains_noOfTimes (str, '.', 1) || is_contains_noOfTimes (str, '.', 0)) {

        str = str.replace(/\./g, "");
        if (is_only_digits(str)) {
            // console.log('number validated');
            return true;

        } else {

            return false;

        }

    } else {

        return false;

    }

}

function is_number_valiate_keypress(str, char) {

    //if ((str.match(/\./gi) || []).length === 1 || (str.match(/\./gi) || []).length === 0) {//is_contains_noOfTimes (str, '.', 1) || is_contains_noOfTimes (str, '.', 0)) {
    if (((char === '.') && ((str.match(/\./gi) || []).length === 0)) || ((char !== '.') && ((str.match(/\./gi) || []).length === 1)) || ((char !== '.') && ((str.match(/\./gi) || []).length === 0))) {
        //str = str.replace(/\./g, "");

        if (char === '.') {

            return true;

        } else if (is_only_digits(char)) {
            // console.log('number validated');
            return true;

        } else {

            return false;

        }

    } else {

        return false;

    }

}

/*function is_empty_msg(id, msg)
{
    if (document.getElementById(id).value === '')
    {
        alert(msg);
        return true;
    }
    else
    {
        return false;
    }
}*/