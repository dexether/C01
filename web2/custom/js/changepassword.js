var ChangePassword = function () {
    //alert("2");
    var handleUserpass = function () {

        $('#updateps-form').validate({
            rules: {
                password1: {
                    required: true,
                    minlength: 4
                },
                password2: {
                    equalTo: "#f_up_password"
                },
            },
            submitHandler: function (form) {
                $('#username').addClass('spinner');
                //alert("17");
                var url = $(form).attr('action');
                //alert("19:" + url);
                var data = $(form).serialize() + '&ajax_validation=1';
                //alert("20:" + data);
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function (response) {
                        var res = JSON.parse(response);
						swal({
							type: res.status,
							title: res.subject,
							text: res.msg,
							timer: 4000,
							showConfirmButton: false
						});
						setTimeout(function(){ location.reload(); }, 4000);
                    }
                });
                return false;
            }
        });
        $('#updateps-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#updateps-form').validate().form()) {
                    $('#updateps-form').submit();
                }
                return false;
            }
        });


        $('#updateps-form-btn').click(function () {
            //e.preventDefault();

            if ($('#updateps-form').validate().form()) {
                $('#updateps-form').submit();
            }

            return false;
        });

    }

    return {
        //main function to initiate the module
        init: function () {
            handleUserpass();
        }
    };

}();