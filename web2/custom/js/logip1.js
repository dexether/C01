var LogIp1 = function() {
    //alert("2");

    var handle_1 = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        datesearch: function(date1, date2, time1, time2, maxrow,filter) {
            if (Number(maxrow) > 10000) {
                alert("MaxRow is 10.000");
                //exit;
            } else {
                var url = 'logip1.php?date1=' + date1
                        + "&date2=" + date2 + "&time1="
                        + time1 + "&time2=" + time2 
                        + "&maxrow=" + maxrow+"&filter="+filter;
                //alert("Line-16-URL:"+url);
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
            }//if (maxrow > 10000) {

        }
    };

}();