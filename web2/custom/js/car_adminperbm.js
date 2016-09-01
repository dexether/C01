var car_adminperBM = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
				
		carimeta: function(email, commissiondate, commissionhour, todate, tohour) {
            var url = 'tabel_adminperbm.php?mailbm=' + email + "&commissiondate=" + commissiondate + "&commissionhour=" + commissionhour + "&todate=" + todate+ "&tohour=" + tohour;
            var data = '&ajax_validation=1';
			 // console.log(email, commissiondate, commissionhour, todate, tohour); 
			 $("#content1").html('<img class="img-responsive center-block" src="images/loading/Load.gif" width="100" height="100">');   
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
					  // console.log(response); 
					$("#content1").html(response);
                }
            });
        },
		
		view: function(lihat, commissiondate, commissionhour, todate, tohour, method) {
			     // console.log(lihat, commissiondate, commissionhour, todate, tohour, method);     
			var url = 'tabel_adminperbmsee.php?lihat=' + lihat + "&commissiondate=" + commissiondate + "&commissionhour=" + commissionhour + "&todate=" + todate + "&tohour=" + tohour + "&code=" + method;
            var data = '&ajax_validation=1';
			   $("#content2").html('<img class="img-responsive center-block" src="images/loading/Load.gif" width="100" height="100">'); 
			$.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                       // console.log(response)
				$("#content2").html(response);
				                
                }
            }); 
           
        },
    };

}();