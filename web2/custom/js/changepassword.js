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
                        // console.log(response);
						//alert("27:"+response);
                        var res = response.substring(0, 1);
                        //alert("29:"+res);
                        if (res == '0') {//success
                            //alert("30:Success");
                            notifyerror('success', 'top right','Success','Update Password Success');
							setTimeout('history.go(0);', 4000);
                        } else  {//Fail
                            //alert("34:Fail");
                            notifyerror('error', 'top right','Error','Old Password is not Match');
                        }
                        //$('#username').removeClass('spinner');
                        //toastr.success("Update Password", "Your has been successfully to");
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