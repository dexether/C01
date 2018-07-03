var comm_setting_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
		approve: function(a) {
            var data = a.serializeArray();
            $.ajax({
                url: 'comm_setting_do.php?postmode=approve',
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    var res = response;
					swal({ title: res.subject, text: res.msg, type: res.status }, function(){ location.reload(); });
                    // console.log(res);
                },
                error: function(response) {
                    swal('Oops, something was happend', 'Contact Administrator', 'error');
                }
            });
        },
		reject: function(a) {
            var data = a.serializeArray();
            $.ajax({
                url: 'comm_setting_do.php?postmode=reject',
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
        }
    };
}();
