<?php 
/*
Basic WordPress Ajax response
Filename: get_posts.php
Use only in plugin or modify for theme
*/
add_action( 'wp_enqueue_scripts', 'isitceu_ajax_get_posts_enqueue_assets' );

function isitceu_ajax_get_posts_enqueue_assets(){

	//handle,plugin url of directory parent, load jquery and load version 1 of script in footer
    wp_enqueue_script( 'isitceu-ajax-get-posts-handle', plugins_url( 'js/get_posts.js', dirname(__FILE__) ), array('jquery'), '1.0', true );

					global $wp_query;
    				//handle, variable and array of values to be used in js file
    				wp_localize_script( 'isitceu-ajax-get-posts-handle', 'isitceuajaxgetpostsvar', array(
    					//this variable can now be used in js to refer to the admin url
						'ajax_url' => admin_url( 'admin-ajax.php' ),
						'query_vars' => json_encode( $wp_query->query )
					));
			}

	//for visitors - format is wp_ajax_norpiv_[action_name] from js ajax call
	add_action( 'wp_ajax_nopriv_isitceu_ajax_get_posts', 'isitceu_ajax_get_posts_func' );
	//for logged in users
	add_action( 'wp_ajax_ajax_isitceu_ajax_get_posts', 'isitceu_ajax_get_posts_func' );

	//echo response to be sent to get_posts.js
	function isitceu_ajax_get_posts_func() {

	    $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );

	    $posts = new WP_Query( $query_vars );
    	$GLOBALS['wp_query'] = $posts;

			while($posts->have_posts()) : $posts->the_post(); ?>


	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php the_content(); ?>
	</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); // reset the query 


	    //always die
	    echo "die";
	    die();
	}