(function($) {

	"use strict";

	// Drag & Drop sorting

	jQuery(function($) {
		$('#sortable-table tbody').sortable({
			axis: 'y',
			handle: '.column-order img',
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			update: function(event, ui) {
				var theOrder = $(this).sortable('toArray');

				var data = {
					action: 'sneek_update_post_order',
					postType: $(this).attr('data-post-type'),
					order: theOrder
				};

				$.post(ajaxurl, data);
			}
		}).disableSelection();

	});

	jQuery(function($) {
		$('#sortable-table-portfolio tbody').sortable({
			axis: 'y',
			handle: '.column-order img',
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			update: function(event, ui) {
				var theOrder = $(this).sortable('toArray');

				var data = {
					action: 'pixtheme_portfolio_update_post_order',
					postType: $(this).attr('data-post-type'),
					order: theOrder
				};

				$.post(ajaxurl, data);
			}
		}).disableSelection();

	});

}(jQuery));