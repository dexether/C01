var MLM_Registration_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        mm_new_level2: function(selectId, email, hp) {
            var url = 'mm_registration2.php?postmode=createnewlevel2&rupiah=' + selectId + "&email=" + email + "&hp=" + hp;
            //alert("Line-11-URL:"+url);
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    alert("18:" + response);
                    var res = response.substring(0, 1);
                    //alert("20:" + res);
                    if (res == '0') { //success
                        //alert("22:Success");
                        var title = 'Creating new Account has been done Successfully';
                        var keterangan = 'Please wait for a moment to refresh the Web';
                        notifysuccess_common('success', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 4000);
                    } else if (res == '1') { //Fail
                        //alert("28:Fail");
                        var title = 'Creating New Account Fail';
                        var keterangan = 'Please call admin';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 6000);
                    } else if (res == '3') { //Access unAuthorize
                        //alert("35:Fail");
                        var title = "Message Ref 119. The Upline Email : " + email + " is not registered yet";
                        var keterangan = 'Please check again your Upline Email ID';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 6000);
                    }
                }
            });
        }
    };
}();