var car_shocom_JS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
		
		carimeta: function(commissiondate, todate) {
            var url = 'car_shocom.php?commissiondate=' + commissiondate + "&todate=" + todate;
            var data = '&ajax_validation=1';
			 // console.log(commissiondate, todate); 
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
					// console.log(response); 
					$("#confirm").html(response);
                }
            });
        },
		view: function(lihat) {
           var url = 'car_commodal.php?lihat=' + lihat;
            var data = '&ajax_validation=1';
			     // console.log(lihat);     
			 
            
			 $.ajax({
                 url: url,
                 data:data,
                type: 'POST',
                success: function(response) {
                        // console.log(response)
					    $('.modal-body').html(response);
				                
                }
             });
        },
		
		editya: function(edit, id) {
           var url = 'car_commodal_do.php?edit=' + edit + "&id=" + id;
            var data = '&ajax_validation=1';
			     // console.log(edit, id);     
			 
            
			 $.ajax({
                 url: url,
                 data:data,
                type: 'POST',
                success: function(response) {
                        console.log(response)
					// $('#myModal').modal('hide');
					var res = response.substring(0, 1);
                           // alert("20:" + res);
                    if (res == '0') {//success
                           // alert("22:Success");
                          var title = 'Edit the commission successfully';
                          var keterangan = '';
                          notifysuccess_common1('success', 'top right', title, keterangan);
                         // $('#myModal').modal('hide');
						 setTimeout('history.go(0);', 2000);
						 // $("#confirm").html(response);
						  
                    } else if (res == '1') {//Fai
                         alert("28:Fail");
                         var title = 'Can not input the commission';
                         var keterangan = 'Please fill in the commission field';
                         notifyerror1('error', 'top right', title, keterangan);
						$('#myModal').modal('hide');
						// setTimeout('history.go(0);', 4000);
                    }
				                
                }
             });
        },
    };

}();