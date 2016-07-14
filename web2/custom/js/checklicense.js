var CheckLicense = function() {
    //alert("2");
    var handleUpload = function() {
        var datanya = $('#MyUploadForm').serialize() + '&ajax_validation=1';
        $('#MyUploadForm').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                thetitle: {
                    required: true,
                }
            },
            messages: {// custom messages for radio buttons and checkboxes
                thetitle: {
                    remote: "Title can not be empty."
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit  
                alert("Still have problem on data input, please check the Red Box");
                console.log('error');
            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            submitHandler: function(form) {
                //$('#submit-btn').addClass('spinner');
                //alert("Upload_Investment.js-30");                
                return false;
            }
        });
        $('#MyUploadForm input').keypress(function(e) {
            if (e.which == 13) {
                //alert("Upload_Investment.js-37");
                if ($('#MyUploadForm').validate().form()) {
                    $('#MyUploadForm').submit();
                }
                return false;
            }
        });


        $('#submit-btn').click(function() {
            //e.preventDefault();
            //alert("Upload_Investment.js-47");
            if ($('#MyUploadForm').validate().form()) {
                $('#MyUploadForm').submit();
            }

            return false;
        });

    }
    return {
        //main function to initiate the module
        init: function() {
            handleUpload();
        }
    };

}();