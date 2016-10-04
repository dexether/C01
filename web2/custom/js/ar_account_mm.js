var ar_account_mm_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
		create_cabinetid: function(a) {
            var data = a.serializeArray();
            $.ajax({
                url: 'imp_create_cabinetid_do.php',
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    var res = response;
                    swal(res.subject, res.msg, res.status);
                    // console.log(res);
                },
                error: function(response) {
                    swal('Oops, something was happend', 'Contact Administrator', 'error');
                }
            });
        },
        change_upline: function(a) {
            var data = a.serializeArray();
            $.ajax({
                url: 'imp_upline_change_do.php',
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    // console.log(response)
                    var res = response;
                    swal(res.subject, res.msg, res.status);
                    // console.log(res);
                },
                error: function(response) {
                    swal('Oops, something was happend', 'Contact Administrator', 'error');
                }
            });
        },
        check_suspend: function(state, account) {
            // console.log(state);
            var url = 'ar_account_mm_do.php?postmode=yes';
            var data = {
                state: state,
                account: account
            };
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    // console.log(response)
                    // var res = JSON.parse(response);
                    // if (res.status == 'error') {
                    //     alert("Opps, Something wrong, call Application Publisher");
                    // } else {}
                }
            });
        },
        check_suspend2: function(state, account) {
            // console.log(state);
            var url = 'imp_account_mm_do.php?postmode=yes';
            var data = {
                state: state,
                account: account
            };
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    // console.log(response)
                    // var res = JSON.parse(response);
                    // if (res.status == 'error') {
                    //     alert("Opps, Something wrong, call Application Publisher");
                    // } else {}
                }
            });
        },
        reject: function(thisnya) {
            // console.log(state);
            swal({
                title: "Are you sure?",
                text: "Do you want to Reject?",
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
                        url: 'imp_account_mm_do.php?postmode=reject',
                        data: {
                            account: thisnya
                        },
                        type: 'POST',
                        success: function(response) {
                            // console.log(response)
                            /* $('#main_content').html(response);

                            swal("Success!", "The job have running well.", "success");*/
                            var res = JSON.parse(response);
                            swal(res.subject, res.msg, res.status);
                            $.ajax({
                                url: 'imp_account_mm.php',
                                type: 'GET',
                                data: {},
                            }).done(function(response) {
                                $('#main_content').html(response);
                            }).fail(function() {}).always(function() {});
                        }
                    });
                }, 1000);
            });
        },
        refresh_data: function() {
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
                        url: 'ar_account_mm.php',
                        data: {},
                        type: 'POST',
                        success: function(response) {
                            $('#main_content').html(response);
                            swal("Success!", "The job have running well.", "success");
                        }
                    });
                }, 1000);
            });
        },
        refresh_data2: function() {
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
                        url: 'imp_account_mm.php',
                        data: {},
                        type: 'POST',
                        success: function(response) {
                            $('#main_content').html(response);
                            swal("Success!", "The job have running well.", "success");
                        }
                    });
                }, 1000);
            });
        },
        connect_do: function(a) {
            var data = a.serializeArray();
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
                        url: 'imp_connect_do.php?postmode=new',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                    }).done(function(res) {
                        swal(res.subject, res.msg, res.status);
                        setTimeout('history.go(0)', 4000)
                    }).fail(function() {
                        swal('We found an error', 'Check your details', 'error');
                    }).always(function() {});
                    // swal("Success!", "The job have running well.", "success");
                    // Ajax Start
                }, 1000);
            });
        },
        delete_do: function(a, b) {
            var data = {
                id: a,
                token: b
            };
            // console.log(data)
            swal({
                title: "Are you sure?",
                text: "Do you want to Delete this ?",
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
                        url: 'imp_connect_do.php?postmode=delete_do',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                    }).done(function(res) {
                        swal(res.subject, res.msg, res.status);
                        setTimeout('history.go(0)', 4000)
                    }).fail(function() {
                        swal('We found an error', 'Check your details', 'error');
                    }).always(function() {});
                    // swal("Success!", "The job have running well.", "success");
                    // Ajax Start
                }, 1000);
            });
        },
        create_agent: function(a) {
            var data = a.serializeArray();
            // console.log(data);
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
                        url: 'imp_agent_do.php?type=askap',
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
        },
        create_agent_two: function(a) {
            var data = a.serializeArray();
            // console.log(data);
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
                        url: 'imp_agent_do.php?type=twofrx',
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
        },
        create_agent_aw: function(a) {
            var data = a.serializeArray();
            // console.log(data);
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
                        url: 'imp_agent_do.php?type=asiawide',
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
