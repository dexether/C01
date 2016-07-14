var Ntr_update_JS = function() {
    //alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-11");
            //handle_withdrawal();
        }, 
        updatetb: function(mt4dt) {
 
            
                 var url = 'ntr_update_do.php?update=yes&metas=' + mt4dt;
                 var data = '&ajax_validation=1';
                 $(".up").hide();
                 
                 $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function (response) {
                            //alert("27:"+response);
                            var res = response.substring(0, 1);
                            var trigger = response;
                            //alert("29:"+res);
                            /*if (res == '0') {//success
                                notifycus('success', 'top right','Success','NTR Update successfully');
                                Ntr_update_JS.updatetb(mt4dt);
                            }else{
                     
                               notify('warning', 'top left','Warning','NTR is Updated');
                              
                            }*/
                            if (res == 0) {
                                notifycus('success', 'top right','Success','NTR Update successfully');
                                Ntr_update_JS.updatetb(mt4dt);
                            } else if (res == 2) {
                                notifyerror('warning', 'top right','Warning','NTR has been updated');
                                $(".up").show();
                                $("#loading").hide();
                            } else {
                                notifyerror('error', 'top right','Error',trigger);
                                $(".up").show();
                                $("#loading").hide();
                            }

                           
                            //$('#username').removeClass('spinner');
                            //toastr.success("Update Password", "Your has been successfully to");
                        },
                    error: function(response){
                        alert("fail");
                    }
                });
            
           
            //setTimeout('history.go(0);', 0);
        }
    };

}();