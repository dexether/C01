var car_hitcom_bm = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
				
		carimeta: function(downline, marem, accountmeta, commissiondate, commissionhour, todate, tohour) {
            var url = 'tabel_openae.php?downline=' + downline + "&accabi=" + marem + "&accmeta=" + accountmeta + "&commissiondate=" + commissiondate + "&commissionhour=" + commissionhour + "&todate=" + todate+ "&tohour=" + tohour;
            var data = '&ajax_validation=1';
			 // console.log(downline, marem, accountmeta, commissiondate, commissionhour, todate, tohour); 
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
        }
    };

}();