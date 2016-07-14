var ChangeSession = function() {
    //alert("2");
    var handleSession = function() {

        $('#ubs_followbeli').on('click', function(e) {
            //console.log("6:"+e.preventDefault());
            var row = $('#emasubsbeli').datagrid('getSelected');
            if (row) {
                //alert('Item ID:' + row.counterid + "\nPrice:" + row.sellqty);

                $.ajax({
                    url: 'sessionaction.php?page=ubs_beli',
                    type: 'post',
                    data: {'action': 'follow', 'counterid': row.counterid},
                    success: function(data, status) {
                        //alert('Data=' + data);
                        window.location.href = "mainmenu.php";
                    },
                    error: function(xhr, desc, err) {
                        //console.log("18:"+xhr);
                        //console.log("Details: " + desc + "\nError:" + err);
                    }
                }); // end ajax call
            } else {
                //alert('Anda harus memilih produk terlebih dahulu yang ingin ditransaksikan');
                //bootbox.alert("Hello world!", function() {
                //    Example.show("Hello world callback");
                //});
                bootbox.alert('Anda harus memilih produk terlebih dahulu yang ingin ditransaksikan');
            }

        });

        //http://stackoverflow.com/questions/15917880/form-checkbox-using-ajax-always-showing-on-with-php
        $('#ubs_followjualsekarang').on('click', function(e) {
            //console.log("6:"+e.preventDefault());
            var jumlahrow2 = $("#jumlahrow").val() / 100 - 1;
            //alert('ChangeSession-42-jumlahrow:'+jumlahrow2);

            //var tradecheckvalueid = $('.tradecheckvalueid:checked').serializeArray();
            //var tradecheck2 = $('[name="tradecheckvalueid[]"]').serialize();
            //var fields = $("input").serializeArray();
            //var thedata = $('.tradecheckvalueid:checked').serialize();
            $ary = $('.ids:checked').serializeArray();
            values = jQuery("#tradecheckvalueid").serializeArray();
            //alert('ChangeSession-50:' + $ary);
            //var tradecheckvalueid = $('#tradecheckvalueid input[type=checkbox]:checked').serializeArray();
            if ($ary == '') {
                bootbox.alert('Anda harus men-check minimal satu produk terlebih dahulu yang ingin ditransaksikan');
            } else {
                $.ajax({
                    url: 'sessionaction.php?page=ubs_jual_sekarang',
                    type: 'post',
                    data: {'jumlahrow': jumlahrow2, 'tradecheckvalueid': $ary},
                    success: function(data, status) {
                        //alert('Data=' + data);
                        window.location.href = "mainmenu.php";
                    },
                    error: function(xhr, desc, err) {
                        //console.log("18:"+xhr);
                        //console.log("Details: " + desc + "\nError:" + err);
                    }
                }); // end ajax call
            }
        });

        $('#ubs_followjualtempo').on('click', function(e) {
            //console.log("6:"+e.preventDefault());
            var jumlahrow2 = $("#jumlahrow").val() / 100 - 1;
            //alert('ChangeSession-42-jumlahrow:'+jumlahrow2);

            //var tradecheckvalueid = $('.tradecheckvalueid:checked').serializeArray();
            //var tradecheck2 = $('[name="tradecheckvalueid[]"]').serialize();
            //var fields = $("input").serializeArray();
            //var thedata = $('.tradecheckvalueid:checked').serialize();
            $ary = $('.ids:checked').serializeArray();
            values = jQuery("#tradecheckvalueid").serializeArray();
            //alert('ChangeSession-50:' + $ary);
            //var tradecheckvalueid = $('#tradecheckvalueid input[type=checkbox]:checked').serializeArray();
            if ($ary == '') {
                bootbox.alert('Anda harus men-check minimal satu produk terlebih dahulu yang ingin ditransaksikan');
            } else {
                $.ajax({
                    url: 'sessionaction.php?page=ubs_followjualtempo',
                    type: 'post',
                    data: {'jumlahrow': jumlahrow2, 'tradecheckvalueid': $ary},
                    success: function(data, status) {
                        //alert('Data=' + data);
                        window.location.href = "mainmenu.php";
                    },
                    error: function(xhr, desc, err) {
                        //console.log("18:"+xhr);
                        //console.log("Details: " + desc + "\nError:" + err);
                    }
                }); // end ajax call
            }
        });

        $('#ubs_followrollover').on('click', function(e) {
            //console.log("6:"+e.preventDefault());
            var jumlahrow2 = $("#jumlahrow").val() / 100 - 1;
            //alert('ChangeSession-42-jumlahrow:'+jumlahrow2);

            //var tradecheckvalueid = $('.tradecheckvalueid:checked').serializeArray();
            //var tradecheck2 = $('[name="tradecheckvalueid[]"]').serialize();
            //var fields = $("input").serializeArray();
            //var thedata = $('.tradecheckvalueid:checked').serialize();
            $ary = $('.ids:checked').serializeArray();
            values = jQuery("#tradecheckvalueid").serializeArray();
            //alert('ChangeSession-50:' + $ary);
            //var tradecheckvalueid = $('#tradecheckvalueid input[type=checkbox]:checked').serializeArray();
            if ($ary == '') {
                bootbox.alert('Anda harus men-check minimal satu produk terlebih dahulu yang ingin ditransaksikan');
            } else {
                $.ajax({
                    url: 'sessionaction.php?page=ubs_followrollover',
                    type: 'post',
                    data: {'jumlahrow': jumlahrow2, 'tradecheckvalueid': $ary},
                    success: function(data, status) {
                        //alert('Data=' + data);
                        window.location.href = "mainmenu.php";
                    },
                    error: function(xhr, desc, err) {
                        //console.log("18:"+xhr);
                        //console.log("Details: " + desc + "\nError:" + err);
                    }
                }); // end ajax call
            }
        });


        $('#ubs_serahterima').on('click', function(e) {
            //console.log("6:"+e.preventDefault());
            var jumlahrow2 = $("#jumlahrow").val() / 100 - 1;
            //alert('ChangeSession-42-jumlahrow:'+jumlahrow2);

            //var tradecheckvalueid = $('.tradecheckvalueid:checked').serializeArray();
            //var tradecheck2 = $('[name="tradecheckvalueid[]"]').serialize();
            //var fields = $("input").serializeArray();
            //var thedata = $('.tradecheckvalueid:checked').serialize();
            $ary = $('.ids:checked').serializeArray();
            values = jQuery("#tradecheckvalueid").serializeArray();




            var tradecheckvalueid = $('#tradecheckvalueid input[type=checkbox]:checked').serializeArray();
            if ($ary == '') {
                bootbox.alert('Anda harus men-check minimal satu produk terlebih dahulu yang ingin ditransaksikan');
            } else {
                //alert("ChangeSession-144");
                elts = document.getElementsByName("tradecheckvalueid[]");
                elts_margin = document.getElementsByName("trademargin[]");

                var elts_cnt = (typeof(elts.length) != 'undefined') ? elts.length : 0;
                //alert("ChangeSession-149-Pilihan:" + elts_cnt);
                var serahterima = "no";
                if (elts_cnt)
                {
                    for (var i = 0; i < elts_cnt; i++)
                    {
                        if (elts[i].checked) {
                            var checktradeId = elts[i].value;
                            var checktrademargin1 = elts_margin[i].value;
                            //alert("ChangeSession-158-checktradeId:" + checktradeId + ";Margin:" + checktrademargin1);
                            var checktrademargin = accounting.unformat(checktrademargin1);
                            //alert("ChangeSession-160-checktradeId:" + checktradeId + ";Margin:" + checktrademargin);

                            if (parseFloat(checktrademargin) >= 0) {
                                serahterima = 'yes';
                                //alert("ChangeSession-164-yes");
                            } else {
                                alert("Tradeid " + elts[i].value + " Dana Pembiayaan < 0, tidak bisa serah terima barang");
                                return false;
                            }
                        }
                    }
                    if (serahterima == 'no') {
                        alert("Tidak ada Check Box yang dipilih! Silakan pilih terlebih dahulu yang Dana Pembiayaan = 0");
                        return false;
                    }
                }
                if (serahterima == 'yes') {
                    $.ajax({
                        url: 'sessionaction.php?page=ubs_serahterima',
                        type: 'post',
                        data: {'jumlahrow': jumlahrow2, 'tradecheckvalueid': $ary},
                        success: function(data, status) {
                            //alert('Data=' + data);
                            window.location.href = "mainmenu.php";
                        },
                        error: function(xhr, desc, err) {
                            //console.log("18:"+xhr);
                            //console.log("Details: " + desc + "\nError:" + err);
                        }
                    }); // end ajax call 
                }//if (serahterima == 'yes') {

            }//} else {
        });

    };

    return {
        //main function to initiate the module
        init: function() {
            handleSession();
        }
    };

}();