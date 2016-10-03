var ar_myaccount_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        kocok: function(thisnya, accoountname, group_play) {
            // modal-body
            $.ajax({
                url: 'ar_myaccount_do.php?postmode=show',
                data: {
                    accountname: accoountname,
                    group_play: group_play
                },
                type: 'POST',
                beforeSend: function() {
                    $(thisnya).button('loading');
                },
                success: function(response) {
                    // console.log(response);
                    $('#myModal').modal('show');
                    $('.modal-body').html(response);
                    $(thisnya).button('reset');
                }
            });
            // console.log(thisnya)
        },
        savetodb: function(thisnya) {
            // modal-body
            var data = $('#ajax-form').serializeArray();
            $.ajax({
                url: 'ar_myaccount_do.php?postmode=save',
                data: data,
                type: 'POST',
                beforeSend: function() {
                    $(thisnya).button('loading');
                    // $('#myModal').modal('show');
                },
                success: function(response) {
                    console.log(response)
                    $('#myModal').modal('hide');
                    $(thisnya).button('reset');
                }
            });
        },
        copynya: function() {
            copyToClipboard('bobo');
        }
    };
}();