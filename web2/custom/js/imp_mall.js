var imp_mall_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        approved: function(id) {
            // $(this).closest('tr').remove();

            var token = $('input[name=token]').val();
            swal({
                title: "Are you sure",
                text: "Do you want to confirm this request ?",
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
                        url: 'imp_mall_do.php?postmode=agree',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            token: token,
                            'id': id
                        },
                    }).success(function(response) {
                        // console.log(response)
                        swal(response.title, response.msg, response.status);
                        $('input[name=token]').val(response.token);
                    }).done(function() {
                        
                    }).fail(function() {
                        swal('Oops, We Found An error', 'Contact the administrator', 'error');
                    }).always(function() {
                        
                    });
                }, 1000);
            });
        },
        reject: function(id) {
            // $(this).closest('tr').remove();

            var token = $('input[name=token]').val();
            swal({
                title: "Are you sure",
                text: "Do you want to confirm this request ?",
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
                        url: 'imp_mall_do.php?postmode=reject',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            token: token,
                            'id': id
                        },
                    }).success(function(response) {
                        // console.log(response)
                        swal(response.title, response.msg, response.status);
                        $('input[name=token]').val(response.token);
                    }).done(function() {
                        
                    }).fail(function() {
                        swal('Oops, We Found An error', 'Contact the administrator', 'error');
                    }).always(function() {
                        
                    });
                }, 1000);
            });
        }
    };
}();