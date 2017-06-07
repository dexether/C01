/*

 */

 $(function() {

  //  $('#myTab a').click(function(e) {
  //     e.preventDefault();
  //     $(this).tab('show');
  //   });

    // store the currently selected tab in the hash value
    $("ul.nav-tab > li > a").on("shown.bs.tab", function(e) {
      var id = $(e.target).attr("href").substr(1);
      window.location.hash = id;
    });

    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');


    $('#rating').barrating({
      theme: 'fontawesome-stars'
    });
 });
