var ar_admin_document_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        document_confirm: function(aecode, name, token) {
            // console.log(aecode);
            var data = {
                aecode: aecode,
                name  : name,
                token : token
            };
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
                    $.ajax({
                        url: 'ar_subadmin_link_do.php?postmode=document',
                        data: data,
                        type: 'POST',
                        success: function(response) {
                            // console.log(response);
                            var res = JSON.parse(response);
                            swal(res.subject, res.msg, res.status);
                            $.ajax({
                                url: 'ar_subadmin_link.php',
                                data: {},
                                type: 'POST',
                                success: function(response) {
                                    $('#main_content').html(response);
                                }
                            });
                        }
                    });
                }, 1000);
            });
        },
    };
}();