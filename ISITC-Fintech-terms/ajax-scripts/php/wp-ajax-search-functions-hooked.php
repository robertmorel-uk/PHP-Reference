<?php
function myplugin_ajax_job_search() {
	
	/* get the search terms entered into the search box */
	$search = sanitize_text_field( $_POST[ 'search' ] );
	
	/* run a new query including the search string */
	$q = new WP_Query(
		array(
			'post_type'			=> job_post_type_name,
			'posts_per_page'	=> 8,
			's'					=> $search
		)
	);
	
	/* store all returned output in here */
	$output = '';
	
	/* check whether any search results are found */
	if( $q->have_posts() ) {
		
		/* loop through each result */
		while( $q->have_posts() ) : $q->the_post();
		
			/* add result and link to post to output */
			echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a><br />';
		
		/* end loop */
		endwhile;
	
	/* no search results found */	
	} else {
		
		/* add no results message to output */
		echo 'error';
		
	} // end if have posts
	
	/* reset query */
	wp_reset_query();
	
	die();
	
}
add_action( 'wp_ajax_myplugin_ajax_search_jobs', 'myplugin_ajax_job_search' );
add_action( 'wp_ajax_nopriv_myplugin_ajax_search_jobs', 'myplugin_ajax_job_search' );