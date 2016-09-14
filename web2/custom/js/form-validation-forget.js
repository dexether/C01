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
            register_username: {
                emailAddress: {
                    message: 'Email Format must have  @ sign '
                }, notEmpty: {
                    message: 'Email tidak boleh kosong'
                }
            },
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