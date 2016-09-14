var delete_js = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
		show: function(show1) {
            var url = 'car_delete_meta.php?showemail=' + show1;
            var data = '&ajax_validation=1';
			 // console.log(show1); 
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
		
		shownya: function(show2) {
            var url = 'car_delete_acc.php?showemail=' + show2;
            var data = '&ajax_validation=1';
			 // console.log(show2); 
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
		
		acc: function(nama, mail, account) {
            var url = 'car_delete_accdo.php?namanya=' + nama + "&email=" + mail + "&acc=" + account;
            var data = '&ajax_validation=1';
			 // console.log(nama, mail, account); 
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
					// console.log(response);
					var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Success!!';
                          var keterangan = 'Delete Account Cabinet';
                          notifysuccess_common1('success', 'top right', title, keterangan);
                          // setTimeout('history.go(0);', 3000);
						  $("#content1").html(response);
                          
                    }
                }
            });
        },
		
		meta: function() {
           var datas = $('#formnya').serializeArray();
			var url = 'car_delete_metado.php';
			// console.log(datas);
			
			$.ajax({
                url: url,
                data: datas,
                type: 'POST',
                success: function(response) {
					
					var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Success!!';
                          var keterangan = 'Delete Login Meta';
                          notifysuccess_common1('success', 'top right', title, keterangan);
                          // setTimeout('history.go(0);', 3000);
						  $("#content1").html(response);
                          
                    }
                }
            });
        },
		
		hal1 : function() {
             var url = 'car_hitcom.php';
             var data = '&ajax_validation=1';

             $.ajax({
                 url: url,
                 data: data,
                 type: 'POST',
                 success: function(response) {
                 $("#main_content").html(response);
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
						 $("#main_content").html(response);
                 }
             });
            
         },
    };

}();