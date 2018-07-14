//on click of agree button
//post the post id to the post_agree_add_agree function on the server
//ajax the response to the page
jQuery( document ).on( 'click', '.agree-button', function() {
    var post_id = jQuery(this).data('id');
    var votes = "";
    var plusorminus = "";
    jQuery.ajax({
        url : postagree.ajax_url,
        type : 'post',
        data : {
            action : 'post_agree_add_agree',
            post_id : post_id
        },
        success : function( response ) {
            jQuery('#agree-count').html( response );

            if ( response == 1 || response == -1 ){ votes = "Vote";} else { votes = "Votes"; }
            if( response > 0 ){ plusorminus = "+"; } else { plusorminus = ""; }

            jQuery("#agree-count").prepend(plusorminus);
            jQuery("#agree-count").append(" "+votes);
        }
    });

    return false;
})

jQuery( document ).on( 'click', '.disagree-button', function() {
    var post_id = jQuery(this).data('id');
    jQuery.ajax({
        url : postdisagree.ajax_url,
        type : 'post',
        data : {
            action : 'post_disagree_add_disagree',
            post_id : post_id
        },
        success : function( response ) {
            jQuery('#agree-count').html( response );

            if ( response == 1 || response == -1 ){ votes = "Vote";} else { votes = "Votes"; }
            if( response > 0 ){ plusorminus = "+"; } else { plusorminus = ""; }

            jQuery("#agree-count").prepend(plusorminus);
            jQuery("#agree-count").append(" "+votes);
            jQuery("#more-info-needed").html(" Please offer a suggestion to improve this definition.");
        }
    });

    return false;
})


