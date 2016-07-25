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
                success: function(res){
                    // console.log(res);
                    $('#ajax-button').button('reset');

                },
                beforeSend: function(){
                    $('#ajax-button').button('loading');

                },
                error: function(){

                }
            });
        },
		
    };

}();