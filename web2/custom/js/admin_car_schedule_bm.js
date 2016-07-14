var AC_Schedule = function() {
    // alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        admin: function(accountsearch, no) {
           var url = 'admin_car_schedule_bm.php?accno=' + accountsearch + '&tampil=no';
            var data = '&ajax_validation=1';
			  // console.log(accountsearch);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
					// console.log(response)
                 var res = response.substring(0, 1); 
				if(res == '0'){
                   var title = 'Can not Confirm Id Schedule';
                   var keterangan = 'Id schedule you input is incorrect or can not be empty';
                   notifysuccess_common1('error','top right', title, keterangan);
				}else{
					$("#main_content").html(response);
				}
                }
            });
        },
		
		admin1: function(Approv, meta, downline, upline, mail, offer) {
			var url = 'admin_car_schedule_bm_do.php?Approv=' + Approv + '&meta=' + meta + '&ACCNO=' + downline + '&accountupline=' + upline + '&email=' + mail + '&offer=' + offer;
            var data = '&ajax_validation=1';
			     console.log(Approv, meta, downline, upline, mail, offer);     
			 
            
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
                        var title = 'Confirm schedule successfully';
                        var keterangan = 'And Then e-mail reply from User and Upline';
                        notifysuccess_common1('success', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 4000);
						// $("#main_content").html(response);
                        
                    } else if (res == '1') {//Fail
                         // alert("28:Fail");
                        var title = 'Can not create a schedule';
                        var keterangan = 'Please fill in the first Car Id field';
                        notifyerror1('error', 'top right', title, keterangan);
						
                    }else if (res == '2') {//Access unAuthorizee
                        //alert("35:Fail");
                        var title = "Can not create a schedule";
                        var keterangan = 'Please fill in the first Offer field';
                        notifyerror1('error', 'top right', title, keterangan);
                       
                    }
				  
                }
            });
        },
		
		admin2: function(Cancel, meta, downline, upline, mail, offer) {
			var url = 'admin_car_schedule_bm_do.php?Cancel=' + Cancel + '&meta=' + meta + '&ACCNO=' + downline + '&accountupline=' + upline + '&email=' + mail + '&offer=' + offer;
            var data = '&ajax_validation=1';
			     console.log(Cancel, meta, downline, upline, mail, offer);     
			 
            
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
                        var title = 'Confirm schedule successfully';
                        var keterangan = 'And Then e-mail reply from User and Upline';
                        notifysuccess_common1('success', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 4000);
						// $("#main_content").html(response);
                        
                    } else if (res == '1') {//Fail
                         // alert("28:Fail");
                        var title = 'Can not create a schedule';
                        var keterangan = 'Please fill in the first Car Id field';
                        notifyerror1('error', 'top right', title, keterangan);
						
                    }else if (res == '2') {//Access unAuthorizee
                        //alert("35:Fail");
                        var title = "Can not create a schedule";
                        var keterangan = 'Please fill in the first Offer field';
                        notifyerror1('error', 'top right', title, keterangan);
                       
                    }
				  
                }
            });
        },
		   
    };
}();

