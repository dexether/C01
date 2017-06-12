$('button').tooltip({
  trigger: 'click',
  placement: 'bottom'
});

function setTooltip(btn, message) {
  $(btn).tooltip('hide')
    .attr('data-original-title', message)
    .tooltip('show');
}

function hideTooltip(btn) {
  setTimeout(function() {
    $(btn).tooltip('hide');
  }, 1000);
}
var clipboard = new Clipboard('.clipboard');
clipboard.on('success', function(e) {
  setTooltip(e.trigger, 'Berhasil menyalin !');
  hideTooltip(e.trigger);
});

clipboard.on('error', function(e) {
  setTooltip(e.trigger, 'Gagal menyalin !');
  hideTooltip(e.trigger);
});
