var ar_payment_JS = function() {
    //alert("2");
    var handle_1 = function() {}
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        payment_confirmation: function(a, b) {
            var url = 'ar_payment_show.php';
            var data = {
                accnoselect: a,
                shownya: b
            };
            $("#ajax-loader").html('<img class="img-responsive center-block" src="images/loading/spin.gif" width="100" height="100">');
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $("#ajax-loader").html(response);
                }
            });
        },
        payment_cash: function(idpay, account, type, method, agent, amount, date, time, file) {
            var formData = new FormData($('#ajax-form')[0]);
            $("#buttons").hide();
            // alert("Clicked oy" + account + type + method + amount + date + time);
            var url = 'ar_payment_cash.php';
            // var data = {account: account, type: type, method: method, amount: amount, date: date, time: time, agent: agent};
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.substring(0, 1) == '0') {
                        var title = 'Payment Confirmation';
                        var keterangan = 'Thank you for submitting payment documents, we will confirm your payment within 1 x 24 hours, if you have any questions please contact us at <strong>finance@apexregent.com</strong>. this page will redirect to dashboard page ini 5 seconds';
                        notifysuccess_common('success', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 5000);
                    }
                }
            });
        },
        payment_tf: function(idpay, account, type, method, agent, amount, date, time, file) {
            var formData = new FormData($('#ajax-form')[0]);
            $("#buttons").hide();
            // alert("Clicked oy" + account + type + method + amount + date + time);
            var url = 'ar_payment_tf.php';
            // var data = {account: account, type: type, method: method, amount: amount, date: date, time: time, agent: agent};
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.substring(0, 1) == '0') {
                        var title = 'Payment Confirmation';
                        var keterangan = 'Thank you for submitting payment documents, we will confirm your payment within 1 x 24 hours, if you have any questions please contact us at <strong>finance@apexregent.com</strong>. this page will redirect to dashboard page ini 5 seconds';
                        notifysuccess_common('success', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 5000);
                    }
                }
            });
        }
    };
}();