var RM = function() {
    // alert("2");
    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        // addM: function(email, nama, upline, loginmeta, city, groupcity, telephone_mobile) {
        addM: function(email, nama, upline, city, groupcity, telephone_mobile) {
         // var url = 'registration_marketing_do.php?email=' + email + '&nama=' + nama + '&upline=' + upline +'&loginmeta=' + loginmeta + '&city=' + city + '&groupcity=' + groupcity + '&telephone_mobile=' + telephone_mobile;
         var url = 'registration_marketing_do.php?email=' + email + '&nama=' + nama + '&upline=' + upline + '&city=' + city + '&groupcity=' + groupcity + '&telephone_mobile=' + telephone_mobile;
         var data = '&ajax_validation=1';
			       // console.log(email, nama, upline, loginmeta, city, groupcity, telephone_mobile);     
               
               
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
                           var title = 'The Marketing Registration Success';
                           var keterangan = 'Please check your e-mail reply from admin';
                            notifysuccess_common('success', 'top right', title, keterangan);
                             setTimeout('history.go(0);', 3000);
							  // $("#main_content").html(response);
                          
                     } 
					 else if (res == '1') {//Fai
                          // alert("28:Fail");
                          var title = 'Can not create a Marketing Account';
                          var keterangan = 'Please fill in the first Your Upline field';
                           notifyerror1('error', 'top right', title, keterangan);
                     }
					 // else if (res == '2') {//Fai
                          // // alert("28:Fail");
                          // var title = 'Can not create a Marketing Account';
                          // var keterangan = 'Please fill in the first Your Login Meta field';
                           // notifyerror1('error', 'top right', title, keterangan);
                     // }
					 else if (res == '3') {//Fai
                          // alert("28:Fail");
                          var title = 'Can not create a Marketing Account';
                          var keterangan = 'Please fill in the first Your Branch field';
                           notifyerror1('error', 'top right', title, keterangan);
                     }else if (res == '4') {//Fai
                          // alert("28:Fail");
                          var title = 'Can not create a Marketing Account';
                          var keterangan = 'Please fill in the first Your Group Branch field';
                           notifyerror1('error', 'top right', title, keterangan);
                     }
                     else if (res == '5') {//Access unAuthorize
                         //alert("35:Fail");
                          var title = "Can not create a Marketing Account";
                         var keterangan = 'Please fill in the first Your Telephone Number field';
                          notifyerror1('error', 'top right', title, keterangan);
                        
                      }
					
                }
            });
},

};
}();

