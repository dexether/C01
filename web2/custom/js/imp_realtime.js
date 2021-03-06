var imp_realtime_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        get_data: function(a) {
            var data = $('#ajax-form').serializeArray()
            var bulan = $('select[name=bulan]');
            var bulannya = bulan.find('option[value=' + bulan.val() + ']').html();
            var tahun = $('select[name=tahun]').val();
            // console.log(tahun)
            $.ajax({
                url: 'imp_detailed_report_do.php?postmode=show',
                data: data,
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    $(a).button('loading');
                    // console.log(a);
                    $('table[id=table-komisi] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                    $('table[id=table-komisi-group] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                    $('table[id=table-anony] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                },
                success: function(response) {
                    var quick = response.quick;
                    var anony = response.anonymouse;
                    var response = response.detailed;
                    $('table tbody').html('');
                    // console.log(response.length)
                    $(a).button('reset');
                    var tr;
                    var total = 0;
                    if (response.length > 0) {
                        // quick
                        for (var i = 0; i < quick.length; i++) {
                            var typenya = quick[i].typeaccount;
                            if (typenya == 'agent') {
                                var keangotaan = 'Agen';
                            } else {
                                var keangotaan = 'Nasabah';
                            }
                            tr = $('<tr/>');
                            tr.append("<td>" + quick[i].ACCNO + "</td>");
                            tr.append("<td>" + quick[i].name + "</td>");
                            tr.append("<td>" + keangotaan + "</td>");
                            tr.append("<td>" + imp_comm_JS.changetorp(quick[i].subtotal) + "</td>");
                            $('table[id=table-komisi-group] tbody').append(tr);
                        }
                        for (var i = 0; i < response.length; i++) {
                            var uang = imp_comm_JS.changetorp(response[i].amount);
                            var jumlah = parseInt(response[i].amount, 10);
                            // console.log(jumlah)
                            var typenya = response[i].typeaccount;
                            if (typenya == 'agent') {
                                var keangotaan = 'Agen';
                            } else {
                                var keangotaan = 'Nasabah';
                            }
                            tr = $('<tr/>');
                            tr.append("<td>" + response[i].ACCNO + "</td>");
                            tr.append("<td>" + response[i].name + "</td>");
                            tr.append("<td>" + response[i].nama2 + "</td>");
                            tr.append("<td>" + keangotaan + "</td>");
                            tr.append("<td>" + response[i].level + "</td>");
                            tr.append("<td>" + response[i].lot + "</td>");
                            tr.append("<td>" + uang + "</td>");
                            $('table[id=table-komisi] tbody').append(tr);
                            total = total + jumlah;
                            // console.log(tr);
                        }
                        var subtotal = imp_comm_JS.changetorp(total);
                        $.each(anony, function(key, value) {
                            for (var i = 0; i < value.length; i++) {
                                tr = $('<tr/>');
                                tr.append("<td>" + value[i].LOGIN + "</td>");
                                tr.append("<td>" + value[i].aliases + "</td>");
                                tr.append("<td>" + value[i].periode + "</td>");
                                tr.append("<td>" + parseFloat(value[i].lots).toFixed(2) + "</td>");
                                tr.append("<td>" + imp_comm_JS.changetorp(value[i].lot_amount * value[i].lots) + "</td>");
                                $('table[id=table-anony] tbody').append(tr);
                            }
                        });
                        // console.log(total)
                        tr = $('<tr/>');
                        tr.append("<td colspan=6 class=text-center><strong>T O T A L </strong></td>");
                        tr.append("<td><strong>" + subtotal + "</strong></td>");
                        $('table[id=table-komisi] tbody').append(tr);
                    } else {
                        tr = $('<tr/>');
                        tr.append("<td colspan=8 class=text-center> Tidak ada komisi untuk bulan ini </td>");
                        $('table tbody').append(tr);
                    }
                    $('span[class=help-block]').html('Laporan Komisi pada bulan ' + bulannya + ' ' + tahun)
                },
                error: function() {
                    alert('Error, Please call publisher');
                    $(a).button('reset');
                }
            });
        },
        changetorp: function(angka) {
            var rev = parseInt(angka, 10).toString().split('').reverse().join('');
            var rev2 = '';
            for (var i = 0; i < rev.length; i++) {
                rev2 += rev[i];
                if ((i + 1) % 3 === 0 && i !== (rev.length - 1)) {
                    rev2 += '.';
                }
            }
            return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
        },
        generate: function(a) {
            // console.log(a)
            var data = $('#ajax-form').serializeArray();
            $.ajax({
                url: 'imp_client_comm_realtime_do.php?postmode=tmp',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    // console.log(response)
                    $('input[name=token]').val(response.token);
                    imp_realtime_JS.compress(response);
                },
                beforeSend: function() {
                    $(a).button('loading');
                    $('table[id=table-komisi] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                    $('table[id=table-komisi-group] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                    $('table[id=table-anony] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                },
                error: function() {
                    alert('Erorr')
                },
                complete: function() {}
            });
        },
        generate_admin: function(a) {
            // console.log(a)
            var data = $('#ajax-form').serializeArray();
            $.ajax({
                url: 'imp_admin_comm_realtime_do.php?postmode=tmp',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    // console.log(response)
                    $('input[name=token]').val(response.token);
                    imp_realtime_JS.compress_admin(response);
                },
                beforeSend: function() {
                    $(a).button('loading');
                    $('table[id=table-komisi] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                    $('table[id=table-komisi-group] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                    $('table[id=table-anony] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                },
                error: function() {
                    alert('Erorr')
                },
                complete: function() {}
            });
        },
        compress: function(data) {
            $.ajax({
                url: 'imp_client_comm_realtime_do.php?postmode=tree',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    // console.log(response)
                    $('input[name=token]').val(response.token);
                    imp_realtime_JS.comm(response);
                },
                beforeSend: function() {},
                error: function() {
                    alert('Erorr')
                },
                complete: function() {}
            });
        },
        compress_admin: function(data) {
            $.ajax({
                url: 'imp_admin_comm_realtime_do.php?postmode=tree',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    // console.log(response)
                    $('input[name=token]').val(response.token);
                    imp_realtime_JS.comm_admin(response);
                },
                beforeSend: function() {},
                error: function() {
                    alert('Erorr')
                },
                complete: function() {}
            });
        },
        ambil_data: function(data) {
            $.ajax({
                url: 'imp_client_comm_realtime_do.php?postmode=get_data',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    // console.log(response)
                    $('table tbody').html('');
                    $('input[name=token]').val(response.token);
                    // imp_realtime_JS.comm(response);
                    /* To Table  */
                    if (response.detailed.length > 0) {
                        /* Quick */
                        for (var i = 0; i < response.quick.length; i++) {
                            var typenya = response.quick[i].typeaccount;
                            if (typenya == 'agent') {
                                var keangotaan = 'Agen';
                            } else {
                                var keangotaan = 'Nasabah';
                            }
                            tr = $('<tr/>');
                            tr.append("<td>" + response.quick[i].ACCNO + "</td>");
                            tr.append("<td>" + response.quick[i].name + "</td>");
                            tr.append("<td>" + keangotaan + "</td>");
                            tr.append("<td>" + imp_realtime_JS.changetorp(response.quick[i].subtotal) + "</td>");
                            $('table[id=table-komisi-group] tbody').append(tr);
                        }
                        /* End Quick */
                        for (var i = 0; i < response.detailed.length; i++) {
                            var uang = imp_realtime_JS.changetorp(response.detailed[i].amount);
                            var jumlah = parseInt(response.detailed[i].amount, 10);
                            // console.log(jumlah)
                            var typenya = response.detailed[i].typeaccount;
                            if (typenya == 'agent') {
                                var keangotaan = 'Agen';
                            } else {
                                var keangotaan = 'Nasabah';
                            }
                            tr = $('<tr/>');
                            tr.append("<td>" + response.detailed[i].ACCNO + "</td>");
                            tr.append("<td>" + response.detailed[i].name + "</td>");
                            tr.append("<td>" + response.detailed[i].nama2 + "</td>");
                            tr.append("<td>" + keangotaan + "</td>");
                            tr.append("<td>" + response.detailed[i].level + "</td>");
                            tr.append("<td>" + response.detailed[i].lot + "</td>");
                            tr.append("<td>" + uang + "</td>");
                            $('table[id=table-komisi] tbody').append(tr);
                        }
                    } else {
                        tr = $('<tr/>');
                        tr.append("<td colspan=8 class=text-center> Tidak ada komisi untuk bulan ini </td>");
                        $('table tbody').append(tr);
                    }
                },
                beforeSend: function() {},
                error: function() {
                    alert('Erorr')
                },
                complete: function() {
                    $('#ajax-button').button('reset');
                }
            });
        },
        ambil_data_admin: function(data) {
            $.ajax({
                url: 'imp_admin_comm_realtime_do.php?postmode=get_data',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    // console.log(response)
                    $('table tbody').html('');
                    $('input[name=token]').val(response.token);
                    // imp_realtime_JS.comm(response);
                    /* To Table  */
                    if (response.detailed.length > 0) {
                        /* Quick */
                        for (var i = 0; i < response.quick.length; i++) {
                            var typenya = response.quick[i].typeaccount;
                            if (typenya == 'agent') {
                                var keangotaan = 'Agen';
                            } else {
                                var keangotaan = 'Nasabah';
                            }
                            tr = $('<tr/>');
                            tr.append("<td>" + response.quick[i].ACCNO + "</td>");
                            tr.append("<td>" + response.quick[i].name + "</td>");
                            tr.append("<td>" + keangotaan + "</td>");
                            tr.append("<td>" + imp_realtime_JS.changetorp(response.quick[i].subtotal) + "</td>");
                            $('table[id=table-komisi-group] tbody').append(tr);
                        }
                        /* End Quick */
                        for (var i = 0; i < response.detailed.length; i++) {
                            var uang = imp_realtime_JS.changetorp(response.detailed[i].amount);
                            var jumlah = parseInt(response.detailed[i].amount, 10);
                            // console.log(jumlah)
                            var typenya = response.detailed[i].typeaccount;
                            if (typenya == 'agent') {
                                var keangotaan = 'Agen';
                            } else {
                                var keangotaan = 'Nasabah';
                            }
                            tr = $('<tr/>');
                            tr.append("<td>" + response.detailed[i].ACCNO + "</td>");
                            tr.append("<td>" + response.detailed[i].name + "</td>");
                            tr.append("<td>" + response.detailed[i].nama2 + "</td>");
                            tr.append("<td>" + keangotaan + "</td>");
                            tr.append("<td>" + response.detailed[i].level + "</td>");
                            tr.append("<td>" + response.detailed[i].lot + "</td>");
                            tr.append("<td>" + uang + "</td>");
                            $('table[id=table-komisi] tbody').append(tr);
                        }
                    } else {
                        tr = $('<tr/>');
                        tr.append("<td colspan=8 class=text-center> Tidak ada komisi untuk bulan ini </td>");
                        $('table tbody').append(tr);
                    }
                },
                beforeSend: function() {},
                error: function() {
                    alert('Erorr')
                },
                complete: function() {
                    $('#ajax-button').button('reset');
                }
            });
        },
        comm: function(data) {
            $.ajax({
                url: 'imp_client_comm_realtime_do.php?postmode=comm',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    // console.log(response)
                    $('input[name=token]').val(response.token);
                    imp_realtime_JS.ambil_data(response);
                },
                beforeSend: function() {},
                error: function() {
                    alert('Erorr')
                },
                complete: function() {}
            });
        },
        comm_admin: function(data) {
            $.ajax({
                url: 'imp_admin_comm_realtime_do.php?postmode=comm',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    // console.log(response)
                    $('input[name=token]').val(response.token);
                    imp_realtime_JS.ambil_data_admin(response);
                },
                beforeSend: function() {},
                error: function() {
                    alert('Erorr')
                },
                complete: function() {}
            });
        },
        get_data_client: function(a) {
            $(a).button('loading');
            var formData = $('#ajax-form').serializeArray();
            $.ajax({
                url: 'imp_detailed_report_do.php?postmode=client',
                data: formData,
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    $(a).button('loading');
                    // console.log(a);
                    $('table[id=table-komisi] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                    $('table[id=table-komisi-group] tbody').html('<td colspan="8"><img height="50" src="images/loading/cari.svg" class="center-block" align="center" class="img-responsive"></td>');
                },
                success: function(response) {
                    var quick = response.quick;
                    var response = response.detailed;
                    $('table tbody').html('');
                    // console.log(response.length)
                    $(a).button('reset');
                    var tr;
                    var number = 1,
                        number2 = 1,
                        total = 0;
                    if (response.length > 0) {
                        // quick
                        for (var i = 0; i < quick.length; i++) {
                            var typenya = response[i].typeaccount;
                            if (typenya == 'agent') {
                                var keangotaan = 'Agen';
                            } else {
                                var keangotaan = 'Nasabah';
                            }
                            tr = $('<tr/>');
                            tr.append("<td>" + quick[i].ACCNO + "</td>");
                            tr.append("<td>" + quick[i].name + "</td>");
                            tr.append("<td>" + keangotaan + "</td>");
                            tr.append("<td>" + imp_comm_JS.changetorp(quick[i].subtotal) + "</td>");
                            $('table[id=table-komisi-group] tbody').append(tr);
                            number2++
                        }
                        for (var i = 0; i < response.length; i++) {
                            var uang = imp_comm_JS.changetorp(response[i].amount);
                            var jumlah = parseInt(response[i].amount, 10);
                            // console.log(jumlah)
                            var typenya = response[i].typeaccount;
                            if (typenya == 'agent') {
                                var keangotaan = 'Agen';
                            } else {
                                var keangotaan = 'Nasabah';
                            }
                            tr = $('<tr/>');
                            tr.append("<td>" + response[i].ACCNO + "</td>");
                            tr.append("<td>" + response[i].name + "</td>");
                            tr.append("<td>" + response[i].nama2 + "</td>");
                            tr.append("<td>" + keangotaan + "</td>");
                            tr.append("<td>" + response[i].level + "</td>");
                            tr.append("<td>" + response[i].lot + "</td>");
                            tr.append("<td>" + uang + "</td>");
                            $('table[id=table-komisi] tbody').append(tr);
                            total = total + jumlah;
                            number++;
                            // console.log(tr);
                        }
                        var subtotal = imp_comm_JS.changetorp(total);
                        // console.log(total)
                        tr = $('<tr/>');
                        tr.append("<td colspan=6 class=text-center><strong>T O T A L </strong></td>");
                        tr.append("<td><strong>" + subtotal + "</strong></td>");
                        $('table[id=table-komisi] tbody').append(tr);
                    } else {
                        tr = $('<tr/>');
                        tr.append("<td colspan=8 class=text-center> Tidak ada komisi untuk bulan ini </td>");
                        $('table tbody').append(tr);
                    }
                }
            });
        }
    };
}();