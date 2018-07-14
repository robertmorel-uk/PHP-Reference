/*
Basic WordPress Ajax search request
Filename: ajax_get_search.js
Use only in plugin or modify for theme
*/
(function($) {

var isearch_input = $('#isitceu-ajax-search-input').val();

$(document).on( 'input', '#isitceu-ajax-search-input', function( event ) {
	event.preventDefault();
	$.ajax({
		url: isitceuajaxgetsearchvar.ajax_url,
		type: 'post',
		data: {
			action: 'isitceu_ajax_get_search',
			//query_vars: isitceuajaxgetpostsvar.query_vars,
            igetsearchresults: $('#isitceu-ajax-search-input').val()
		},
		success: function( result ) {
            //alert('k');
			$('#isitceu-ajax-search-results-container').html( result );
		}
	})
})

})(jQuery);