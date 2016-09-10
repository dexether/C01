var Treview_JS = function() {
    //alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        accountdetail: function(accno) {
            var url = 'car_treview_detail.php?accno=' + accno;
            //alert("Line-16-URL:" + url);
            if (accno=='COMPANY') {
               
            }else{
            var data = '&ajax_validation=1';         
            //$('#md-3d-sign').modal('show');
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $("#main_content").html(response);
                }
            });
            }
            //setTimeout('history.go(0);', 0);
            },
			
		shownya: function(b) {
            var url = 'car_treview_detail.php';
            var data = {
                shownya: b
            };
			// console.log(b);
             $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
					 $("#main_content").html(response);
				}
			 });
        },
			
        temporary_statement: function(account, mt4dt) {
            
            var url = 'temporary_statement.php?account='  + account +  '&mt4dt=' + mt4dt;
            var data = '&ajax_validation=1';
            $("#temporary-statement").html('<img class="img-responsive center-block" src="images/loading/spin.gif" width="100" height="100">');         
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    // console.log(response);
                    $("#to-excel").fadeIn();
                    $("#temporary-statement").html(response);
                }
            });
        },

        daily_statement: function(account, datesearch, mt4dt) {
            
            var url = 'daily_statement.php?account=' + account + '&datesearch=' + datesearch + '&mt4dt=' + mt4dt;
            var data = '&ajax_validation=1';
            $("#daily-statement").html('<img class="img-responsive center-block" src="images/loading/spin.gif" width="100" height="100">');         
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    // console.log(response);
                    $("#to-excel2").fadeIn();
                    $("#daily-statement").html(response);
                }
            });
        }
    };

}();

