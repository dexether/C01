var LoginReset = function() {
    //alert("2");
    var handleResetPassword = function() {

        $('#registerForm').validate({
            submitHandler: function(form) {
                console.log(form);
                var url = $(form).attr('action');
                console.log(url);
                //alert("19:" + url);
                var data = $(form).serialize() + '&ajax_validation=1';
                console.log(data);
                //alert("20:" + data);
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function(response) {
                        console.log(response);
                        var res = response.substring(0, 1);
                        //alert("28:"+res);
                        if (res == '0') {//success
                            //alert("30:Success");
                            notifysuccess('success', 'top right');
                            var url = "index.php";
                            setTimeout(function() {
                                $(location).attr('href', url);
                            }, 5000);
                            
                        } else if (res == '1') {//Fail
                            //alert("34:Fail");
                            notifyerror('error', 'top right');
                        }else{
                            notifyerror('error', 'top right');
                        }
                    }
                });
                return false;
            }
        });



        $('#updateps-form-btn').click(function() {
            //e.preventDefault();

            if ($('#registerForm').validate().form()) {
                $('#registerForm').submit();
            }

            return false;
        });

    }

    return {
        //main function to initiate the module
        init: function() {
            handleResetPassword();
        }
    };

}();