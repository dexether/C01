var Marketing_act = function() {
    // alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
       
		add: function(account, prodate, proname, prores, promail, protel, prosum, status) {
           var url = 'marketing_activity_do.php?account=' + account + '&prodate=' + prodate + '&proname=' + proname + '&prores=' + prores + '&promail=' + promail + '&protel=' + protel + '&prosum=' + prosum + '&status=' + status;
            var data = '&ajax_validation=1';
			   // console.log(account, prodate, proname, prores, promail, protel, prosum, status);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                      // console.log(response)
					// $("#confirm").html(response);
				   // setTimeout('history.go(0);', 1000);
				var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'The new schedule successfully';
                          var keterangan = 'Please check your e-mail reply from admin';
                          notifysuccess_common('success', 'top right', title, keterangan);
                          setTimeout('history.go(0);', 4000);
						  // $("#main_content").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not create a schedule';
                         var keterangan = 'Please fill in the first Account field';
                         notifyerror1('error', 'top right', title, keterangan);
                     }
                    else if (res == '2') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = "Can not create a schedule";
                        var keterangan = 'Please fill in the first Prospect Date field';
                        notifyerror1('error', 'top right', title, keterangan);
                        
                    }
					else if (res == '3') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = "Can not create a schedule";
                        var keterangan = 'Please fill in the first Prospect Name field';
                        notifyerror1('error', 'top right', title, keterangan);
                        
                    }
					else if (res == '4') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = "Can not create a schedule";
                        var keterangan = 'Please fill in the first Prospect Address field';
                        notifyerror1('error', 'top right', title, keterangan);
                        
                    }
					else if (res == '5') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = "Can not create a schedule";
                        var keterangan = 'Please fill in the first Prospect Email field';
                        notifyerror1('error', 'top right', title, keterangan);
                        
                    }
					else if (res == '6') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = "Can not create a schedule";
                        var keterangan = 'Please fill in the first Prospect Telp field';
                        notifyerror1('error', 'top right', title, keterangan);
                        
                    }
					else if (res == '7') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = "Can not create a schedule";
                        var keterangan = 'Please fill in the first Prospect Summary field';
                        notifyerror1('error', 'top right', title, keterangan);
                        
                    }
                
                }
            });
        },
		
    };
}();

