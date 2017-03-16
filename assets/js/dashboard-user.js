$(function() {

    var $sidebar = $("#user-sidebar"),
        $window = $(window),
        offset = $sidebar.offset(),
        topPadding = 100;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        } else {
            $sidebar.stop().animate({
                marginTop: 0
            });
        }
    });

    var $input = $('.datepicker').pickadate({
        format: "yyyy-mm-dd"
    });
});

function showConfirmationModal(invoice) {
    var $modal = $("#danger");
    $('.ajax-invoice-number').html(invoice);
    $('input[name=order_number]').val(invoice);
    $modal.modal('toggle');
}