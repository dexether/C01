var ar_admin_document_JS = function() {
    //alert("2");
    var handle_1 = function() {}
    return {
        //main function to initiate the module
        init: function() {
            //handle_withdrawal();
        },
        document_pay: function() {},
        admin_confirm: function(id, token) {
            swal({
                title: "Are you sure",
                text: "Do you want to confirm this request ??",
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
                        url: 'ar_admin_withdrawal_do.php',
                        data: {
                            id: id,
                            token: token,
                            postmode: "approve"
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            swal(res.subject, res.msg, res.status);
                            $('#ajax-form').submit();
                        },
                        error: function() {
                            swal('Oops, We Found An error', 'Contact the administrator', 'error');
                        }
                    });
                }, 1000);
            });
        },
        admin_pending: function(id, token) {
            swal({
                title: "Are you sure",
                text: "Do you want to pending this request ?",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonColor: "#03AD42",
                confirmButtonText: "Yes, pending it!",
                cancelButtonText: "No,!",
            }, function() {
                setTimeout(function() {
                    // Ajax Here
                    $.ajax({
                        url: 'ar_admin_withdrawal_do.php',
                        data: {
                            id: id,
                            token: token,
                            postmode: "pending"
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            swal(res.subject, res.msg, res.status);
                        },
                        error: function() {
                            swal('Oops, We Found An error', 'Contact the administrator', 'error');
                        }
                    });
                }, 1000);
            });
        },
        admin_reject: function(id, token) {
            swal({
                title: "Are you sure",
                text: "Do you want to reject this request ?",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonColor: "#03AD42",
                confirmButtonText: "Yes, reject it!",
                cancelButtonText: "No,!",
            }, function() {
                setTimeout(function() {
                    // Ajax Here
                    $.ajax({
                        url: 'ar_admin_withdrawal_do.php',
                        data: {
                            id: id,
                            token: token,
                            postmode: "reject"
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            swal(res.subject, res.msg, res.status);
                        },
                        error: function() {
                            swal('Oops, We Found An error', 'Contact the administrator', 'error');
                        }
                    });
                }, 1000);
            });
        },
        get_data: function(a, b) {
            $(b).button('loading');
            $.ajax({
                url: 'ar_admin_withdrawal_get.php',
                data: a,
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    $('table[id=table-ajax] tbody').html('');
                },
                success: function(response) {
                    if (response.length > 0) {
                        for (var i = 0; i < response.length; i++) {
                            var status = response[i].status;
                            switch (status) {
                                case "0":
                                    var status_print = "<span class='label label-warning'>Request</span>";
                                    break;
                                case "1":
                                    var status_print = "<span class='label label-info'>Pending</span>";
                                    break;
                                case "2":
                                    var status_print = "<span class='label label-success'>Approved</span>";
                                    break;
                                case "3":
                                    var status_print = "<span class='label label-danger'>Rejected</span>";
                                    break;
                                default:
                            }
                            if (status == '0' || status == '1') {
                                var aksi = "<button class='btn btn-success' onclick='ar_admin_document_JS.admin_confirm("+response[i].id+", token.value);' type='button'>Approve</button>";
                                aksi+= "<button class='btn btn-blue-1' onclick='ar_admin_document_JS.admin_pending("+response[i].id+", token.value);' type='button'>Pending</button>";
                                aksi+= "<button class='btn btn-danger' onclick='ar_admin_document_JS.admin_reject("+response[i].id+", token.value);' type='button'>Reject</button>";
                            }else{
                                var aksi = "No Action Needed";
                            }
                            // console.log(aksi)
                            tr = $('<tr/>');
                            tr.append("<td>" + response[i].date_transaction + "</td>");
                            tr.append("<td>" + response[i].account_from + " - (USD " + response[i].balance + ")</td>");
                            tr.append("<td>" + response[i].aeaccountnumber + " - (" + response[i].aeaccountname + " - " + response[i].banktype + ")</td>");
                            tr.append("<td>" + response[i].amount + "</td>");
                            tr.append("<td>" + status_print + "</td>");
                            tr.append("<td>" + aksi + "</td>");
                            $('table[id=table-ajax] tbody').append(tr);
                            // console.log(tr);
                        }
                    }else{
                        $('table[id=table-ajax] tbody').html('<tr><td colspan=7 class=text-center>No request<td></tr>');
                    }
                },
                error: function() {
                    // swal('Oops, We Found An error', 'Contact the administrator', 'error');
                },
                complete: function() {
                    $(b).button('reset');
                }
            });
        }
    };
}();
