var ar_admin_payment_JS = function() {
    //alert("2");
    var handle_1 = function() {}
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        admin_confirm: function(idpay, cari) {
            $('#ajax-modals').html('<img src="images/loading/spin.gif" class="img image-responsive center-block">');
            // $('#md-3d-slit').modal('show');
            $('#form-modal').toggle();
            /*$('#md-3d-slit').toggle();*/
            var url = "ar_admin_payment_modal.php";
            var data = {
                IDPay: idpay
            };
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {

                    $('#ajax-modals').html(response);
                }
            });
        },
        admin_confirm_modal: function(IDpay, status, amount, thisnya) {
            $(thisnya).hide();
            var url = "ar_admin_payment_table.php";
            var data = {
                postmode: 'yes',
                status: status,
                amount: amount,
                IDPay: IDpay
            };
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $('#form-modal').toggle();
                    $('#ajax-table').html(response);
                    // setTimeout('history.go(0);', 0);
                }
            });
        },
        admin_payment_table: function(date, type, status) {

            $('#ajax-loadings').html('<img class="img image-responsive" src="images/loading/spin.gif">');
            var url = "ar_admin_payment_table.php";
            var data = { date: date, type: type, status: status, postmode: 'querys' };
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $('#ajax-loadings').html('<a></a>');
                    // console.log(response);
                    $('#ajax-table').html(response);

                }
            });
        }
    };
}();