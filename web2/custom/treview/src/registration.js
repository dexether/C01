var Registration_JS = function() {
    //alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        
        hal1 : function() {
            var url = 'edu_registration2.php';
            
            var data = '&ajax_validation=1';

            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $("#main_content").html(response);
                }
            });
            //setTimeout('history.go(0);', 0);
        },
		
		hal2 : function() {
            var url = 'education.php';
            
            var data = '&ajax_validation=1';

            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $("#main_content").html(response);
                }
            });
            //setTimeout('history.go(0);', 0);
        },
        

    };

}();


