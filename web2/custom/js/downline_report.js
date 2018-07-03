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
                    
					$(a).button('reset');
					var data = JSON.parse(response);
                    if (data.length > 0) {
                        // quick
                        for (var i = 0; i < data.length; i++) {
								// tr = $('<tr/>');
								// tr.append("<td>" + data[i].ACCNO + "</td>");
								// tr.append("<td>" + data[i].name + "</td>");
        //                         tr.append("<td>" + 
        //                             '<button title="Info" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalinfo" onclick="vi('+data[i].mt4login+')"><i class="fa fa-info-circle"></i></button> '+
        //                             '<button title="Open Position" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalopen" onclick="op('+data[i].mt4login+')"><i class="fa fa-list-ol"></i></button> '+
        //                             '<button title="Close Position" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalclose" onclick="cp('+data[i].mt4login+')"><i class="fa fa-bar-chart"></i></button> '+
        //                             '<button title="Margin" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalmargin" onclick="margin('+data[i].mt4login+')"><i class="fa fa-briefcase"></i></button> '+
        //                         "</td>");
								// tr.append("<td>" + data[i].mt4login + "</td>");
								// tr.append("<td>" + data[i].lot + "</td>");
								// $('table[id=table-lot] tbody').append(tr);

                                var table = $('#table-lot').DataTable(); 
                                table.row.add([data[i].ACCNO,data[i].name,
'<button title="Info" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalinfo" onclick="vi('+data[i].mt4login+')"><i class="fa fa-info-circle"></i></button> '+'<button title="Open Position" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalopen" onclick="op('+data[i].mt4login+')"><i class="fa fa-list-ol"></i></button> '+'<button title="Close Position" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalclose" onclick="cp('+data[i].mt4login+')"><i class="fa fa-bar-chart"></i></button> '+
'<button title="Margin" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalmargin" onclick="margin('+data[i].mt4login+')"><i class="fa fa-briefcase"></i></button>'
                                ,data[i].mt4login,data[i].lot]).draw();
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
