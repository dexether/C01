var ar_admin_transfer_JS = function() {
    //alert("2");
    var handle_1 = function() {}
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        admin_confirm: function(id) {
            swal({
                    title: "Are you sure",
                    text: "Do you want to confirm this transfer " + id,
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonColor: "#03AD42",
                    confirmButtonText: "Yes, confirm it!",
                    cancelButtonText: "No,!",
                }, function() {
                    setTimeout(function() {
                            // Ajax Here
                            $.ajax({
                                    url: 'ar_admin_transfer_do.php',
                                    data: {
                                        id: id,
                                        postmode: "yes"
                                    },
                                    type: 'POST',
                                    success: function(response) {
                                        console.log(response);
                                        if (typeof response == 'object') {
                                            swal(response.subject, response.msg, response.status);
                                        } else {
                                            swal("Oops, something went wrong", "please call the application publisher", "error");
                                            // swal("Sucess", "SSS", "warning");
                                        }
                                        $.ajax({
                                                url: 'ar_admin_transfer.php',
                                                data: {},
                                                type: 'POST',
                                                success: function(response) {
                                                    $('#main_content').html(response);
                                                }

                                            
                                        });

                                    // $('#ajax-modals').html(response);
                                }
                            });

                    }, 1000);
            });
    }
};
}();