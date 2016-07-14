$(document).ready(function() {
    // Generate a simple captcha

    //EXAMPLE REGISTER FORM
    $('#registerForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            password: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 12,
                        message: 'Password need at least 4 Character. Combination Character with Number, and Max is 12 digit'
                    },
                    notEmpty: {
                        message: 'Password can not be blank'
                    },
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'Confirm Password need to be the same with Password, at least 4 Character. Combination Character with Number, and Max is 12 digit'
                    },
                    identical: {
                        field: 'password',
                        message: 'Confirm Password is not equal with Password'
                    }
                }
            }
        }
    });



});