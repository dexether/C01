var trade_investigation = function() {
    //alert("2");

    var handle_1 = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        education: function(name, email, subject, product, detail) {

            var url = 'investigation_do.php?name=' + name + '&email=' + email + '&subject=' + subject + '&product=' + product + '&detail=' + detail + '&module=education';
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    var res = response.substring(0, 1);
                    if (res == 0) {
                        $('#myModal').modal('show');

                    } else {
                        notifyerror('error', 'top right', 'Error', 'Error on Sending');

                    }
                    // console.log(response)
                }
            });

        },
        apex: function() {

            var url = 'investigation_do.php?module=apex';
            var data = $('#contactForm').serializeArray();
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    
                    var res = response.substring(0, 1);
                    if (res == 0) {
                        $('#myModal').modal('show');

                    } else {
                        notifyerror('error', 'top right', 'Error', 'Error on Sending');

                    }
                    // console.log(response)
                }
            });

        },



        wallet: function(name, email, subject, department, detail) {

            var url = 'investigation_do.php?name=' + name + '&email=' + email + '&subject=' + subject + '&department=' + department + '&detail=' + detail + '&module=wallet';
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    var res = response.substring(0, 1);
                    if (res == 0) {
                        $('#myModal').modal('show');

                    } else {
                        notifyerror('error', 'top right', 'Error', 'Error on Sending');

                    }
                    // console.log(response)
                }
            });

        },
        mlm: function(name, email, accno, subject, types, detail) {


            var url = 'investigation_do.php?name=' + name + '&email=' + email + '&accno=' + accno + '&subject=' + subject + '&types=' + types + '&detail=' + detail + '&module=mlm';
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    var res = response.substring(0, 1);
                    if (res == 0) {
                        $('#myModal').modal('show');

                    } else {
                        notifyerror('error', 'top right', 'Error', 'Error on Sending');

                    }
                    // console.log(response)
                }
            });

        },
        trado: function(name, email, accno, companyname, subject, department, detail) {

            var url = 'investigation_do.php?name=' + name + '&email=' + email + '&accno=' + accno + '&companyname=' + companyname + '&subject=' + subject + '&department=' + department + '&detail=' + detail + '&module=trado';
            var data = '&ajax_validation=1';
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function(response) {
                    var res = response.substring(0, 1);
                    if (res == 0) {
                        $('#myModal').modal('show');

                    } else {
                        notifyerror('error', 'top right', 'Error', 'Error on Sending');

                    }
                    // console.log(response)
                }
            });
        }
    };

}();