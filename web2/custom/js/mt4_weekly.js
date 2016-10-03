var Mt4_weekly_JS = function() {
    //alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-11");
            //handle_withdrawal();
        }, 
        initials: function(datefrom, dateto, mt4dt) {
            var url = 'mt4_weekly_initial_do.php?key=initial&datefrom=' + datefrom + '&dateto=' + dateto + '&metas=' + mt4dt;
            var data = '&ajax_validation=1';
            $('#loading').show();
            $('#initial-form').hide();
            $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function (response) {                            
                            var res = response.substring(0, 1);
                            if (res == 0) {
                               notifysuccess_common('success', 'top right','Success','Update successfully');
                                $('#loading').hide();
                            }else{
                               notifyerror('error', 'top right','Error','Error on updating');
                               $('#loading').hide();
                            }
                        },
                    error: function(response){
                        alert("fail");
                    }
                });
        },
        weekly: function(dateto, mt4dt) {
            var url = 'mt4_weekly_do.php?key=weekly&&dateto=' + dateto + '&metas=' + mt4dt;
            var data = '&ajax_validation=1';
            $('#loading').show();
            $('#showhide').hide();
            $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function (response) {                            
                            var res = response.substring(0, 1);
                            if (res == 0) {
                                notifysuccess_common('success', 'top right','Success','Update successfully');
                                $('#loading').hide();
                                $('#showhide').show(); 
                            }else{
                               notifyerror('error', 'top right','Error','Error on updating');
                                $('#loading').hide();
                                $('#showhide').show(); 
                            }
                        },
                    error: function(response){
                        alert("fail");
                    }
                });
        }
    };

}();