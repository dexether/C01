var mall_admin_product_JS = function() {
    //alert("2");
    var handle_1 = function() {}
    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
        },
        get_data: function(data, buttons) {
            $.ajax({
                    url: 'mall_admin_product_do.php?postmode=get',
                    type: 'POST',
                    dataType: 'JSON',
                    data: data,
                })
                .done(function(response) {
                    $('table tbody').html(response.data_html);
                    // console.log(response.token);
                    $('input[name=token]').val(response.token);
                    // console.log($('input[name=token]'))
                })
                .fail(function() {
                    alert('Error while get data, contact Admin')
                })
                .always(function() {
                    $(buttons).button('reset');
                });
        },
        delete: function(id)
        {
          var result = confirm("Apakah anda yakin ?");
          if (result) {
              //Logic to delete the item
              var token = $('input[name=token]').val();
              $.ajax({
                      url: 'mall_admin_product_do.php?postmode=delete',
                      type: 'POST',
                      dataType: 'JSON',
                      data: {'product_id': id, 'token': token},
                  })
                  .done(function(response) {
                      $('input[name=token]').val(response.token);
                      alert('Success Delete product')
                  })
                  .fail(function() {
                      alert('Error while get data, contact Admin')
                  })
                  .always(function() {

                  });
          }
        }
    };
}();
