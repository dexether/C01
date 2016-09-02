var set_cas_com = function() {
    // alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            // alert("Line-79");
            //handle_withdrawal();
        },
        
        view: function(lihat) {
           var url = 'car_cas_com.php?lihat=' + lihat;
            var data = '&ajax_validation=1';
			    // console.log(lihat);     
			 
            
			$.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                       // console.log(response)
				$("#main_content").html(response);
				                
                }
            });
        },
		
		crud1: function(add, accountsearch, downline) {
           var url = 'car_cas_com_do.php?addcar=' + add + '&accno=' + accountsearch + '&ACCNO=' + downline;
            var data = '&ajax_validation=1';
			   // console.log(add, accountsearch, downline);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                // console.log(response)
                // $("#main_content").html(response);
				    // setTimeout('history.go(0);', 1000);
				var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Success!!';
                          var keterangan = 'ADD Setting Cas Commission';
                          notifysuccess_common('success', 'top right', title, keterangan);
                          setTimeout('history.go(0);', 3000);
						  // $("#main_content").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Cas Commission';
                         var keterangan = 'Please fill in the field';
                         notifyerror1('error', 'top right', title, keterangan);
						 setTimeout('history.go(0);', 3000);
                     }
                }
            });
        },
		crud2: function(edit, accountsearch, idnya, downline) {
           var url = 'car_cas_com_do.php?editcar=' + edit + '&accno=' + accountsearch + '&idnya=' + idnya + '&ACCNO=' + downline;
            var data = '&ajax_validation=1';
			   // console.log(edit, accountsearch, idnya, downline);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                // console.log(response)
                // $("#main_content").html(response);
				    // setTimeout('history.go(0);', 1000);
				var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Success!!';
                          var keterangan = 'Edit Setting Cas Commission';
                          notifysuccess_common('success', 'top right', title, keterangan);
                          setTimeout('history.go(0);', 3000);
						  // $("#main_content").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Cas Commission';
                         var keterangan = 'Please fill in the field';
                         notifyerror1('error', 'top right', title, keterangan);
						 setTimeout('history.go(0);', 3000);
                     }  
                }
            });
        },
		crud3: function(delet, idnya) {
           var url = 'car_cas_com_do.php?deletcar=' + delet + '&idnya=' + idnya;
            var data = '&ajax_validation=1';
			   // console.log(delet, idnya);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                // console.log(response)
                // $("#main_content").html(response);
				   // setTimeout('history.go(0);', 1000);
				var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Success!!';
                          var keterangan = 'Delete Setting Cas Commission';
                          notifysuccess_common('success', 'top right', title, keterangan);
                          setTimeout('history.go(0);', 3000);
						  // $("#main_content").html(response);
                          
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Cas Commission';
                         var keterangan = 'Please fill in the field';
                         notifyerror1('error', 'top right', title, keterangan);
						 setTimeout('history.go(0);', 3000);
                     }
                }
            });
        },
	};

}();


