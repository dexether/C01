var AR_Registration_JS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        ar_registration: function(accnomlm, plan, hp) {
            $('#ajax-btn').hide();
            var url = 'ar_registration_do.php?postmode=postmode&accnomlm=' + accnomlm + "&plan=" + plan + "&hp=" + hp;
            //alert("Line-11-URL:"+url);
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    console.log(response);
                    var res = response.substring(0, 1);
                    //alert("20:" + res);
                    if (res == '0') { //success
                        //alert("22:Success");
                        var title = 'Creating new Account has been done Successfully';
                        var keterangan = 'Yor Upline now <strong>' + accnomlm + '</strong> you will redirect to payment page, please wait ...';
                        notifysuccess_common('success', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 4000);

                    } else if (res == '1') { //Fail
                        //alert("28:Fail");
                        var title = 'Creating New Account Fail';
                        var keterangan = 'Please call admin';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 4000);
                    } else if (res == '3') { //Access unAuthorize
                        //alert("35:Fail");
                        var title = "Message Ref 119. The Upline Account Number : " + accnomlm + " is not registered yet";
                        var keterangan = 'Please check again your Upline Email ID';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 4000);
                    }
                }
            });
        },
        imp_registration: function(thisnya) {
            $(thisnya).button('loading');
            var data = $('#registerForm').serializeArray();
            $.ajax({
                url: 'imp_registration_do.php?postmode=yes',
                data: data,
                type: 'POST',
                beforeSubmit: function() {

                },
                success: function(response) {
                    // console.log(response);
                    var res = JSON.parse(response);
                    swal({
                        type: res.status,
                        title: res.subject,
                        text: res.msg,
                        timer: 4000,
                        showConfirmButton: false
                    });
                    $(thisnya).button('reset');
                    setTimeout('history.go(0);', 5000);
                }
            });


        }
    };

}();