var car_set_com_JS = function() {
    // alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
		shownya: function(b) {
            var url = 'car_set_com.php';
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
		crud1: function(casnya, acc1, comisi1, over1, acc2, comisi2, over2, acc3, comisi3, over3, acc4, comisi4, over4, acc5, comisi5, over5, acc6, comisi6, over6) {
			     // console.log(casnya, acc1, comisi1, over1, acc2, comisi2, over2, acc3, comisi3, over3, acc4, comisi4, over4, acc5, comisi5, over5, acc6, comisi6, over6);     
			var url = 'car_set_com_do.php?casnya=' + casnya + '&accbm=' + acc1 + '&combm=' + comisi1 + '&overbm=' + over1 + '&accmm=' + acc2 + '&commm=' + comisi2 + '&overmm=' + over2 
					+ '&accspv=' + acc3 + '&comspv=' + comisi3 + '&overspv=' + over3 + '&accae=' + acc4 + '&comae=' + comisi4 + '&overae=' + over4
					+ '&accaed=' + acc5 + '&comaed=' + comisi5 + '&overaed=' + over5 + '&accaedf=' + acc6 + '&comaedf=' + comisi6 + '&overaedf=' + over6;
            var data = '&ajax_validation=1';
			    // console.log(edit);     
			 
            $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                       // console.log(response)
					   // $("#confirm").html(response);
				var res = response.substring(0, 1);
                          // alert("20:" + res);
                    if (res == '0') {//success
                          // alert("22:Success");
                          var title = 'Success!!';
                          var keterangan = 'Setting Commission ';
                          notifysuccess_common('success', 'top right', title, keterangan);
                          setTimeout('history.go(0);', 3000);
                    } else if (res == '1') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Commission';
                         var keterangan = 'Please fill in the first Commission field';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '2') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Commission';
                         var keterangan = 'Please fill in the first Commission field';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '3') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Commission';
                         var keterangan = 'Please fill in the first Commission field';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '4') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Commission';
                         var keterangan = 'Please fill in the first Commission field';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '5') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Commission';
                         var keterangan = 'Please fill in the first Commission field';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '6') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Commission';
                         var keterangan = 'Please fill in the first Commission field';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }else if (res == '9') {//Fai
                         // alert("28:Fail");
                         var title = 'Can not Setting Commission';
                         var keterangan = 'commission amount greater than the Charge Commission';
                         notifyerror1('error', 'top right', title, keterangan);
						 // setTimeout('history.go(0);', 3000);
                     }
				                
                }
            }); 
            
			 
        },
		
    };
}();

