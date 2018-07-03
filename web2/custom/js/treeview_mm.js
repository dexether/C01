var treeview_mm_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        update_data: function(a) {
            var data = a.serializeArray();
             console.log(data);
            swal({
                title: "Are you sure?",
                text: "Do you want to process ?",
                type: "info",
                confirmButtonText: "Yes, process it!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                html: true,
                showLoaderOnConfirm: true,
            }, function() {
                setTimeout(function() {
                    $.ajax({
                        url: 'treview_detail_do.php',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                    }).done(function(res) {
                        // console.log(res)
                        swal(res.subject, res.msg, res.status);
                        // setTimeout('history.go(0)', 4000)
                    }).fail(function() {
                        swal('We found an error', 'Check your details', 'error');
                    }).always(function() {});
                    // swal("Success!", "The job have running well.", "success");
                    // Ajax Start
                }, 1000);
            });
        }
    };
}();
