/*
Basic WordPress Ajax request
Filename: get_posts.js
*/

//jQuery(document).ready(function($) {});

//-----------------------------POC implementation
//jQuery wrapper
(function($) {
//anonymous event onclick of specified element
$(document).on( 'click', '.entry-header', function( event ) {
    event.preventDefault();
    //jQuery ajax call
    $.ajax({
        //url obtained from get_posts.php using localization
        url: isitceuajaxgetpostsvar.ajax_url,
        type: 'post',
        data: {
            //action used to call php function in get_posts.php
            action: 'isitceu_ajax_get_posts'
        },
        success: function( result ) {
            //update html with result
            $('.entry-header').html( result );
        }
    })
})
})(jQuery);

//------------------------------MVP implementation

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