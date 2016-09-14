var car_MLM_Registration_JS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        }, 
		
		shownya: function(b) {
            var url = 'car_mlm_registration_sec.php';
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
		
		admin1: function(Approv, marem, email, logmeta, branch) {
			var url = 'car_mlm_registration_sec_do.php?Approv=' + Approv + '&marem=' + marem + '&email=' + email + '&logmeta=' + logmeta + '&branch=' + branch;
            var data = '&ajax_validation=1';
			      // console.log(Approv, marem, email, logmeta, branch);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                  // console.log(response)
				 // $("#main_content").html(response);
                var res = response.substring(0, 1);
                     // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                        var title = 'Confirm Created Account';
                        var keterangan = 'And Then e-mail sent to Branch Manager';
                        notifysuccess_common1('success', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 4000);
						// $("#main_content").html(response);
                        
                    } else if (res == '1') {//Fail
                         // alert("28:Fail");
                        var title = 'Can not Confirm Created Account';
                        var keterangan = 'Please fill in the first Upline Email field';
                        notifyerror1('error', 'top right', title, keterangan);
						
                    }else if (res == '2') {//Access unAuthorizee
                        //alert("35:Fail");
                        var title = "Can not Confirm Created Account";
                        var keterangan = 'Please fill in the first branch field';
                        notifyerror1('error', 'top right', title, keterangan);
                       
                    }
				  
                }
            });
        },
		
		admin2: function(Cancel, marem, email, logmeta, branch) {
			var url = 'car_mlm_registration_sec_do.php?Cancel=' + Cancel + '&marem=' + marem + '&email=' + email + '&logmeta=' + logmeta + '&branch=' + branch;
            var data = '&ajax_validation=1';
			      // console.log(Cancel, marem, email, logmeta, branch);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                 // console.log(response)
				 // $("#main_content").html(response);
                var res = response.substring(0, 1);
                     // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                        var title = 'Confirm Created Account';
                        var keterangan = 'And Then e-mail sent to Branch Manager';
                        notifysuccess_common1('success', 'top right', title, keterangan);
                         setTimeout('history.go(0);', 4000);
						 // $("#main_content").html(response);
                        
                    } else if (res == '1') {//Fail
                         // alert("28:Fail");
                        var title = 'Can not Confirm Created Account';
                        var keterangan = 'Please fill in the first Email Upline field';
                        notifyerror1('error', 'top right', title, keterangan);
						
                    }else if (res == '2') {//Access unAuthorizee
                        //alert("35:Fail");
                        var title = "Can not Confirm Created Account";
                        var keterangan = 'Please fill in the first Branch field';
                        notifyerror1('error', 'top right', title, keterangan);
                       
                    }
				  
                }
            });
        },
    };

}();