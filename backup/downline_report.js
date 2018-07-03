var downline_report_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        get_data: function(a) {
            var data = $('#ajax-form').serializeArray()
            var start = $('input[name=start]').val();
            var end = $('input[name=end]').val();
            // console.log(tahun)
            $.ajax({
                url: 'downline_report.php?postmode=generate',
                data: data,
                type: 'POST',
                beforeSend: function() {
                    $(a).button('loading');
                    // console.log(a);
                    $('table[id=table-lot] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                },
                success: function(response) {
                    $('table tbody').html('');
					$(a).button('reset');
					var data = JSON.parse(response);
                    if (data.length > 0) {
                        // quick
                        for (var i = 0; i < data.length; i++) {
								tr = $('<tr/>');
								tr.append("<td>" + data[i].ACCNO + "</td>");
                                tr.append("<td>" + data[i].name + "</td>");
                                tr.append("<td>" + 
                                    '<button title="Info" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalinfo" onclick="vi('+data[i].mt4login+')"><i class="fa fa-info-circle"></i></button> &nbsp'+
                                    '<button title="Open Position" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalopen" onclick="vi('+data[i].mt4login+')"><i class="fa fa-list-ol"></i></button> &nbsp'+
                                    '<button title="Close Position" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalclose" onclick="vi('+data[i].mt4login+')"><i class="fa fa-bar-chart"></i></button> &nbsp'+
                                    '<button title="Margin" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalmargin" onclick="vi('+data[i].mt4login+')"><i class="fa fa-briefcase"></i></button> &nbsp'+
                                "</td>");
								tr.append("<td>" + data[i].mt4login + "</td>");
								tr.append("<td>" + data[i].lot + "</td>");
								$('table[id=table-lot] tbody').append(tr);
                        }
                    } else {
                        tr = $('<tr/>');
                        tr.append("<td colspan=8 class=text-center> Tidak ada transaksi</td>");
                        $('table tbody').append(tr);
                    }
                },
                error: function() {
                    alert('Error, Please call publisher');
                    $(a).button('reset');
                }
            });
        }
    };
}();
