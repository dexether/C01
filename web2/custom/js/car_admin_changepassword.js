var admin_changepassword_JS = function() {
    //alert("2");

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        }, 
		
		shownya: function(b) {
            var url = 'car_admin_changepassword.php';
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
		
		admin1: function(marem, name, pass1, pass2) {
			var url = 'car_admin_changepassword_do.php?usermail=' + marem + '&namanya=' + name + '&Password1=' + pass1 + '&Password2=' + pass2;
            var data = '&ajax_validation=1';
			    // console.log(marem, name, pass1, pass2);     
			 
            
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
                        var title = 'Change Password Successfully';
                        var keterangan = 'And Then email sent to User';
                        notifysuccess_common1('success', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 4000);
						// $("#main_content").html(response);
                        
                    } else if (res == '1') {//Fail
                         // alert("28:Fail");
                        var title = 'Can not Change Password';
                        var keterangan = 'Please fill in the first Password field';
                        notifyerror1('error', 'top right', title, keterangan);
						
                    }else if (res == '2') {//Access unAuthorizee
                        //alert("35:Fail");
                        var title = "Can not Change Password";
                        var keterangan = 'Password is not the same Re - type password';
                        notifyerror1('error', 'top right', title, keterangan);
                       
                    }else if (res == '3') {//Access unAuthorizee
                        //alert("35:Fail");
                        var title = "Can not Change Password";
                        var keterangan = 'A minimum password length of 4 characters ';
                        notifyerror1('error', 'top right', title, keterangan);
                       
                    }else if (res == '4') {//Access unAuthorizee
                        //alert("35:Fail");
                        var title = "Can not Change Password";
                        var keterangan = 'Please Select User';
                        notifyerror1('error', 'top right', title, keterangan);
                       
                    }
                }
            });
        },
    };

}();