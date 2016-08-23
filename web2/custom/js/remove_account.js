var remove_account_JS = function() {

    return {
        //main function to initiate the module
        init: function() {
            //alert("Line-79");
            //handle_withdrawal();
		},
		getAccno: function(name) {
			var select = document.getElementById('accno');
			$.ajax({
				url: 'ar_account_remove.php?postmode=getaccno',
				data: {
					name:name
				},
				type: 'POST',
				success: function(response) {
									//console.log(response);
					var accno = JSON.parse(response);
					//console.log(accno);
					select.options.length = 0;
					var opt = document.createElement('option');
					opt.value = '';
					opt.innerHTML = '-- select account number --';
					opt.disabled;
					select.appendChild(opt);
					jQuery.each( accno, function(i, val){
						var opt = document.createElement('option');
						opt.value = val;
						opt.innerHTML = val;
						select.appendChild(opt);
					});
				}
			});
		},
		getUpline: function(accno){
			var select = document.getElementById('upline');
			$.ajax({
				url: 'ar_account_remove.php?postmode=getupline',
				data: {
					accno:accno
				},
				type: 'POST',
				success: function(response) {
					var upline = JSON.parse(response);
					var names = '';
					var accnos = '';
					select.options.length = 0;
					jQuery.each(upline, function(i, val){
						var upline2 = val;
						jQuery.each(upline2, function(k, val){
							//console.log(k+" "+val);
							if(k == 'names'){
								names = val;
								//console.log(names);
							}
							
							if(k == 'accnos'){
								accnos = val;
								//console.log(accnos);
							}
						});
						var opt = document.createElement('option');
						opt.value = accnos;
						opt.innerHTML = names + " (" + accnos + ")";
						select.appendChild(opt);
					});
				}
			});
		},
		doRemove: function(accno,upline){
			swal({
                title: "Are you sure?",
                text: "Do you want to Remove this account "+accno+" ?",
                type: "info",
                confirmButtonText: "Yes, process it!",
                cancelButtonText: "No, cancel!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function() {
                setTimeout(function() {
                    // swal("Success!", "The job have running well.", "success");
                    // Ajax Start
					console.log('Success');
                    $.ajax({
                        url: 'ar_account_remove_do.php?postmode=remove',
                        data: {
                            accno:accno,
							upline:upline
                        },
                        type: 'POST',
                        success: function(response) {
                            // console.log(response)
                            /* $('#main_content').html(response);
                            swal("Success!", "The job have running well.", "success");*/
                            swal("Success!", "The job have running well.", "success");
                        }
                    });
                }, 1000);
            });
        }
	};
}();