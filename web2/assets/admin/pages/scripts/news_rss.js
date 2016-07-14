
var MainRSS = function () {	
	
	var loadNews = function (url) {
		$.ajax({
				url: 'content_rss.php',
				async: false,
				cache: false,
				type: 'GET',
				success: function(response) {		
					$("#news_portlet").html(response);						
				}
		   });
	}
	
	var loadWorldNews = function (url) {
		$.ajax({
				url: url,
				async: false,
				cache: false,
				type: 'GET',
				success: function(response) {		
					$("#worldnews_portlet").html(response);						
				}
		   });
	}
	
	
	
	
    return {
        init: function () {
                    //loadNews();
                    //alert("News_RSS-34");
                    // loadWorldNews('news_rss.php?tr=worldnews_rss.htm&rss=http://www.antaranews.com/rss/ekonomi-moneter');
		},
		initMessage: function () {
			//loadMessage();	
		
		},
		initMainmenu: function () {
			//loadMainmenu();		
		}		

    };

}();