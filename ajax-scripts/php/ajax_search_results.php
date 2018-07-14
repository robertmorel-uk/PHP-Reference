<?php 
/*
Basic WordPress Ajax search response
Filename: ajax_get_search.php
Use only in plugin or modify for theme
*/
add_action( 'wp_enqueue_scripts', 'isitceu_ajax_get_posts_enqueue_assets' );

function isitceu_ajax_get_posts_enqueue_assets(){

    wp_enqueue_script( 'isitceu-ajax-get-search-handle', plugins_url( 'js/ajax_search_results.js', dirname(__FILE__) ), array('jquery'), '1.0', true );

					global $wp_query;
    				wp_localize_script( 'isitceu-ajax-get-search-handle', 'isitceuajaxgetsearchvar', array(
						'ajax_url' => admin_url( 'admin-ajax.php' )
					));
			}

	add_action( 'wp_ajax_nopriv_isitceu_ajax_get_search', 'isearch_func' );
	add_action( 'wp_ajax_ajax_i_isitceu_ajax_get_search', 'isearch_func' );

	function isearch_func() {

		$posts = new WP_Query( array(
		    'post_type' => 'fintech-glossary',
		    'posts_per_page' => 12,
		    'orderby'=> 'post_date',
		    's'=> esc_attr( $_POST['igetsearchresults'] )
));

		while($posts->have_posts()) : $posts->the_post(); ?>

				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<?php the_content(); ?>
				</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata();

		die();
	}

	function isitceu_ajax_display_search_form( $content ) {

		$isitceu_search_form = '';
		$isitceu_search_form ='
		  <div id="isitceu-ajax-search-form-container">
		  Search:<br>
		  <input type="text" name="isitceu-ajax-search-input" id="isitceu-ajax-search-input">
		  <br>
		  <input type="button" value="Search" id="isitceu-ajax-search_button">
		  </div>
		  <div id="isitceu-ajax-search-results-container">
		  Nothing to see here!
		  </div>';

		  return $content . $isitceu_search_form;
	}

	add_filter( 'the_content', 'isitceu_ajax_display_search_form', 99 );