var manage_JS = function() {
    //alert("2");
    var handle_withdrawal = function() {}
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-11");
            //handle_withdrawal();
        },
        filter_do: function(a,b) {
            // console.log(b);
            $(a).button('loading');
            $.ajax({
                url: 'imp_manage_schema_do.php?postmode=get_data',
                data: {mt4dt : b},
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function() {
                    $('table[id=tabel-schema]').show();
                    $('table[id=tabel-schema] tbody').html('');
                },
                success: function(response) {
                    $(a).button('reset');
                    // console.log(response);
                    $('#thProduct').html(response.alias);
                    if (response.data.length > 0) {
                        for (var i = 0; i < response.data.length; i++) {
                            tr = $('<tr/>');
                            tr.append("<td>" + response.data[i].ae_level + "</td>");
                            tr.append("<td><input type=text onkeydown='manage_JS.only_number(event);' name=" + response.data[i].nasabah_id + " class=form-control value =" + response.data[i].nasabah_value + " /></td>");
                            tr.append("<td><input type=text onkeydown='manage_JS.only_number(event);' name=" + response.data[i].ae_id + " class=form-control value =" + response.data[i].ae_value + " /></td>");
                            $('table[id=tabel-schema] tbody').append(tr);
                        }
                        tr = $('<tr/>');
                        tr.append("<td colspan=2></td>");
                        tr.append("<td colspan=1><button class='btn btn-blue-1' name='save' type='button' onclick = 'manage_JS.save_do(this);'>Change</button></td>");
                        $('table[id=tabel-schema] tbody').append(tr);
                    }
                },
                error: function() {
                    alert('Error : Select type');
                    $(a).button('reset');
                }
            });
        },
        save_do: function(a) {
            $(a).button('loading');
            // console.log(a);
            var data = $('#ajax-form').serializeArray();
            $.ajax({
                url: 'imp_manage_schema_do.php?postmode=save_db',
                data: {
                    data: data
                },
                type: 'POST',
                beforeSend: function() {
                    
                },
                success: function(response) {
                    $(a).button('reset');
                    // console.log(response)
                }
            });
        },
        only_number: function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: Ctrl+C
                (e.keyCode == 67 && e.ctrlKey === true) ||
                // Allow: Ctrl+X
                (e.keyCode == 88 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        }
    };
}();