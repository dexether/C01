var Treview_JS = function() {
    //alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        accountdetail: function(accno) {
            var url = 'treview_detail.php?accno=' + accno;
            //alert("Line-16-URL:" + url);
            var data = '&ajax_validation=1';         
            if (accno=='COMPANY') {
                alert("Did You Now ? It is an COMPANYS")
            //$('#md-3d-sign').modal('show');
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    $("#main_content").html(response);
                }
            });
            //setTimeout('history.go(0);', 0);
            }
        }
    };

}();