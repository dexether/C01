var car_hitcom_JS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
		shownya: function(b) {
            var url = 'car_hitcom.php';
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
		
		carimeta: function(marem, accountmeta) {
            var url = 'tabel_meta.php?accabi=' + marem + "&accmeta=" + accountmeta;
            var data = '&ajax_validation=1';
			 // console.log(marem, accountmeta); 
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
		
		creataccno: function() {
			var datas = $('#formnya').serializeArray();
			var url = 'car_up_com.php';
			// console.log(datas);
			
			$.ajax({
                url: url,
                data: datas,
                type: 'POST',
                success: function(response) {
					// console.log(response); 
					// $("#content2").html(response);
					var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Success!!';
                          var keterangan = 'Input Login Meta';
                          notifysuccess_common('success', 'top right', title, keterangan);
                          setTimeout('history.go(0);', 3000);
						  // $("#content2").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Input Login Meta';
                         var keterangan = 'Login Meta already exists';
                         notifyerror1('error', 'top right', title, keterangan);
						 setTimeout('history.go(0);', 3000);
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