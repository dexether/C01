var imp_referal_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        create_accounts: function(a) {
            var data = $('#ajax-form').serializeArray();
            $.ajax({
                url: 'imp_registration_do.php?postmode=yes',
                data: data,
                type: 'POST',
                beforeSend: function() {
                    $(a).button('loading');
                },
                success: function(response) {
                    // console.log(response);
                    var res = JSON.parse(response);
                    if (res.status != 'error') {
                        var linking =  '<a href="'+ res.link +'">Click Here</a> To Login';
                    }else{
                        var linking =  'Please reload this page';
                    }
                    
                    // swal({
                    //     type: res.status,
                    //     title: res.subject,
                    //     text: res.msg,
                    //     timer: 4000,
                    //     showConfirmButton: false
                    // });
                    $(a).button('reset');
                    // console.log(res);
                    var htm = '<br/><br/><div align="center" class="col-sm-6 col-sm-offset-3"><h1>'+ res.subject +'</h1><p>' + res.msg + ' '+ linking +'</p></div>';
                    $('#conditition').html(htm);
                    // setTimeout('history.go(0);', 5000);
                }
            });
        }
    };
}();