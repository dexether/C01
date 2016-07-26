var announcementJS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
				
		announcement: function(data) {

            $.ajax({
                url: 'ar_email_admin_do.php',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(res){
                    // console.log(res);
                    $('#ajax-button').button('reset');
                    if (res.status == 'error') {
                        $('#ajax-error').show();
                        $('.ajax-error-msg').append('<li>'+ res.title + '. ' + res.msg +'</li>')
                    }else{
                        $('#ajax-success').show();
                        $('.ajax-success-msg').append('<li>'+ res.title + '. ' + res.msg +'</li>')
                    }

                },
                beforeSend: function(){
                    $('#ajax-button').button('loading');

                },
                error: function(){
                    alert('Error Found, contact publisher')
                }
            });
        },
		
    };

}();