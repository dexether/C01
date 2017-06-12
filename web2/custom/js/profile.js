var UpdateProfile = function() {
    //alert("2");

    var handleUserpass = function() {
        var datanya = $('#updateps-form').serialize() + '&ajax_validation=1';
        // console.log(datanya);
        $('#updateps-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                emailnew: {
                    required: true,
                    email: true,
                    "remote": {
                        url: 'check_changeemail.php',
                        type: "post",
                        data: datanya,
                    }
                },
                register_birthday: {
                    "remote": {
                        url: 'check-register_birthday.php',
                        type: "post"
                    }
                },
                nationality: {
                    "remote": {
                        url: 'check_nationality.php',
                        type: "post"
                    }
                },
            },
            messages: { // custom messages for radio buttons and checkboxes
                emailnew: {
                    remote: "Email already has in the system."
                },
                register_birthday: {
                    remote: "Sorry, your age minimum 17 years old"
                },
                nationality: {
                    remote: "Sorry, this Nationality is Prohibited"
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit
                alert("Still have problem on data input, please check the Red Box");
                // console.log('error');
            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            submitHandler: function(form) {
                // $('#username').addClass('spinner');
                // alert("Submit in Process");
                // var url = $(form).attr('action');

                swal({
                    title: "Are you sure?",
                    text: "Do you want to update your Photo profile </b> ?",
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
                            var data = $(form).serialize();

                            $.ajax({
                                url: 'profile_do.php',
                                data: data,
                                type: 'POST',
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
                        }, 1000);

                    } else {
                        // Reset user
                        $('#updateps-form').bootstrapValidator('resetForm', true);
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }

                });

                return false;
            }
        });
        $('#updateps-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#updateps-form').validate().form()) {
                    //alert("90");
                    $('#updateps-form').submit();
                }
                return false;
            }
        });

        $('#updateps-form-btn').click(function() {
            //e.preventDefault();
            //alert("Profile.js-96");
            if ($('#updateps-form').validate().form()) {
                $('#updateps-form').submit();
            }

            return false;
        });

    }

    return {
        //main function to initiate the module
        init: function() {
            handleUserpass();
        },
        checkdate: function(selectId) {
            var url = 'check-register_birthday.php?selectedid=' + selectId;
            //alert("Line-115-URL:"+url);
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    var res = response.substring(0, 1);
                    //alert("19:" + res);
                    if (res == '0') { //success
                        //alert("21:Success");
                        //notifysuccess('success', 'top right');
                    } else if (res == '1') { //Fail
                        //alert("24:Fail");
                        //notifyerror('error', 'top right');
                    }
                }
            });
        },
        upload_doc: function() {
            $('#ajax-btn').button('loading');
            var formData = new FormData($('#ajax-form')[0]);
            // var formData = new FormData($('#yourformID')[0]);
            formData.append('file_1', $('input[type="file"]')[0].files[0]);
            // console.log(formData);
            // alert("Clicked oy" + account + type + method + amount + date + time);
            var url = 'profile_upload.php';
            // var data = {account: account, type: type, method: method, amount: amount, date: date, time: time, agent: agent};

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    sweetAlert(response.title, response.msg, response.status);
                    // console.log(response)
                    $('#ajax-btn').button('reset');
                    setTimeout(function() {

                            $.ajax({
                                url: 'profile.php',
                                data: {},
                                type: 'GET',
                                success: function(response) {
                                    $('#main_content').html(response)
                                }
                            });
                        }, 3000);
                },
                error : function(error) {
                  sweetAlert('Error', 'Error While Update profile', 'error');
                }
            });

        }
    };

}();
