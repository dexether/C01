var trade_investigation = function() {
    //alert("2");

    var handle_1 = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        mlm: function(name, email, accno, bmnya, subject, types, detail) {
            
           
            var url = 'car_investigation_mlm_do.php?name=' + name + '&email=' + email +'&accno=' + accno + '&bmnya=' + bmnya + '&subject=' + subject + '&types=' + types + '&detail=' + detail + '&module=mlm';
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                   var res = response.substring(0, 1);
                    if (res == 0) {
                         $('#myModal').modal('show');
                       
                    }else{
                       notifyerror('error', 'top right','Error','Error on Sending');
                    }
                    // console.log(response)
                }
            });
           
        },
		
		hal2 : function() {
            var url = 'dashboard1.php';
            var data = '&ajax_validation=1';

            $.ajax({
				 url: url,
                 data: data,
                 type: 'POST',
                 success: function(response) {
						 setTimeout('history.go(0);', 2000);
                 }
             });
            
         },
    };

}();