var ar_wallet_JS = function() {
    //alert("2");
    var handle_1 = function() {}
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        cek_balance: function(a) {
            // alert("TEST 01");
            var url = 'mlm_cekbalance.php';
            $.ajax({
                url: url,
                data: {
                    account: a,
                    postmode: 'yes'
                },
                type: 'POST',
                success: function(response) {
                    var res = 'BALANCE USD ' + response;
                    $('#balance').html(res);
                }
            });
        },
        cek_balance2: function(a) {
            // alert("TEST 01");
            var url = 'mlm_cekbalance.php';
            $.ajax({
                url: url,
                data: {
                    to: a,
                    postmode: 'yes2'
                },
                type: 'POST',
                success: function(response) {
                    var res = 'BALANCE USD ' + response;
                    $('#balance2').html(res);
                }
            });
        },
        cek_balance3: function(a) {
            // alert("TEST 01");
            var url = 'mlm_cekbalance.php';
            $.ajax({
                url: url,
                data: {
                    account: a,
                    postmode: 'yes3'
                },
                type: 'POST',
                success: function(response) {
                    var res = 'BALANCE USD ' + response;
                    $('#balance').html(res);
                }
            });
        }
    };
}();