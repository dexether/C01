var ReportEquity_JS = function() {
    //alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        
        see_in_excell : function(datesearchfrom, datesearchto, mt4dt, equitychanged) {
            var url = 'report_equity_excell.php?datesearchfrom=' + datesearchfrom + '&datesearchto=' + datesearchto
                    + '&mt4dt=' + mt4dt;
            alert("Line-17-URL:" + url);
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    
                }
            });
            //setTimeout('history.go(0);', 0);
        },
        first: function(mt4dt) {

             var sel = $('input[type=checkbox]:checked').map(function(_, el) {
                return $(el).val();
            }).get();
            
            console.log(mt4dt);
            console.log(sel);

            $.ajax({
                url: 'report_equity.php',
                data: { kotas: sel, meta: mt4dt, key: 'first'},
                type: 'POST',
                success: function(response) {
                   // console.log(data)
                   $("#main_content").html(response);

                }
            });
        
            //setTimeout('history.go(0);', 0);
        },
        second: function(mt4dt) {

            var kot = $('input[id=kota]:checked').map(function(_, el) {
                return $(el).val();
            }).get();

            var rat = $('input[id=rate]:checked').map(function(_, el) {
                return $(el).val();
            }).get();

            // console.log(rat);
             $.ajax({
                url: 'report_equity.php',
                data: { rates: rat, meta: mt4dt, kot: kot, key: 'second'},
                type: 'POST',
                success: function(response) {
                   // console.log(response)
                   $("#main_content").html(response);
                }
            });

            //setTimeout('history.go(0);', 0);
        },
        check: function() {

            alert("Kliked");
            var checked = $(this).attr("checked");
            $("input:checkbox").attr("checked", checked);
        },
        third: function(datefrom, dateto) {

            var kot = $('input[id=kota]:checked').map(function(_, el) {
                return $(el).val();
            }).get();

            var rat = $('input[id=rate]:checked').map(function(_, el) {
                return $(el).val();
            }).get();

            var acc = $('input[id=acc]:checked').map(function(_, el) {
                return $(el).val();

            }).get();
            var metas = $('select[name=meta]').val();
            
             $.ajax({
                url: 'report_equity_excell.php',
                data: {from: datefrom, to: dateto, meta: metas, rates: rat, kot: kot, acc: acc, key: 'third'},
                type: 'POST',
                success: function(response) {
                	// console.log(response)
                    var res = response;
                    var trigger = response.substring(0,1);
                    var file = response.substring(4);
                     if (trigger == 't') {
                        notifysuccess_common('success', 'top right', 'Create Report', 'Report Has been created, File Name <strong>' + file + '</strong>');
                        location.href = response +'.xlsx';
                     }else{
                        notifyerror('error', 'top right','Error',res);
                     }
                    
                }
            });

            //setTimeout('history.go(0);', 0);
        },
        savetodtbase: function(datesearchfrom, datesearchto, statements_filter) {
            var url = 'report_equity_savedata.php?datesearchfrom=' + datesearchfrom
                    + "&datesearchto=" + datesearchto + "&statements_filter=" + statements_filter;
            //alert("Line-31-URL:" + url);
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
                        var url2 = 'report_equity.php?rangefrom=' + datesearchfrom
                                + "&rangeto=" + datesearchto + "&statements_filter=" + statements_filter;
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

    };

}();

function updaterollover() {
    var url = 'report_equity.php?checktanggal=from';
    //alert("Line-31-URL:" + url);
    var data = '&ajax_validation=1';
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        success: function(response) {
            alert("Line-38-URL:" + response);
            //$("#main_content").html(response);
            var res = response.substring(0, 1);
            //alert("69:" + res );
            if (res == '0') {//success
            }
            postMessage("Hello-67");
        }
    });
}
