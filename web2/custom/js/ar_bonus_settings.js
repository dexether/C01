var ar_bonus_settings_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        updatesetting: function() {
            var data = $('#bonus').serializeArray();
            // console.log(data);
            // alert("Clicked");
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
                    $.ajax({
                        url: 'ar_bonus_settings_do.php',
                        data: data,
                        type: 'POST',
                        success: function(response) {
                            var res = JSON.parse(response);
                            swal(res.subject, res.msg, res.status);
                            $.ajax({
                                url: 'ar_bonus_settings.php',
                                data: {},
                                type: 'POST',
                                success: function(response){
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