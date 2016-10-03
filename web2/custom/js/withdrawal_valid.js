$(document).ready(function() {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    $('#captchaOperation').html([randomNumber(1, 20), '+', randomNumber(1, 30), '='].join(' '));


    //EXAMPLE REGISTER FORM
    $('#registerForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    },
                    different: {
                        field: 'password',
                        message: 'The username and password can\'t be the same as each other'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            amount: {
                validators: {
                    notEmpty: {
                        message: 'The amount is required and can\'t be empty'
                    },
                    digits: {
                        message: 'The value can contain only digits'
                    }
                }
            },
            account: {
                validators: {
                    notEmpty: {
                        message: 'The account is required and can\'t be empty'
                    }
                }
            },
            method: {
                validators: {
                    notEmpty: {
                        message: 'The method is required and can\'t be empty'
                    }
                }
            },
            from: {
                validators: {
                    notEmpty: {
                        message: 'Account is required and can\'t be empty'
                    }
                }
            },
            to: {
                validators: {
                    notEmpty: {
                        message: 'Account is required and can\'t be empty'
                    }
                }
            },
            bankaccount: {
                validators: {
                    notEmpty: {
                        message: 'bankaccount is required and can\'t be empty'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password can\'t be the same as username'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password can\'t be the same as username'
                    }
                }
            },
            phoneNumber: {
                validators: {
                    digits: {
                        message: 'The value can contain only digits'
                    }
                }
            },
            acceptTerms: {
                validators: {
                    notEmpty: {
                        message: 'You have to accept the terms and policies'
                    }
                }
            },
            captcha: {
                validators: {
                    callback: {
                        message: 'Wrong answer',
                        callback: function(value, validator) {
                            var items = $('#captchaOperation').html().split(' '),
                                sum = parseInt(items[0]) + parseInt(items[2]);
                            return value == sum;
                        }
                    }
                }
            }
        },
        success: function(element) {
            // console.log(element)
        },
        submitHandler: function(form) {
            var method = $('#registerForm').find('select[name="method"]').val();
            var account = $('#registerForm').find('select[name="account"]').val();
            var bankaccount = $('#registerForm').find('select[name="bankaccount"]').val();
            var amount = $('#registerForm').find('input[name="amount"]').val();
            var token = $('#registerForm').find('input[name="token"]').val();

            swal({
                title: "Are you sure?",
                text: "Do you want to request a withdrawal of $ <b>" + amount + "</b> ?",
                type: "info",
                html: true,
                confirmButtonText: "Yes, transfer now!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true,
            }, function(isConfirm) {
                if (isConfirm) {

                    setTimeout(function() {
                        $('#registerForm').bootstrapValidator('resetForm', true);
                        // swal("Success!", "The job have running well.", "success");
                        // Ajax Start
                        $.ajax({
                            url: 'withdrawal_do.php',
                            data: {
                                method: method,
                                account: account,
                                amount: amount,
                                bankaccount: bankaccount,
                                token: token
                            },
                            type: 'POST',
                            success: function(response) {
                                var res = JSON.parse(response);
                                // console.log(response);
                                swal(res.subject, res.msg, res.status);
                                $.ajax({
                                    url: 'withdrawal.php',
                                    data: {},
                                    type: 'POST',
                                    success: function(response) {
                                        $('#main_content').html(response);
                                    }
                                });
                            }
                        });
                    }, 1000);

                } else {
                    // Reset user
                    $('#registerForm').bootstrapValidator('resetForm', true);
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }

            });
            return false; // ajax used, block the normal submit
        }
    });
});