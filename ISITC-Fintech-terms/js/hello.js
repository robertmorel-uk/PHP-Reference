jQuery(document).ready(function($) {
//jQuery( document ).on( 'click', '.hello', function() {
    var post_id = jQuery(".hello").data('id');
    jQuery.ajax({
        url : posthello.ajax_url,
        type : 'post',
        data : {
            action : 'post_hello',
            post_id : post_id
        },
        success : function( response ) {
            jQuery("#hello-count").html( response );
        }
    });

    return false;
})