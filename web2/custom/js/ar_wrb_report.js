var ar_wrb_report_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        get_data: function(data, button) {
            $.ajax({
                url: 'ar_wrb_report_do.php',
                data: data,
                dataType: 'JSON',
                type: 'POST',
                beforeSend: function() {
                    $(button).button('loading');
                    $('table[id=ajax-table] tbody').html('');
                },
                success: function(response) {
                    $('input[name=token]').val(response.token);
                    // console.log(response.token)
                    // console.log(response.result.length)
                    if (response.result.length > 0) {
                        // quick
                        
                        // console.log('Haha')
                        var number = 1;
                        for (var i = 0; i < response.result.length; i++) {
                            var amout = response.result[i].amount;
                        // console.log();
                            // console.log('Hahaahaha')
                            tr = $('<tr/>');
                            tr.append("<td>" + number + "</td>");
                            tr.append("<td>" + response.result[i].account + "</td>");
                            tr.append("<td>" + response.result[i].name_from + " ("+response.result[i].from +")</td>");
                            tr.append("<td>USD " + parseFloat(amout).toFixed(2) + "</td>");
                            tr.append("<td>" + response.result[i].date_receipt + "</td>");
                            tr.append("<td>" + response.result[i].comment + "</td>");
                            $('table[id=ajax-table] tbody').append(tr);
                            number++;
                        }
                    } else {
                        tr = $('<tr/>');
                        tr.append("<td colspan=8 class=text-center> Tidak ada komisi untuk bulan ini </td>");
                        $('table[id=ajax-table] tbody').append(tr);
                    }
                },
                error: function() {
                    alert('Error, call publisher');
                },
                complete: function() {
                    $(button).button('reset');
                }
            });
        }
    };
}();