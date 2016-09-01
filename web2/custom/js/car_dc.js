var car_DC = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
				
		carimeta: function(commissiondate, commissionhour, todate, tohour, example) {
			var datas = $('#formnya').serializeArray();
            var url = 'tabel_dc.php';           
			 // console.log(datas); 
			 $("#content1").html('<img class="img-responsive center-block" src="images/loading/Load.gif" width="100" height="100">');   
            $.ajax({
                url: url,
                data: datas,
                type: 'POST',
                success: function(response) {
					  // console.log(response); 
					$("#content1").html(response);
                }
            });
        },
		view: function(lihat) {
			     // console.log(lihat);     
			var url = 'tabel_dc_devid.php?lihat=' + lihat;
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