var OpenAccount_JS = function() {
    //alert("2");

    var handleRegister = function() {
        function randomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }

        $('#captchaOperation').html([randomNumber(1, 20), '+', randomNumber(1, 30), '='].join(' '));

        $.validator.addMethod('interests', function(value) {
            return $('.interests:checked').size() > 0;
        }, '');

        var checkboxes = $('.interests');
        var checkbox_names = $.map(checkboxes, function(e, i) {
            return $(e).attr("name")
        }).join(" ");

        $('#updateps-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                acceptTerms: {
                    checks: checkbox_names
                },
                errorPlacement: function(error, element) {
                    if (element.attr("type") == "checkbox")
                    {
                        error.insertAfter(checkboxes.last());
                    }
                    else
                    {
                        error.insertAfter(element);
                    }
                },
                email: {
                    "remote":
                            {
                                url: 'check_open_account.php',
                                type: "post"
                            }
                },
                register_birthday: {
                    "remote":
                            {
                                url: 'check-register_birthday.php',
                                type: "post"
                            }
                },
                nationality: {
                    "remote":
                            {
                                url: 'check_nationality.php',
                                type: "post"
                            }
                },
            },
            messages: {// custom messages for radio buttons and checkboxes
                email: {
                    remote: "This email has been used. If you forget the password, please click this <a href='forgetpassword.php?cabang=1'>Forget Password</a>"
                },
                register_birthday: {
                    remote: "Format Tanggal Lahir belum benar "
                },
                nationality: {
                    remote: "Sorry, this Nationality is Prohibited"
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit  
                //alert("Still have problem on data input, please back to First Page");
                console.log('error');
            },
            highlight: function(element) { // hightlight error inputs

                console.log(element);
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
        });

        $('#updateps-form').bootstrapValidator({
            message: 'This value is not valid',
            container: '#messages',
            fields: {
                email: {
                    validators: {
                        emailAddress: {
                            message: 'Email is not correct'
                        }, notEmpty: {
                            message: 'Email can not be empty'
                        }
                    }
                },
                register_name: {
                    message: 'First Name is not correct',
                    validators: {
                        notEmpty: {
                            message: 'Please fill in the First name, because it can not be empty'
                        },
                        stringLength: {
                            min: 3,
                            max: 255,
                            message: 'First name need at least 3 character and max 255 characters'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'Full name only can be filled using character'
                        },
                        different: {
                            field: 'password',
                            message: 'Full Name and Password can not be the same'
                        }
                    }
                }, password: {
                    validators: {
                        stringLength: {
                            min: 4,
                            max: 12,
                            message: 'Password need at least 4 Character. Combination Character with Number, and Max is 12 digit'
                        },
                        notEmpty: {
                            message: 'Password can not be blank'
                        }
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
                }, captcha: {
                    validators: {
                        callback: {
                            message: 'The answer is not correct',
                            callback: function(value, validator) {
                                var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                                return value == sum;
                            }
                        }
                    }
                },
            },
        });

        $('#updateps-form input').keypress(function(e) {
            //alert("69-enter");
            if (e.which == 13) {
                //alert("71");
                return false;
            }
        });


        $('#updateps-form-btn').click(function() {
            //e.preventDefault();
            //alert("120-mouseclick");
            checkdulu();
            return false;
        });

        function checkdulu() {
            //alert("85");
            var e2 = document.getElementById('idupdate_button');
            var e3 = document.getElementById('themessage2');
            var e4 = document.getElementById('thebutton');
            var e5 = document.getElementById('description1');
            var e51 = e5.options[e5.selectedIndex].value;
            //alert("checkdulu-195:" + e51);
            var e6 = document.getElementById('description2').value;
            var e7 = document.getElementById('themessage3');
            //alert("checkdulu-197:" + e6);
            if (e51 == 'Agent') {
                if (e6 == '') {
                    //alert("Agent Code can not be empty");
                    e2.innerHTML = "Submit";
                    e7.innerHTML = "";
                    e7.innerHTML = "<p class='help-block'><code>Agent Code can not be empty</code></p>";
                    return;
                }
            }

            e3.innerHTML = "";

            var check_form1 = $('#updateps-form').validate().form();
            //alert("check_form1-114:" + check_form1);
            if (check_form1 == true) {
                //alert("CheckBootStrap-116");
                var bootstrapValidator = $("#updateps-form").data('bootstrapValidator');
                bootstrapValidator.validate();
                if (bootstrapValidator.isValid()) {
                    //alert("check_form1-181-Submit-Inside BootStrapValidator");
                    thebutton.style.display = 'none'
                    e2.innerHTML = "on Progres...";
                    e2.disabled = true;
                    document.getElementById('updateps-form').submit();
                }//if (bootstrapValidator.isValid()) {
                else {
                    //alert("check_form1-163-Fail");
                    e2.innerHTML = "Submit";
                    e3.innerHTML = "<p class='help-block'><code>Still Have Error, please check.</code></p>";
                    return;
                }
            }//if ($('#updateps-form').validate().form()) {
            if (e4.style.display != 'none') {
                var e2 = document.getElementById('idupdate_button');
                e2.innerHTML = "Submit";
                e3.innerHTML = "<p class='help-block'><code>Still Have Error, please check!</code></p>";
            }
            return false;
        }

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            handleRegister();
        },
    };

}();