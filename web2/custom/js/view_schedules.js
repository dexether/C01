var VIEW_schedules = function() {
    // alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        calendar: function(prodate) {
           var url = 'view_schedules_do.php?prodate=' + prodate;
            var data = '&ajax_validation=1';
			 // console.log(prodate);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                     // console.log(response)
                $("#main_content").html(response);
				   
                }
            });
        },
						   
    };
}();

