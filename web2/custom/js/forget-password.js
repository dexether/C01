var CheckForgetForm = function() {
    //alert("2");
    var handleCreateDemo = function() {

        $('#registerForm').validate({
            submitHandler: function(form) {
                var url = $(form).attr('action');
                //alert("8:" + url);
                var data = $(form).serialize() + '&ajax_validation=1';
                //alert("10:" + data);
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function(response) {
                        console.log(response);
                        //alert("16:"+response);
                        var res = response.substring(0, 1);
                        //alert("18:"+res);
                        if (res == '0') {//success
                            //alert("19:Success");
                            notifysuccess('success', 'top right');
                            setTimeout(function() {
                                window.location = "index.php"
                            }, 3000);
                        } else if (res == '1') {//Fail
                            //alert("22:Fail");
                            notifyerror('error', 'top right');
                            //setTimeout('history.go(0);', 3000);
                        }
                    }
                });
                return false;
            }
        });


        $('#registerForm-btn').click(function() {
            //e.preventDefault();
            //alert("42");
            if ($('#registerForm').validate().form()) {
                $('#registerForm').submit();
            }

            return false;
        });

    }

    return {
        //main function to initiate the module
        init: function() {
            handleCreateDemo();
        }
    };

}();

$(document).ready(function() {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
    ;
    $('#captchaOperation').html([randomNumber(1, 20), '+', randomNumber(1, 30), '='].join(' '));


    //EXAMPLE REGISTER FORM
    $('#registerForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            captcha: {
                validators: {
                    callback: {
                        message: 'The Answer is not correct yet',
                        callback: function(value, validator) {
                            var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                            return value == sum;
                        }
                    }
                }
            }
        }
    });



});