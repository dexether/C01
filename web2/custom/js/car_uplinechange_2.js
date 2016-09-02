var Uplinechange_2 = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
		shownya: function(show1, show2) {
            var url = 'car_uplinechange_2.php?showemail=' + show1 + "&shownya=" + show2;
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
		
		metashow: function(show) {
            var url = 'car_uplinechange_2metadua.php?metanyashow=' + show;
            var data = '&ajax_validation=1';
			// console.log(show); 
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
					// console.log(response); 
					$("#content2").html(response);
                }
            });
        },
		
		view: function(metaaction) {
            var url = 'car_uplinechange_2metatiga.php?metaac=' + metaaction;
            var data = '&ajax_validation=1';
			// console.log(metaaction); 
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
					// console.log(response); 
					$("#content3").html(response);
                }
            });
        },
		
		addmeta: function(addmeta) {
            var url = 'car_uplinechange_2metatigaadd.php?metaac=' + addmeta;
            var data = '&ajax_validation=1';
			// console.log(addmeta); 
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
					// console.log(response); 
					$("#content3").html(response);
                }
            });
        },
		
		carimeta: function(mail1, mail2, metanya) {
			// console.log(mail1, mail2, metanya); 
			var url = 'car_uplinechange_2do.php?accabi=' + mail1 + "&accmeta=" + mail2 + "&metanya=" + metanya;
            var data = '&ajax_validation=1';
			 
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
                          var keterangan = 'Upline has been Changed';
                          notifysuccess_common1('success', 'top right', title, keterangan);
                          // setTimeout('history.go(0);', 3000);
						  // $("#content2").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Upline has been Changed';
                         var keterangan = 'Account already exists';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     } else if (res == '2') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Upline has been Changed';
                         var keterangan = 'Account already exists';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '3') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Upline has been Changed';
                         var keterangan = 'Account to Change amount is too large';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }
                }
            });
			
			var url = 'car_uplinechange_2meta.php?acc=' + mail1 + "&accold=" + mail2 + "&accnew=" + metanya;
            var data = '&ajax_validation=1';
			 // console.log(show1, show2); 
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
		
		changemeta: function(aksi, acc, mailold, mailnew) {
			// console.log(aksi, acc, mailold, mailnew); 
			var url = 'car_uplinechange_2metatigado.php?deal=' + aksi + "&acc=" + acc + "&accold=" + mailold + "&accnew=" + mailnew;
            var data = '&ajax_validation=1';
			 
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
                          var keterangan = '';
                          notifysuccess_common1('success', 'top right', title, keterangan);
                          // setTimeout('history.go(0);', 3000);
						 $("#content3").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Meta Login has been Changed';
                         var keterangan = 'Input Text can not be empty';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
						 $("#content3").html(response);
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