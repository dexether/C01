var MLMKhusus_JS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
		shownya: function(b) {
            var url = 'car_mlmkhusus.php';
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
		
		carimeta: function(mail, mail2, metanya) {
            var url = 'car_mlmkhusus_do.php?accabi=' + mail + "&accmeta=" + mail2 + "&metanya=" + metanya;
            var data = '&ajax_validation=1';
			 // console.log(mail, mail2, metanya); 
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
                          var keterangan = 'Creat Account';
                          notifysuccess_common1('success', 'top right', title, keterangan);
                          // setTimeout('history.go(0);', 3000);
						   $("#content1").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Creat Account';
                         var keterangan = 'Email already exists';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     } else if (res == '2') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Creat Account';
                         var keterangan = 'Upline already exists';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '3') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Creat Account';
                         var keterangan = 'Branch already exists';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
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