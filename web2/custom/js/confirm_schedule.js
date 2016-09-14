var CNFM_schedule = function() {
    // alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        user: function(accountsearch) {
           var url = 'confirm_schedule.php?accno=' + accountsearch + '&tampil=no';
            var data = '&ajax_validation=1';
			  // console.log(accountsearch);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                     // console.log(response)
                   // $("#confirm").html(response);
				   var res = response.substring(0, 1); 
				if(res == '0'){
                   var title = 'Can not Confirm Id Schedule';
                        var keterangan = 'Id schedule you input is incorrect or can not be empty';
                        notifysuccess_common1('error','top right', title, keterangan);
				}else{
					$("#confirm").html(response);
				}
                }
            });
        },
		
		status1: function(Approv, downline, upline, email, nama) {
           var url = 'confirm_schedule_do.php?Approv=' + Approv + '&ACCNO=' + downline + '&accountupline=' + upline + '&email=' + email + '&account=' + nama;
            var data = '&ajax_validation=1';
			   console.log(Approv, downline, upline, email, nama);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                     // console.log(response)
                   // $("#confirm").html(response);
				   setTimeout('history.go(0);', 1000);
				  
                }
            });
        },
		status2: function(Cancel, downline, upline, email, nama) {
           var url = 'confirm_schedule_do.php?Cancel=' + Cancel + '&ACCNO=' + downline + '&accountupline=' + upline + '&email=' + email + '&account=' + nama;
            var data = '&ajax_validation=1';
			  console.log(Cancel, downline, upline, email, nama);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                     // console.log(response)
                   setTimeout('history.go(0);', 1000);
				  // $("#confirm").html(response); 
                }
            });
        },
		   
    };
}();

