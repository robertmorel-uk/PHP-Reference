(function($) {
$(document).on( 'click', '.entry-header', function( event ) {
	event.preventDefault();
	$.ajax({
		url: isitceuajaxgetpostsvar.ajax_url,
		type: 'post',
		data: {
			action: 'isitceu_ajax_get_posts',
			query_vars: isitceuajaxgetpostsvar.query_vars,
		},
		success: function( result ) {
			$('.entry-header').html( result );
		}
	})
})
})(jQuery);