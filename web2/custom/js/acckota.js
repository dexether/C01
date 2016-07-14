var Acckota_JS = function() {
    //alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-11");
            //handle_withdrawal();
        }, updatetable: function() {
            var url = 'acckota.php?updatetable=yes';
            alert("Update data Mt4 copy to Cabinet");
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    //alert("68:"+response);
                    var res = response.substring(0, 1);
                    //alert("69:" + res );
                    if (res == '0') {//success
                        //alert("30:Success");
                        notifysuccess_common('success', 'top right', 'Update AccKota', 'Success');
                    } else {//Fail
                        alert("34:Update Fail");
                        //notifyerror('error', 'top right', 'There is Problem', response);
                        //notifysuccess_common('fail', 'top right', 'Update AccKota', 'response');
                    }
                    var url = 'acckota.php';
                    var data = '&ajax_validation=1';
                    $.ajax({
                        url: url,
                        data: data,
                        type: 'POST',
                        success: function(response) {
                            $("#main_content").html(response);
                        }
                    });
                    //setTimeout('history.go(0);', 0);
                }
            });
            //setTimeout('history.go(0);', 0);
        }, //savetodtbase: function(floatingturnover) {
        reload: function() {
            var url = 'acckota.php';
            alert("Reload Data for All");
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $("#main_content").html(response);
                }
            });
            //setTimeout('history.go(0);', 0);
        },
        reloadfilter: function(mt4dt) {
            var url = 'acckota.php?mt4dt=' + mt4dt;
            alert("Reload Data for :" + mt4dt);
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $("#main_content").html(response);
                }
            });
            //setTimeout('history.go(0);', 0);
        }
    };

}();