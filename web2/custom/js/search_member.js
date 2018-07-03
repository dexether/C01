var search_member_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        search: function(a) {
            var data = $('#ajax-form').serializeArray()
            // console.log(tahun)
            $.ajax({
                url: 'search_member.php?postmode=search',
                data: data,
                type: 'POST',
                beforeSend: function() {
                    $(a).button('loading');
                    // console.log(a);
                    $('table[id=table-search] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                },
                success: function(response) {
                    $('table tbody').html('');
					$(a).button('reset');
					var data = JSON.parse(response);
                    if (data.length > 0) {
                        // quick
                        for (var i = 0; i < data.length; i++) {
								tr = $('<tr/>');
								tr.append("<td>" + data[i].name + "</td>");
								tr.append("<td>" + data[i].aecode + "</td>");
								tr.append("<td>" + data[i].accountname + "</td>");
								tr.append("<td>" + data[i].role + "</td>");
								tr.append("<td>" + data[i].phone + "</td>");
								tr.append("<td>" + data[i].created_at + "</td>");
								$('table[id=table-search] tbody').append(tr);
                        }
                    } else {
                        tr = $('<tr/>');
                        tr.append("<td colspan=8 class=text-center> Member tidak ditemukan</td>");
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
