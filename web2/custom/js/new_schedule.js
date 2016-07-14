var new_schedule1 = function() {
    // alert("2");
    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        schedule: function(upline, nama, email, Destination, Meet, tgl, Away) {
         var url = 'add_new_schedule_do.php?accountupline=' + upline + '&account=' + nama + '&email=' + email + '&Destination=' + Destination + '&Meet=' + Meet + '&tgl=' + tgl + '&Away=' + Away;
         var data = '&ajax_validation=1';
			    // console.log(upline, nama, email, Destination, Meet, tgl, Away);     
               
               
               $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                        // console.log(response)
						// $("#menu").html(response);
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
                         var keterangan = 'Please fill in the first Your Upline field';
                         notifyerror('error', 'top right', title, keterangan);
						 setTimeout('history.go(0);', 6000);
                     }
                    else if (res == '2') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = 'Can not create a schedule';
                        var keterangan = 'Please fill in the first Name field';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 6000);
                    }
					else if (res == '3') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = 'Can not create a schedule';
                        var keterangan = 'Please fill in the first email field';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 6000);
                    }
					else if (res == '4') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = 'Can not create a schedule';
                        var keterangan = 'Please fill in the first Destination field';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 6000);
                    }
					else if (res == '5') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = 'Can not create a schedule';
                        var keterangan = 'Please fill in the first Meet with field';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 6000);
                    }
					else if (res == '6') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = 'Can not create a schedule';
                        var keterangan = 'Please fill in the first Time Meeting field';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 6000);
                    }
					else if (res == '7') {//Access unAuthorize
                        //alert("35:Fail");
                        var title = 'Can not create a schedule';
                        var keterangan = 'Please fill in the first Date Meeting field';
                        notifyerror('error', 'top right', title, keterangan);
                        setTimeout('history.go(0);', 6000);
                    }
                }
            });
        }
    };

}();

