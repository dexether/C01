var car_hitcom_superJS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
				
		carimeta: function(commissiondate, commissionhour, todate, tohour) {
            var url = 'tabel_openadmin.php?commissiondate=' + commissiondate + "&commissionhour=" + commissionhour + "&todate=" + todate+ "&tohour=" + tohour;
            var data = '&ajax_validation=1';
			// console.log(commissiondate, commissionhour, todate, tohour); 
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
		view: function(lihat, commissiondate, commissionhour, todate, tohour) {
			      // console.log(lihat, commissiondate, commissionhour, todate, tohour);     
			var url = 'tabel_openadminbm.php?lihat=' + lihat + "&commissiondate=" + commissiondate + "&commissionhour=" + commissionhour + "&todate=" + todate+ "&tohour=" + tohour;
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
		viewdetail: function(lihat, commissiondate, commissionhour, todate, tohour) {
			      // console.log(lihat, commissiondate, commissionhour, todate, tohour);     
			var url = 'tabel_openadminview.php?lihat=' + lihat + "&commissiondate=" + commissiondate + "&commissionhour=" + commissionhour + "&todate=" + todate+ "&tohour=" + tohour;
            var data = '&ajax_validation=1';
			   $("#content3").html('<img class="img-responsive center-block" src="images/loading/Load.gif" width="100" height="100">'); 
			$.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                       // console.log(response)
				$("#content3").html(response);
				                
                }
            }); 
           
        },
    };

}();