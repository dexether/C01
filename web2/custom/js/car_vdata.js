var Vdata_JS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
				
		view: function(lihat) {
			// console.log(lihat);     
			var url = 'car_vdata_edit.php?lihat=' + lihat;
            var data = '&ajax_validation=1';
			   $("#content1").html('<img class="img-responsive center-block" src="images/loading/Load.gif" width="100" height="100">'); 
			$.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                       // console.log(response)
				$("#content1").html(response);
				                
                }
            }); 
           
        },
		edit: function() {
			var datas = $('#formnya').serializeArray();
			var url = 'car_vdata_editdo.php';
			// console.log(datas);
			
			$.ajax({
                url: url,
                data:datas,
                type: 'POST',
                success: function(response) {
                       // console.log(response)
				// $("#content1").html(response);
				var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Edit Success!!';
                          var keterangan = '';
                          notifysuccess_common('success', 'top right', title, keterangan);
                          setTimeout('history.go(0);', 2000);
						  // $("#main_content").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Edit';
                         var keterangan = 'Please fill in the first Name  field';
                         notifyerror1('error', 'top right', title, keterangan);
                     }
                    else if (res == '2') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = "Can not Edit";
                        var keterangan = 'And Please fill in the first Telp Home field';
                        notifyerror1('error', 'top right', title, keterangan);
                        
                    }
					            
                }
            }); 
           
        },
    };

}();