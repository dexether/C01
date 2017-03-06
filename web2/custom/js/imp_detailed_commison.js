var imp_comm_JS = function() {
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
                                console.log(value[i].lots);
                                tr = $('<tr/>');
                                tr.append("<td>" + value[i].LOGIN + "</td>");
                                tr.append("<td>" + value[i].aliases + "</td>");
                                tr.append("<td>" + value[i].periode + "</td>");
                                tr.append("<td>" + parseFloat(value[i].lots).toFixed(2) + "</td>");
                                tr.append("<td>" + imp_comm_JS.changetorp(value[i].lot_amount * value[i].lots) + "</td>");
                                tr.append("<td><button type=button class='btn btn-warning' onClick='imp_comm_JS.register(" + value[i].LOGIN + ",\"" + key + "\")'>Daftarkan</button></td>");
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
            var formDatas = $('#ajax-form').serializeArray();
            // console.log(formDatas);
            var tgl = formDatas[0]['value'];
            if (tgl == 'periode') {
                alert('Pilih Tanggal')
            } else {
                $.ajax({
                    url: 'imp_comm_generator.php?postmode=mlm_temp',
                    data: formDatas,
                    type: 'POST',
                    dataType: 'JSON',
                    error: function() {
                        alert('Error While creating tree');
                    },
                    beforeSend: function() {
                        $(a).button('loading')
                        $('span[class=help-block]').html('Creating New Tree with compression ..');
                        $(".progress-bar").css("width", "10%");
                        $(".progress-bar").attr("aria-valuenow", "10%");
                    },
                    success: function(response) {
                        // progress-msg
                        // change token
                        $('input[name=token]').val(response.token);
                        var uls = $('#progress-msg');
                        uls.append("<li><span class='label label-" + response.status + "'>" + response.title + "</span> " + response.msg + "</li>");
                        $(".progress-bar").css("width", "" + response.progress + "%");
                        $(".progress-bar").attr("aria-valuenow", "" + response.progress + "%");
                        setTimeout(function() {
                            var formDatas2 = $('#ajax-form').serializeArray();
                            $.ajax({
                                url: 'imp_comm_generator.php?postmode=hitung',
                                data: formDatas2,
                                type: 'POST',
                                dataType: 'JSON',
                                error: function() {
                                    alert('Error While Counting Commision');
                                },
                                beforeSend: function() {
                                    $('span[class=help-block]').html('Counting Commision ..');
                                },
                                success: function(res) {
                                    // console.log(response);
                                    $('input[name=token]').val(res.token);
                                    $('span[class=help-block]').html('Finished.');
                                    var uls = $('#progress-msg');
                                    uls.append("<li><span class='label label-" + res.status + "'>" + res.title + "</span> " + res.msg + "</li>");
                                    $(".progress-bar").css("width", "" + res.progress + "%");
                                    $(".progress-bar").attr("aria-valuenow", "" + res.progress + "%");
                                    /*  Wallet Doing */
                                    var formDatas2 = $('#ajax-form').serializeArray();
                                    $.ajax({
                                        url: 'imp_comm_generator.php?postmode=wallet',
                                        data: formDatas2,
                                        type: 'POST',
                                        dataType: 'JSON',
                                        error: function() {
                                            alert('Error While Transfering wallet');
                                        },
                                        beforeSend: function() {
                                            $('span[class=help-block]').html('Transfering to wallet ..');
                                        },
                                        success: function(res) {
                                            // console.log(response);
                                            $('span[class=help-block]').html('Finished.');
                                            var uls = $('#progress-msg');
                                            uls.append("<li><span class='label label-" + res.status + "'>" + res.title + "</span> " + res.msg + "</li>");
                                            $(".progress-bar").css("width", "" + res.progress + "%");
                                            $(".progress-bar").attr("aria-valuenow", "" + res.progress + "%");
                                            $(a).button('reset')
                                        }
                                    });
                                }
                            });
                        }, 2000); // Execute something() 2 second later.
                    }
                });
            }
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
        },
        register: function(login, mt4dt) {
            // alert('register');
            var data_hasil = imp_comm_JS.cek_if_registered(login, mt4dt);
            // console.log(data_hasil[status]);
            $('#myModal').modal('show');
        },
        cek_if_registered: function(login, mt4dt) {
            var res;
            var responses = $.ajax({
                url: 'imp_anony_register_do.php',
                type: 'POST',
                data: {
                    'login': login,
                    'mt4dt': mt4dt
                },
                dataType: 'JSON',
                success: function(response) {
                    imp_comm_JS.show_response(response);
                }
            });
            // console.log(responses.responseJSON);
            return responses;
        },
        show_response: function(json_data) {
            $.ajax({
                url: 'imp_anony_register_view.php',
                type: 'POST',
                data: json_data,
                dataType: 'HTML',
                success: function(response) {
                    // console.log(response);
                    $('#modal-body').html(response);
                }
            });

        },
        save_new: function() {
            var data = $('form[id=form-new]').serializeArray();
            // console.log(data);
            $.ajax({
                url: 'imp_anony_register.php?postmode=save_new',
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success: function(response) {
                    alert(response.msg);
                    $('#myModal').modal('hide');
                }
            });
        },
        save_cabinet_id: function()
        {
          var data = $('form[id=form-id]').serializeArray();
          // console.log(data);
          $.ajax({
              url: 'imp_anony_register.php?postmode=save_cabinet_id',
              type: 'POST',
              dataType: 'JSON',
              data: data,
              success: function(response) {
                  alert(response.msg);
                  $('#myModal').modal('hide');
              }
          });
        }
    };
}();
