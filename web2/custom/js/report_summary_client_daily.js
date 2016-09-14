var ReportSummaryClientDaily_JS = function() {
    //alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        datesearch: function(selectId, mt4dt, accountstatus) {
            $('#button3').prop('disabled', true);
            var url = 'report_summary_client_daily.php?datesearch2=' + selectId 
                    + '&mt4dt=' + mt4dt + "&accountstatus=" + accountstatus;
            // alert("Line-16-URL:"+url);
            var data = '&ajax_validation=1';
            $('#spoilernya').prop('hidden', false);
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $("#main_content").html(response);
                    $('#button3').prop('disabled', false);
                }
            });
            //setTimeout('history.go(0);', 0);
        }
    };

}();