var RequestMove_JS = function() {
    //alert("2");
    var handleRequest = function() {
        $('#request-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                cabinetid: {
                    "remote": {
                        url: 'check_cabinetid.php',
                        type: "post"
                    }
                },
				uplineid: {
                    "remote": {
                        url: 'check_uplineid.php',
                        type: "post"
                    }
                }
            },
            messages: { // custom messages for radio buttons and checkboxes
                afiliasi: {
                    remote: "This Cabinet ID is not registered in our system"
                },
				uplineid: {
                    remote: "This Upline ID is not registered in our system"
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit  
                //alert("Still have problem on data input, please back to First Page");
                //console.log('error');
            },
            highlight: function(element) { // hightlight error inputs
                //alert("Still have problem on data input, please back to First Page");
                $(element).closest('.form-group').addClass('has-error').removeClass('success'); // set error class to the control group
            },
			success: function(element) {
				$(element).closest('.form-group').addClass('success').removeClass('has-error'); // set error class to the control group
			}
        });
		$('#request-form').bootstrapValidator({
            message: 'This value is not valid',
            container: '#messages',
            fields: {
                cabinetid: {
                    validators: {
                        notEmpty: {
                            message: 'Cabinet ID harus diisi'
                        }
                    }
                },
				uplineid: {
                    validators: {
                        notEmpty: {
                            message: 'Upline ID harus diisi'
                        }
                    }
                }
			}
		});
    }
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            handleRequest();
        },dorequest: function(thisnya) {
			$(thisnya).button('loading');
            var url = 'request_move.php?postmode=doRequest';
            //alert("Line-164-URL:"+url);
            var data = $('#request-form').serialize() + '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                dataType: 'JSON',
                beforeSubmit: function() {

                },
                success: function(res) {
                    // console.log(response);
                    // var res = JSON.parse(response);
                    swal({
                        type: res.status,
                        title: res.subject,
                        text: res.msg,
                        timer: 4000,
                        showConfirmButton: false
                    });
                    $(thisnya).button('reset');
                    setTimeout('history.go(0);', 5000);
                },
                complete: function(){
                  $(thisnya).button('reset');
                },
                error: function(){
                  swal('Something went wrong');
                }
            });
        }
    };
}();
