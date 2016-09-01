var Cars_JS = function() {
    // alert("2");

    var handle_withdrawal = function() {

    }

    return {
        //main function to initiate the module
        init: function() {
            // alert("Line-79");
            //handle_withdrawal();
        },
        
        view: function(lihat) {
           var url = 'cars.php?lihat=' + lihat;
            var data = '&ajax_validation=1';
			    // console.log(lihat);     
			 
            
			$.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                       // console.log(response)
				$("#main_content").html(response);
				                
                }
            });
        },
		crud1: function(add, accountsearch, downline, branch, used, capacity, desc) {
           var url = 'cars_do.php?addcar=' + add + '&accno=' + accountsearch + '&ACCNO=' + downline + '&branch=' + branch + '&use=' + used + '&capac=' + capacity + '&des=' + desc;
            var data = '&ajax_validation=1';
			   // console.log(add, accountsearch, downline, branch, used, capacity, desc);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                // console.log(response)
                // $("#main_content").html(response);
				    setTimeout('history.go(0);', 1000);
				  
                }
            });
        },
		crud2: function(edit, accountsearch, downline, used, capacity, desc) {
           var url = 'cars_do.php?editcar=' + edit + '&accno=' + accountsearch + '&ACCNO=' + downline + '&use=' + used + '&capac=' + capacity + '&des=' + desc;
            var data = '&ajax_validation=1';
			   // console.log(edit, accountsearch, downline, used, capacity, desc);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                // console.log(response)
                // $("#main_content").html(response);
				    setTimeout('history.go(0);', 1000);
				  
                }
            });
        },
		crud3: function(delet, accountsearch, downline, used, capacity, desc) {
           var url = 'cars_do.php?deletcar=' + delet + '&accno=' + accountsearch + '&ACCNO=' + downline + '&use=' + used + '&capac=' + capacity + '&des=' + desc;
            var data = '&ajax_validation=1';
			   // console.log(delet, accountsearch, downline, used, capacity, desc);     
			 
            
			 $.ajax({
                url: url,
                data:data,
                type: 'POST',
                success: function(response) {
                // console.log(response)
                // $("#main_content").html(response);
				   setTimeout('history.go(0);', 1000);
				  
                }
            });
        },
	};

}();


