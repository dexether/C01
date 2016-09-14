var AR_admin_cronjob_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        admin_run: function(filenya) {
            console.log(filenya);
            var url = filenya;
            var data = {
                postmode: "doit"
            };
            swal({
                title: "Are you sure?",
                text: "Do you want to run this job now?",
                type: "info",
                confirmButtonText: "Yes, run it!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function() {
                setTimeout(function() {
                    // Ajax Start
                    $.ajax({
                        url: url,
                        data: data,
                        type: 'POST',
                        success: function() {
                            swal("Success!", "The job have running well.", "success");
                            $.ajax({
                                url: 'ar_admin_cron.php',
                                data: {},
                                type: 'POST',
                                success: function(response) {
                                    
                                    $("#main_content").html(response);
                                }
                            });
                        }
                    });
                }, 1000);
            });
        }
    };
}();