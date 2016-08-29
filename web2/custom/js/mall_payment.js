var mall_payment_JS = function() {
    //alert("2");
    var handle_1 = function() {}
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        get_data: function(data, buttons) {
            $.ajax({
                    url: 'mall_payment_do.php?postmode=get',
                    type: 'POST',
                    dataType: 'JSON',
                    data: data,
                })
                .done(function(response) {
                    $('table tbody').html(response.data_html);
                    // console.log(response.token);
                    $('input[name=token]').val(response.token);
                    // console.log($('input[name=token]'))
                })
                .fail(function() {
                    alert('Error while get data, contact Admin')
                })
                .always(function() {
                    $(buttons).button('reset');
                });
        },
        admin_confirm: function(invoice, token) {
            // approve
            // console.log(token);
            swal({
                    title: "Are you sure",
                    text: "Approve this payment",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function() {
                    setTimeout(function() {

                        $.ajax({
                                url: 'mall_payment_do.php?postmode=approve',
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    invoice: invoice,
                                    token: token
                                },
                            })
                            .done(function(response) {

                                swal(response.msg);
                                $('input[name=token]').val(response.token);
                            })
                            .fail(function() {
                                alert('Error while get data, contact Admin')
                            })
                            .always(function() {
                                // $(buttons).button('reset');
                                // $('input[name=token]').val(response.token);
                            });
                        setTimeout(function() {
                            $('form[id=ajax-form]').submit();
                        }, 2000);

                    }, 1000);
                });
            return false;
        },
        admin_reject: function(invoice, token) {
            // approve
            // console.log(token);
            swal({
                    title: "Are you sure",
                    text: "want to reject this payment?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function() {
                    setTimeout(function() {

                        $.ajax({
                                url: 'mall_payment_do.php?postmode=reject',
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    invoice: invoice,
                                    token: token
                                },
                            })
                            .done(function(response) {

                                swal(response.msg);
                                $('input[name=token]').val(response.token);
                            })
                            .fail(function() {
                                alert('Error while get data, contact Admin')
                            })
                            .always(function() {
                                // $(buttons).button('reset');
                                // $('input[name=token]').val(response.token);
                            });
                        setTimeout(function() {
                            $('form[id=ajax-form]').submit();
                        }, 2000);

                    }, 1000);
                });
            return false;
        },
        admin_send: function(invoice, token) {
            // approve
            // console.log(token);
            swal({
                    title: "Require Receipt Journ",
                    text: "Write something interesting:",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Write something",

                    // title: "Are you sure",
                    // text: "want to reject this payment?",
                    // type: "info",
                    showCancelButton: true,
                    // closeOnConfirm: false,
                    showLoaderOnConfirm: true
                },
                function(inputValue) {
                    if (inputValue === false) return false;
                    if (inputValue === "") {
                        swal.showInputError("Please enter your Receipt number");
                        return false
                    }
                    setTimeout(function() {
                        // alert('test');
                        $.ajax({
                                url: 'mall_payment_do.php?postmode=send',
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    invoice: invoice,
                                    token: token,
                                    resi: inputValue
                                },
                            })
                            .done(function(response) {

                                swal(response.msg);
                                $('input[name=token]').val(response.token);
                            })
                            .fail(function() {
                                alert('Error while get data, contact Admin')
                            })
                            .always(function() {
                                // $(buttons).button('reset');
                                // $('input[name=token]').val(response.token);
                            });
                        setTimeout(function() {
                            $('form[id=ajax-form]').submit();
                        }, 2000);

                    }, 1000);
                });
            return false;

        }
    };
}();
