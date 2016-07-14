var ar_admin_document_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        document_confirm: function(aecode, token) {
            // console.log(aecode);
            var data = {
                aecode: aecode,
                token: token
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
                        url: 'ar_admin_document_do.php?postmode=document',
                        data: data,
                        type: 'POST',
                        success: function(response) {
                            // console.log(response);
                            var res = JSON.parse(response);
                            swal(res.subject, res.msg, res.status);
                            $.ajax({
                                url: 'ar_admin_document.php',
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
        document_approve: function(id, token) {
            var data = {
                id: id,
                token: token
            };
            swal({
                title: "Are you sure?",
                text: "Do you want to Approve ?",
                type: "info",
                confirmButtonText: "Yes, process it!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function() {
                setTimeout(function() {
                    $.ajax({
                        url: 'ar_admin_document_do.php?postmode=general',
                        data: data,
                        type: 'POST',
                        success: function(response) {
                            // console.log(response);
                            var res = JSON.parse(response);
                            swal(res.subject, res.msg, res.status);
                            setTimeout('history.go(0)', 3000);
                        }
                    });
                }, 1000);
            });
        },
        document_delete: function(id, token) {
            var data = {
                id: id,
                token: token
            };
            swal({
                title: "Are you sure?",
                text: "Do you want to reject, if you reject this request, the file will be removed ?",
                type: "info",
                confirmButtonText: "Yes, process it!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function() {
                setTimeout(function() {
                    $.ajax({
                        url: 'ar_admin_document_do.php?postmode=delete',
                        data: data,
                        type: 'POST',
                        success: function(response) {
                            console.log(response);
                            var res = JSON.parse(response);
                            swal(res.subject, res.msg, res.status);
                            setTimeout('history.go(0)', 3000);
                        }
                    });
                }, 1000);
            });
        }
    };
}();