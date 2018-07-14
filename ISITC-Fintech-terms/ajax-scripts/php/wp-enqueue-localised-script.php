<?php
function myplugin_enqueue_scripts() {
	
	/* hand the js for deleting uploads by ajax */
	wp_enqueue_script(
		'myplugin-utilities-ajax',
		plugins_url( '/assets/js/nameofjsfile.js', __FILE__ ),
		array( 'jquery' ),
		'1.0.0',
		true
	);
	
	wp_localize_script(
		'nxtgen-utilities-ajax',
		'myplugin_js', // this is the name that prefixes the ajaxurl in our js file
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		)
	);
	
}
add_action( 'wp_enqueue_scripts', 'myplugin_enqueue_scripts' );
?>