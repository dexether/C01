var Treview_JS = function() {
    //alert("2");
    var handle_withdrawal = function() {}
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        view_result: function(bonus, waktu) {
            // console.log(bonus, waktu)
            var url = "bonus_detail.php?postmode=table";
            var data = $('form[name=bonussetting]').serializeArray();
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                beforeSend: function() {
                    $('#to-excel-bonus').hide();
                    $('tbody', '#ajax-table').html('<tr><td colspan=5><img class="img-responsive center-block" src="images/loading/spin.gif"></td></tr>');
                },
                success: function(response) {
                    // console.log(response);
                    $('#to-excel-bonus').toggle();
                    $('tbody', '#ajax-table').html(response);
                }
            });
        },
        accountdetail: function(accno) {
            var url = 'treview_detail.php?accno=' + accno;
            //alert("Line-16-URL:" + url);
            if (accno == 'COMPANY') {} else {
                var data = '&ajax_validation=1';
                //$('#md-3d-sign').modal('show');
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function(response) {
                        $("#main_content").html(response);
                    }
                });
            }
            //setTimeout('history.go(0);', 0);
        },
        accountdetail2: function(accno) {
            var url = 'imp_treeview_detail.php?accno=' + accno;
            //alert("Line-16-URL:" + url);
            if (accno == 'COMPANY') {} else {
                var data = '&ajax_validation=1';
                //$('#md-3d-sign').modal('show');
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function(response) {
                        $("#main_content").html(response);
                    }
                });
            }
            //setTimeout('history.go(0);', 0);
        },
        accountdetail3: function(accno) {
            var url = 'imp_treeview_detail2.php?accno=' + accno;
            //alert("Line-16-URL:" + url);
            if (accno == 'COMPANY') {} else {
                var data = '&ajax_validation=1';
                //$('#md-3d-sign').modal('show');
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function(response) {
                        // console.log(response)
                        $("#ajax-load").html(response);
                    }
                });
            }
            //setTimeout('history.go(0);', 0);
        },
        temporary_statement: function(account, mt4dt) {
            var url = 'temporary_statement.php?account=' + account + '&mt4dt=' + mt4dt;
            var data = '&ajax_validation=1';
            $("#temporary-statement").html('<img class="img-responsive center-block" src="images/loading/spin.gif" width="100" height="100">');
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    // console.log(response);
                    $("#to-excel").fadeIn();
                    $("#temporary-statement").html(response);
                }
            });
        },
        daily_statement: function(account, datesearch, mt4dt) {
            var url = 'daily_statement.php?account=' + account + '&datesearch=' + datesearch + '&mt4dt=' + mt4dt;
            var data = '&ajax_validation=1';
            $("#daily-statement").html('<img class="img-responsive center-block" src="images/loading/spin.gif" width="100" height="100">');
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    // console.log(response);
                    $("#to-excel2").fadeIn();
                    $("#daily-statement").html(response);
                }
            });
        }
    };
}();