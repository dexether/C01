var Apr_account_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        genratenow: function(token) {
            // console.log(token);
            // console.log(filenya);
            var data = {
                token: token

            };
            swal({
                title: "Are you sure?",
                text: "Do you want to update username ?",
                type: "info",
                confirmButtonText: "Yes, run it!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function() {
                setTimeout(function() {
                    // swal("Success!", "The job have running well.", "success");
                    // Ajax Start
                    $.ajax({
                        url: 'apr_account_do.php',
                        data: data,
                        type: 'POST',
                        success: function(response) {
                            var res = JSON.parse(response);
                            // console.log(res);
                            swal(res.subject, res.msg, res.status);
                            $.ajax({
                                url: 'apr_account.php',
                                data: data,
                                type: 'POST',
                                success: function(response) {
                                   $('#main_content').html(response);

                                }
                            });

                        }
                    });
                }, 1000);
            });
        }
    };
}();