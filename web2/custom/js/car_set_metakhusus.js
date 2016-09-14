var MetaKhusus_JS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
		shownya: function(show1, show2) {
            var url = 'car_set_metakhusus.php?showemail=' + show1 + "&shownya=" + show2;
            var data = '&ajax_validation=1';
			 // console.log(show1, show2); 
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
					// console.log(response); 
					$("#main_content").html(response);
                }
            });
        },
		
		carimeta: function(mail1, mail2, metanya) {
            var url = 'metakhusus.php?accabi=' + mail1 + "&accmeta=" + mail2 + "&metanya=" + metanya;
            var data = '&ajax_validation=1';
			 // console.log(mail1, mail2, metanya); 
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
		
		creataccno: function(namanya2, email, groupbranch, branch, metanya, comisi, comisi2, boundary, boundary2) {
			var url = 'metakhusus_do.php?accabi=' + namanya2 + "&accmeta=" + email + "&groupbranch=" + groupbranch + "&branch=" + branch + "&metanya=" + metanya + "&com1=" + comisi + "&com2=" + comisi2 + "&over=" + boundary + "&over2=" + boundary2;
            var data = '&ajax_validation=1';
			 // console.log(namanya2, email, groupbranch, branch, metanya, comisi, comisi2, boundary, boundary2);
			
			$.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
				// $("#content1").html(response);
				// console.log(response); 
					// $("#content2").html(response);
					var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Success!!';
                          var keterangan = 'Split Commission';
                          notifysuccess_common('success', 'top right', title, keterangan);
                          setTimeout('history.go(0);', 3000);
						  // $("#content2").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Split Commission';
                         var keterangan = 'Commission1 already exists';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     } else if (res == '2') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Split Commission';
                         var keterangan = 'Commission2 already exists';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '3') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Split Commission';
                         var keterangan = 'Commission amount is too large';
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