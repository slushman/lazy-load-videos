/**
 * Opens the Media Library Chooser
 *
 */
(function( $ ) {

	'use strict';

	$(function() {

		var field, choose, remove, preview;

		field 	= $( '[data-id="url-image"]' );
		preview = $( '#image-preview' );
		remove 	= $( '#remove-image' );
		choose 	= $( '#choose-image' );

		//Opens the Media Library, assigns chosen file URL to input field, switches links
		choose.on( 'click', function( e ) {

			// Stop the anchor's default behavior
			e.preventDefault();

			var file_frame, json;

			if ( undefined !== file_frame ) {

				file_frame.open();
				return;

			}

			file_frame = wp.media.frames.file_frame = wp.media({
				button: {
					text: 'Choose Image',
				},
				frame: 'select',
				multiple: false,
				title: 'Choose Image'
			});

			file_frame.on( 'select', function() {

				json = file_frame.state().get( 'selection' ).first().toJSON();

				if ( 0 > $.trim( json.url.length ) ) {
					return;
				}

				/*
				View all the properties in the console available from the returned JSON object

				for ( var property in json ) {

					console.log( property + ': ' + json[ property ] );

				}*/

				field.val( json.url );
				preview.style.backgroundImage = url( json.url );
				choose.toggleClass( 'hide' );
				remove.toggleClass( 'hide' );

			});

			file_frame.open();

		});

		//Remove value from input, switch links
		remove.on( 'click', function( e ) {

			// Stop the anchor's default behavior
			e.preventDefault();

			// clear the value from the input
			field.val('');

			// Clear the image preview
			preview.style.backgroundImage = url();

			// change the link message
			choose.toggleClass( 'hide' );
			remove.toggleClass( 'hide' );

		});

	});

})( jQuery );
