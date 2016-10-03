var EmailAdminVar = function() {
    //alert("2");

    var handleEmailpass = function() {
        var datanya = $('#updateps-email').serialize() + '&ajax_validation=1';
        $('#updateps-email').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                email_subject: {
                    required: true,
                },
                email_message: {
                    required: true,
                },
            },
            messages: {// custom messages for radio buttons and checkboxes
                email_subject: {
                    remote: "Email must have subject"
                },
                email_message: {
                    remote: "Please fill in your enquiry"
                },
            },
            invalidHandler: function(event, validator) { //display error alert on form submit  
                //alert("Still have problem on data input, please check the Red Box");
                console.log('error');
            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            submitHandler: function(form) {
               
                return false;
            }
        });

        $('#updateps-email').bootstrapValidator({
            message: 'This value is not valid',
            container: '#messages',
            fields: {
                email_subject: {
                    validators: {
                        notEmpty: {
                            message: 'Subject can not be empty'
                        }
                    }
                },
                email_message: {
                    validators: {
                        notEmpty: {
                            message: 'Message  not be empty'
                        }
                    }
                },
            },
        });


        $('#updateps-email input').keypress(function(e) {
            //alert("69-enter");
            if (e.which == 13) {
                //alert("71");
                return false;
            }
        });


        $('#updateps-email-btn').click(function() {
            //e.preventDefault();
            //alert("74-mouseclick");
            checkdulu();
            return false;
        });

        function checkdulu() {
            //alert("101");
            var e2 = document.getElementById('idupdate_button');
            var e3 = document.getElementById('themessage2');
            var e4 = document.getElementById('thebutton');
            e3.innerHTML = "";

            var check_form1 = $('#updateps-email').validate().form();
            //alert("check_form1-110:" + check_form1);
            if (check_form1 == true) {
                //alert("CheckBootStrap-112");
                var bootstrapValidator = $("#updateps-email").data('bootstrapValidator');
                bootstrapValidator.validate();
                if (bootstrapValidator.isValid()) {
                    //alert("check_form1-116-Submit-Inside BootStrapValidator");
                    e4.style.display = 'none'
                    e2.innerHTML = "on Progres...";
                    //e2.disabled = true;
                    var url =  document.getElementById("updateps-email").action;
                    var url = $("#updateps-email").attr('action');
                    //alert("99-URL:" + url);
                    var data = $("#updateps-email").serialize() + '&ajax_validation=1';
                    //alert("101-Data:" + data);
                    $.ajax({
                        url: url,
                        data: data,
                        type: 'POST',
                        success: function(response) {
                            //alert("131-Response:" + response);
                            var res = response.substring(0, 1);
                            //alert("28:"+res);
                            if (res == '0') {//success
                                var title = "Email has been Submit";
                                var keterangan = '';
                                notifysuccess_common('success', 'top right', title, keterangan);
                                //e2.disabled = false;
                                e2.innerHTML = "Submit Done";
                            } else if (res == '1') {//Fail
                                //alert("34:Fail");
                                var title = "Email sent Fail";
                                var keterangan = '';
                                notifysuccess_common('error', 'top right', title, keterangan);
                                e2.innerHTML = "Submit Fail";
                                e2.disabled = true;
                            }
                            //$('#username').removeClass('spinner');
                            //toastr.success("Update Password", "Your has been successfully to");
                        }
                    });
                    return false;
                }//if (bootstrapValidator.isValid()) {
                else {
                    //alert("check_form1-123-Fail");
                    e2.innerHTML = "Submit";
                    e3.innerHTML = "<p class='help-block'><code>Still Have Error,<br>please check.</code></p>";
                    return;
                }
            }//if ($('#updateps-form').validate().form()) {
            if (e4.style.display != 'none') {
                var e2 = document.getElementById('idupdate_button');
                e2.innerHTML = "Submit";
                e3.innerHTML = "<p class='help-block'><code>Still Have Error<br> please check!</code></p>";
            }
            return false;
        }
    }

    return {
        //main function to initiate the module
        init: function() {
            handleEmailpass();
        }
    };

}();