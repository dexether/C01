var Report_Summary_Client_Running_JS = function() {
    //alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-11");
            //handle_withdrawal();
        }, 
        reload: function() {
            var url = 'report_summary_client.php';
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
        reloadfilter: function(mt4dt,accountstatus) {
            var url = 'report_summary_client.php?mt4dt=' + mt4dt+"&accountstatus="+accountstatus;
            alert("Reload Data for :" + mt4dt+" and Account:"+accountstatus);
            //alert("Url:"+url);
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