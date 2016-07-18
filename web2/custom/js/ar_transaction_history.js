var ar_transaction_history_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        get_data: function(data, button) {
            $.ajax({
                url: 'ar_transaction_history_do.php',
                data: data,
                dataType: 'JSON',
                type: 'POST',
                beforeSend: function() {
                    $(button).button('loading');
                },
                success: function(response) {
                    $('input[name=token]').val(response.token);
                    console.log(response.token)
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