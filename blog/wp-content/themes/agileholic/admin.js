jQuery('#wp-admin-bar-write_to_json > a').on('click', function(event){
	event.preventDefault();
	
	var data = { 'action': 'save_data_to_json' };
	
	jQuery.post(ajaxurl , data, function(response) {
		console.log('Got this from the server: ', response);
	});

});