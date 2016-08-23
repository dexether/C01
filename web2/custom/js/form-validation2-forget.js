var Login = function() {
    var handleRegister = function() {
         $('.register_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                register_username: {
                    "remote":
                            {
                                url: 'check-forget-remote.php',
                                type: "post"
                            }
                }
            },
            messages: {// custom messages for radio buttons and checkboxes
                register_username: {
                    remote: "Email tidak ditemukan dalam User ID ini"
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   
                //console.log('error');
            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
        });

  
    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Login.js-150");
            handleRegister();
        }

    };

}();