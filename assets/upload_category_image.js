jQuery(document).ready(function($){
	
	//file
	var uploaderForFile;
	buttonForFile = '#istk_add_on_category_image_upload';
	
	
	$( buttonForFile ).click(function(e) {
		e.preventDefault();
		clickedButton = $(this);
		
		//If the uploader object has already been created, reopen the dialog
		if ( uploaderForFile ) {
			uploaderForFile.open();
			return;
		}
		
		//Extend the wp.media object
		uploaderForFile = wp.media.frames.file_frame = wp.media({
			title: istk_add_on_transrate.chooseFile,
			button: {
				text: istk_add_on_transrate.chooseFile
			},
			multiple: false
		});
		//console.log(uploaderForFile);
		
		//When a file is selected, grab the URL and set it as the text field's value
		uploaderForFile.on( 'select', function() {
			attachment = uploaderForFile.state().get('selection').first().toJSON();
			
			$( '#istk_add_on_category_image_id' ).val( attachment.id );
			$( '#istk_add_on_category_image_thumb' ).html('<img src="' + attachment.url + '">');

		});
		//Open the uploader dialog
		uploaderForFile.open();
	});
	
	
	//delete button
	$( '#istk_add_on_category_image_delete' ).click(function(e) {
		e.preventDefault();
		
		$( '#istk_add_on_category_image_id' ).val( '' );
		$( '#istk_add_on_category_image_thumb' ).html('');
		
	});
	
	
	//保存ボタンが押されたとき
	$( '#addtag .button-primary' ).click( function(e) {
		$( '#istk_add_on_category_image_id' ).val( '' );
		$( '#istk_add_on_category_image_thumb' ).html('');
	});
});