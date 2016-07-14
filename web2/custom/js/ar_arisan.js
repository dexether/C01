var ar_arisan_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        daftar: function(thisnya) {
            // console.log(thisnya)


            // setTimeout(function() {
            //     $this.button('reset');
            // }, 8000);
            var data = $('#ajax-form').serializeArray();
            var url = 'ar_arisan_do.php?postmode=yes';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                beforeSend: function() {
                    thisnya.button('loading');
                },
                success: function(response) {
                    console.log(response);
                    var res = JSON.parse(response);

                    swal({
                        title: res.subject,
                        text: res.msg,
                        type: res.status,
                        showConfirmButton: true,
                        html: true
                    });
                    thisnya.button('reset');
                    if (res.status != 'error') {
                        $.ajax({
                            url: 'ar_payment.php',
                            data: {},
                            type: 'POST',
                            success: function(response) {
                                $('#main_content').html(response);
                            }
                        });
                    }
                }
            });

        },
        kocok: function(id_block, token) {

            swal({
                title: "Are you sure?",
                text: "Do you want to process ?",
                type: "info",
                confirmButtonText: "Yes, process it!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function() {
                setTimeout(function() {
                    // swal("Success!", "The job have running well.", "success");
                    // Ajax Start
                    var data = {id : id_block, token: token};
                    $.ajax({
                        url: 'ar_admin_arisan_do.php',
                        data: data,
                        type: 'POST',
                        success: function(response) {
                            var res = JSON.parse(response)
                            swal(res.subject, res.msg, res.status);
                            
                        }
                    });
                }, 1000);
            });
        }
    };
}();