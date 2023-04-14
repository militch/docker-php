jQuery(function($){

	// Demo Content.
	if ( $('#thb-adm-popup').length ) {
		// Thb Admin Popup
		var thb_adm_p_vars = {
			popup: $('#thb-adm-popup'),
			close: $('.thb-popup-close'),
			btn: $('.import-opts-btn')
		};

		thb_adm_p_vars.close.on('click', function() {
			$(this).closest(thb_adm_p_vars.popup).removeClass('opvis');
		});
		$(document).on('keyup', function(e) {
			if (e.keyCode === 27) {
				if (thb_adm_p_vars.popup.hasClass('opvis')) {
					thb_adm_p_vars.close.trigger('click');
				}
			}
		});
		$('.thb-check-line [type=checkbox]').on('change', function() {
			var t = $(this);
			t.toggleClass('thb-checked');
			if (t.attr('id') === 'ty-contents') {
				if (!t.hasClass('child-opened')) {
					t.addClass('child-opened').parent().next().addClass('done');
				} else {
					t.removeClass('child-opened').parent().next().removeClass('done');
				}
			}
		});

		// Open Import Popup
		thb_adm_p_vars.btn.on('click', function() {
			var t = $(this),
					selected = t.data('demo');
			thb_adm_p_vars.popup.find('.button').data('selected', selected);
			thb_adm_p_vars.popup.find('figure img').attr('src', t.closest('.theme').find('img').attr('src'));
			thb_adm_p_vars.popup.find('[type=checkbox]');
			thb_adm_p_vars.popup.addClass('opvis');
		});

		// Demo Content Import
		var thb_data = new FormData(),
				thb_once = false;

		if (typeof ocdi !== 'undefined') {
			thb_data.append( 'action', 'ocdi_import_demo_data' );
			thb_data.append( 'security', ocdi.ajax_nonce );
		}
		/* jshint ignore:start */
		function thb_ajaxCall(thb_data) {

			// AJAX call.
			$.ajax({
				method:     'POST',
				url:        ocdi.ajax_url,
				data:       thb_data,
				contentType: false,
				processData: false
			})
			.done( function( response ) {
				if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
					thb_ajaxCall( thb_data );
				} else if ( 'undefined' !== typeof response.status && 'customizerAJAX' === response.status ) {
					var newData = new FormData();
					newData.append( 'action', 'ocdi_import_customizer_data' );
					newData.append( 'security', ocdi.ajax_nonce );
					if ( true === ocdi.wp_customize_on ) {
						newData.append( 'wp_customize', 'on' );
					}
					thb_ajaxCall( newData );
				} else if ( 'undefined' !== typeof response.status && 'afterAllImportAJAX' === response.status ) {
					// Fix for data.set and data.delete, which they are not supported in some browsers.
					var newData = new FormData();
					newData.append( 'action', 'ocdi_after_import_data' );
					newData.append( 'security', ocdi.ajax_nonce );
					thb_ajaxCall( newData );
				} else {
					var url = window.location.href.split('?')[0];
					window.location.href = url + '?page=thb-product-registration&success=1';
				}
			});
		}


		// Import Form Submit
		thb_adm_p_vars.popup.find('form').on('submit', function(e) {
			e.preventDefault();
			var t = $(this),
				demo = t.find('.button').data('selected');

			thb_adm_p_vars.popup.find('form').addClass('thb-loading');
			t.closest('.thb-popup-box').find('.thb-import-loading').addClass('opvis');
			t.children('[type=submit]').addClass('disabled').attr('disabled', 'disabled').unbind('click');

			thb_data.append( 'selected', demo );
			thb_data.append( 'thb_import_options', t.serialize());

			thb_ajaxCall(thb_data);
		});
		/* jshint ignore:end */
	}

});