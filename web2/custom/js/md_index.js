var Mainpage = function() {

    var handleDropdowns = function() {

        $('body').on('click', '.hold-on-click', function(e) {
            console.log('here click');
            e.stopPropagation();

        });

        $('body').on('shown.bs.dropdown', '.hold-on-click', function(e) {
            console.log('here shown.bs.dropdown');
            e.stopPropagation();

        });

        $('body').on('hide.bs.dropdown', '.hold-on-click', function(e) {
            console.log('here hide.bs.dropdown');
            e.stopPropagation();

        });


    }

    var loadMainMenu = function() {

        $('.mm_menuitem').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            //console.log("md_index.js-31:"+url);
            //alert("md_index.js-31:"+url);
            $.ajax({
                url:  url,
                type: 'GET',
                success: function(response) {
                  $("#main_content").html(response);      
                }
            });
            // var wid = zk.Widget.$(jq("$main_content"));
            // zAu.send(new zk.Event(wid, 'onMenuChange', [url]));
        });
        

    };

    var loadMainContent = function(page) {
        // var wid = zk.Widget.$(jq("$main_content"));
        // zAu.send(new zk.Event(wid, 'onMenuChange', [page]));
    };

    return {
        // main function to initiate the module
        init: function() {
            loadMainMenu();
            handleDropdowns();
            //loadMainContent("dashboard.zul");
        }
    };

}();