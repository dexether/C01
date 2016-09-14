var reportturnoverrunning = function() {
    //alert("2");

    var handle_1 = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        savetodtbase: function(forexfixmargin, forexfixturnover, indexfixmargin, indexfixturnover, floatingmargin, floatingturnover, rangefrom, rangeto, subscribe, email1) {
            var url = 'report_turnover_running2.php?floatingturnover=' + floatingturnover
                    + "&floatingmargin=" + floatingmargin
                    + "&indexfixturnover=" + indexfixturnover + "&indexfixmargin=" + indexfixmargin
                    + "&forexfixturnover=" + forexfixturnover + "&forexfixmargin=" + forexfixmargin
                    + "&rangefrom=" + rangefrom + "&rangeto=" + rangeto + "&subscribe=" + subscribe + "&email1=" + email1;
            //alert("Line-20-URL:" + url);
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    //alert("68:"+response);
                    var res = response.substring(0, 1);
                    //alert("69:" + res + ";" + response);
                    if (res == '0') {//success
                        //alert("30:Success");
                        notifysuccess_common('success', 'top right', 'Update Profile', 'Success');
                        //setTimeout('history.go(0);', 1000);
                        var url2 = 'report_turnover_running.php?floatingturnover=' + floatingturnover
                                + "&floatingmargin=" + floatingmargin
                                + "&indexfixturnover=" + indexfixturnover + "&indexfixmargin=" + indexfixmargin
                                + "&forexfixturnover=" + forexfixturnover + "&forexfixmargin=" + forexfixmargin
                                + "&rangefrom=" + rangefrom + "&rangeto=" + rangeto + "&subscribe=" + subscribe + "&email1=" + email1;
                        var data = '&ajax_validation=1';
                        $.ajax({
                            url: url2,
                            data: data,
                            type: 'POST',
                            success: function(response) {
                                $("#main_content").html(response);
                            }
                        });
                    } else {//Fail
                        //alert("34:Fail");
                        notifyerror('error', 'top right', 'There is Problem', response);
                        //setTimeout('history.go(0);', 5000);
                    }
                }
            });
            //setTimeout('history.go(0);', 0);
        }, //savetodtbase: function(floatingturnover) {
        reloaddata: function(forexfixmargin, forexfixturnover, indexfixmargin, indexfixturnover, floatingmargin, floatingturnover, rangefrom, rangeto, subscribe, email1) {
            var url = 'report_turnover_running.php?floatingturnover=' + floatingturnover
                    + "&floatingmargin=" + floatingmargin
                    + "&indexfixturnover=" + indexfixturnover + "&indexfixmargin=" + indexfixmargin
                    + "&forexfixturnover=" + forexfixturnover + "&forexfixmargin=" + forexfixmargin
                    + "&rangefrom=" + rangefrom + "&rangeto=" + rangeto + "&subscribe=" + subscribe + "&email1=" + email1;
            //alert("Line-49-URL:" + url);
            alert("Reload Data will be process, and will take times, please wait");
            console.log(rangefrom);
            console.log(rangeto);
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
        } //savetodtbase: function(floatingturnover) {
    };

}();