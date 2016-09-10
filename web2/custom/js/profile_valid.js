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
            name: {
                message: 'The Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Name is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: /[a-zA-Z]+$/,
                        message: 'The Name can only consist of alphabetical'
                    }
                }
            },
            mothername: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Name is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: /[a-zA-Z]+$/,
                        message: 'The Name can only consist of alphabetical'
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
            address: {
                validators: {
                    notEmpty: {
                        message: 'The address is required and can\'t be empty'
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
            field: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    },
                    identical: {
                        field: 'confirmfield',
                        message: 'The field and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The field can\'t be the same as username'
                    }
                }
            },
            confirmfield: {
                validators: {
                    notEmpty: {
                        message: 'The confirm field is required and can\'t be empty'
                    },
                    identical: {
                        field: 'field',
                        message: 'The field and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The field can\'t be the same as username'
                    }
                }
            },
            phoneNumber: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    },
                    digits: {
                        message: 'The value can contain only digits'
                    }
                }
            },
            phoneNumberHome: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    },
                    digits: {
                        message: 'The value can contain only digits'
                    }
                }
            },
            phoneNumberFax: {
                validators: {
                    digits: {
                        message: 'The value can contain only digits'
                    }
                }
            },
            identity: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    },
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
            register_birthday: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
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
            var formData = new FormData($('#registerForm')[0]);
            // var b = $(form, form).serialize();
            // console.log(form, $(form));
            // var a = (form, $(form));
            // var b = a.serialize()
            // console.log(b);
            /*  var method = $('#registerForm').find('select[name="method"]').val();
            var account = $('#registerForm').find('select[name="account"]').val();
            var bankaccount = $('#registerForm').find('select[name="bankaccount"]').val();
            var amount = $('#registerForm').find('input[name="amount"]').val();
            var token = $('#registerForm').find('input[name="token"]').val();*/
            swal({
                title: "Are you sure?",
                text: "Do you want to Process </b> ?",
                type: "info",
                html: true,
                confirmButtonText: "Yes, Process now!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true,
            }, function(isConfirm) {
                if (isConfirm) {

                    setTimeout(function() {

                        $.ajax({
                            url: 'profile_do.php',
                            data: formData,
                            type: 'POST',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(response) {
                                var res = JSON.parse(response);
                                swal(res.subject, res.msg, res.status);
                                $.ajax({
                                    url: 'profile.php',
                                    data: {},
                                    type: 'POST',
                                    success: function(response) {

                                        $('#main_content').html(response);
                                    }
                                });
                            }
                        });
                        /* $('#registerForm').bootstrapValidator('resetForm', true);
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
                        });*/
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

    $('#bank-function').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            accountname: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    }
                }
            },
            accountnumber: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    },
                    digits: {
                        message: 'The value can contain only digits'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    }
                }
            },
            bankname: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    }
                }
            },
            branch: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and can\'t be empty'
                    }
                }
            },
        },
        success: function(element) {
            // console.log(element)
        },
        submitHandler: function(form) {
            var formData = new FormData($('#bank-function')[0]);
            // var b = $(form, form).serialize();
            // console.log(form, $(form));
            // var a = (form, $(form));
            // var b = a.serialize()
            // console.log(b);
            /*  var method = $('#registerForm').find('select[name="method"]').val();
            var account = $('#registerForm').find('select[name="account"]').val();
            var bankaccount = $('#registerForm').find('select[name="bankaccount"]').val();
            var amount = $('#registerForm').find('input[name="amount"]').val();
            var token = $('#registerForm').find('input[name="token"]').val();*/
            swal({
                title: "Are you sure?",
                text: "Do you want to Process </b> ?",
                type: "info",
                html: true,
                confirmButtonText: "Yes, Process now!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true,
            }, function(isConfirm) {
                if (isConfirm) {

                    setTimeout(function() {

                        $.ajax({
                            url: 'profile_do.php',
                            data: formData,
                            type: 'POST',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(response) {
                                console.log(response);
                                var res = JSON.parse(response);
                                swal(res.subject, res.msg, res.status);
                                $.ajax({
                                    url: 'profile.php',
                                    data: {},
                                    type: 'POST',
                                    success: function(response) {
                                        $('#main_content').html(response);
                                    }
                                });
                            }
                        });
                        /* $('#registerForm').bootstrapValidator('resetForm', true);
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
                        });*/
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