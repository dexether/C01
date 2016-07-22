var announcementJS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
				
		announcement: function(emailnya, subjectnya, bodyemail) {
            var datas = $('#formnya').serializeArray();
			var url = 'ar_email_admin_do.php';
			// console.log(datas);
			
			$.ajax({
                url: url,
                data: datas,
                type: 'POST',
                success: function(response) {
					  // console.log(response); 
					// $("#content1").html(response);
				var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Success Send Announcement!!';
                          var keterangan = '';
                          notifysuccess_common('success', 'top right', title, keterangan);
                          setTimeout('history.go(0);', 3000);
						  // $("#content2").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Send Announcement';
                         var keterangan = 'Please Select Announcement To';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '2') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Send Announcement';
                         var keterangan = 'Please Input Announcement Subject';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '3') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Send Announcement';
                         var keterangan = 'Please input Announcement';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }
                }
            });
        },
		
    };

}();