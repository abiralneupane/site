jQuery(document).ready(function($){
	var meta_image_frame,btn;

	$('#agileholic-send').on('click',function(){
		jQuery.ajax({  
			type: 'POST',
			url: AGILEHOLIC.ajaxurl,
			data: { action: 'agileholic_collect_data' },
			dataType: 'json',   
			success: function(response){ 
				console.log(JSON.stringify(response) );
			},  
			error: function(MLHttpRequest, textStatus, errorThrown){ console.log(errorThrown); }  
		});
	});

	$('#agileholic_skill_level').on('input',function(){
		$('#range-output').html($(this).val());
		$('#skill-range-output').val($(this).val());
	});

	$('#skill-range-output').on('input',function(){
		$('#agileholic_skill_level').val($(this).val());
	});


	$('.ag-upload-media').on('click',function(e){
		e.preventDefault();
		btn = $(this);
		if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        meta_image_frame = wp.media.frames.meta_image_frame = wp.media();
        meta_image_frame.on('select', function(){
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
            console.log(media_attachment);

            btn.parent().find('.ag-uploaded-media').attr('src',media_attachment.sizes.thumbnail.url).show();
            btn.parent().find('.ag-uploaded-media-id').val(media_attachment.id);
        });
        meta_image_frame.open();
	});

});