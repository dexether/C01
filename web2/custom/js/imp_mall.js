var imp_mall_JS = function() {
    //alert("2");
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        approved: function(id, thisnya) {
            $(thisnya).button('loading');
            // $(this).closest('tr').remove();
            var token = $('input[name=token]').val();
            $.ajax({
                url: 'imp_mall_do.php?postmode=agree',
                type: 'POST',
                dataType: 'json',
                data: {
                    token: token,
                    'id': id
                },
            }).success(function(response) {
                // console.log(response)
                $(thisnya).button('reset');
                swal(response.title, response.msg, response.status);
                $('input[name=token]').val(response.token);
                $('#myModal').modal('toggle');
                $(thisnya).closest('tr').remove();
                $('button[id=' + id + ']').closest('tr').remove()
            }).done(function() {}).fail(function() {
                // swal('Oops, We Found An error', 'Contact the administrator', 'error');
            }).always(function() {});
        },
        reject: function(id, thisnya) {
            // $(this).closest('tr').remove();
            $(thisnya).button('loading');
            var token = $('input[name=token]').val();
            $.ajax({
                url: 'imp_mall_do.php?postmode=reject',
                type: 'POST',
                dataType: 'json',
                data: {
                    token: token,
                    'id': id
                },
            }).success(function(response) {
                // console.log(response)
                $(thisnya).button('reset');
                swal(response.title, response.msg, response.status);
                $('input[name=token]').val(response.token);
                $('#myModal').modal('toggle');
                $(thisnya).closest('tr').remove();
                $('button[id=' + id + ']').closest('tr').remove()
            }).done(function() {}).fail(function() {
                swal('Oops, We Found An error', 'Contact the administrator', 'error');
            }).always(function() {});
        },
        view_data: function(id) {
            var token = $('input[name=token]').val();
            // Ajax Here
            $.ajax({
                url: 'imp_mall_do.php?postmode=view_data',
                type: 'POST',
                dataType: 'json',
                data: {
                    token: token,
                    'id': id
                },
            }).success(function(response) {
                // console.log(response)
                // swal(response.title, response.msg, response.status);
                $('p[id=name]').html(response.get_data.name);
                console.log(response.get_data)
                $('p[id=email]').html(response.get_data.email);
                $('#myModalLabel').html(response.get_data.prod_alias);
                $('#aidi').val(response.get_data.id);
                $('p[id=telphone_number]').html(response.get_data.telephone_mobile);
                $('input[name=token]').val(response.token);
            }).done(function() {}).fail(function() {
                // swal('Oops, We Found An error', 'Contact the administrator', 'error');
            }).always(function() {});
        }
    };
}();