function startup_func()
{
    var json_data = {
        startup: '1'
    };

    ajaxCall(json_data, function(result) {

        var content = '';

        for (var i = 0; i < result.length; i++)
        {
            console.log(result[i]['month']);
            
            content += '<option value="' + result[i]['month'] + '">' + result[i]['month'] + '</option>';
        }
        $('#month').append(content);
    });
}