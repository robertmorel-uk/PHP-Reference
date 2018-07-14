<?php


//----------------------------------------------------------------------------------

				//enqueue scripts and localize script
		add_action( 'wp_enqueue_scripts', 'ajax_hello_enqueue_scripts' );

			function ajax_hello_enqueue_scripts() {
				wp_enqueue_script( 'hello', plugins_url( 'js/hello.js', __FILE__ ), array('jquery'), '1.0', true );
				wp_localize_script( 'hello', 'posthello', array(
					'ajax_url' => admin_url( 'admin-ajax.php' )
				));
			}

		//get the post meta and display
		add_filter( 'the_content', 'post_hello_display', 99 );

			function post_hello_display( $content ) {
				$hello_text = '';
					$hello_text = '<p><a class="hello" href="' 
					. admin_url( 'admin-ajax.php?action=post_hello&post_id=' . get_the_ID() ) . '" data-id="' . get_the_ID() . '"></a>
					<h6>This term has been viewed: <span id="hello-count"></span> times.</h6>'; 	
				return $content . $hello_text;
			}


		add_action( 'wp_ajax_nopriv_post_hello', 'post_hello' );
		add_action( 'wp_ajax_post_hello', 'post_hello' );

			function post_hello() {
				$hello = get_post_meta( $_REQUEST['post_id'], 'post_hello', true );
				$hello++;
				update_post_meta( $_REQUEST['post_id'], 'post_hello', $hello );
				if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
					echo $hello;
					die();
				}
				else {
					wp_redirect( get_permalink( $_REQUEST['post_id'] ) );
					exit();
				}
			}

//---------------------------------------------------------------------------------------

		//enqueue scripts and localize script
		add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts' );
			function ajax_test_enqueue_scripts() {
				wp_enqueue_script( 'agree', plugins_url( '/agree.js', __FILE__ ), array('jquery'), '1.0', true );
				wp_localize_script( 'agree', 'postagree', array(
					'ajax_url' => admin_url( 'admin-ajax.php' )
				));
			}

		//get the post meta and display
		add_filter( 'the_content', 'post_agree_display', 99 );
			function post_agree_display( $content ) {
				$agree_text = '';
				if ( is_singular( 'fintech-glossary' ) ) {
					$agree = get_post_meta( get_the_ID(), 'post_agree', true );
					$agree = ( empty( $agree ) ) ? 0 : $agree;

				  if ( $agree == 1 || $agree == -1 ){ $votes = "Vote";} else { $votes = "Votes"; }
			      if( $agree > 0 ){ $agree = "+ ".$agree; } else { $agree = $agree; } 

					$agree_text = '<h3 id="agree-count">' . $agree .' '.'<span>'. $votes .'</span></h3><p class="agree-received"><a class="agree-button" href="' . admin_url( 'admin-ajax.php?action=post_agree_add_agree&post_id=' . get_the_ID() ) . '" data-id="' . get_the_ID() . '"><button style="float: left; margin: 5px;">Agree</button></a></p>';
				}
				return $content . $agree_text;
			}


		add_action( 'wp_ajax_nopriv_post_agree_add_agree', 'post_agree_add_agree' );
		add_action( 'wp_ajax_post_agree_add_agree', 'post_agree_add_agree' );
			//get agree count for post
			//increment count
			//update database
			function post_agree_add_agree() {
				$agree = get_post_meta( $_REQUEST['post_id'], 'post_agree', true );
				$agree++;
				update_post_meta( $_REQUEST['post_id'], 'post_agree', $agree );
				if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
					echo $agree;
					die();
				}
				else {
					wp_redirect( get_permalink( $_REQUEST['post_id'] ) );
					exit();
				}
			}


//---------------------------------------------------------------------------------------//

		//enqueue scripts and localize script
		add_action( 'wp_enqueue_scripts', 'ajax_disagree_enqueue_scripts' );
			function ajax_disagree_enqueue_scripts() {
				wp_enqueue_script( 'disagree', plugins_url( '/disagree.js', __FILE__ ), array('jquery'), '1.0', true );
				wp_localize_script( 'disagree', 'postdisagree', array(
					'ajax_url' => admin_url( 'admin-ajax.php' )
				));
			}

		//get the post meta and display
		add_filter( 'the_content', 'post_disagree_display', 99 );
			function post_disagree_display( $content ) {
				$disagree_text = '';
				if ( is_singular( 'fintech-glossary' ) ) {

				  if ( $agree == 1 || $agree == -1 ){ $votes = "Vote";} else { $votes = "Votes"; }
			      if( $agree > 0 ){ $agree = "+ ".$agree; } else { $agree = $agree; } 

					$disagree_text = '<p class="disagree-received"><a class="disagree-button" href="' . admin_url( 'admin-ajax.php?action=post_disagree_add_disagree&post_id=' . get_the_ID() ) . '" data-id="' . get_the_ID() . '"><button style="float: left; margin: 5px;">Disagree</button></a><span id="disagree-count"></span></p><br />
					    <h4 id="more-info-needed"></h4>'; 
				}
				return $content . $disagree_text;
			}


		add_action( 'wp_ajax_nopriv_post_disagree_add_disagree', 'post_disagree_add_disagree' );
		add_action( 'wp_ajax_post_disagree_add_disagree', 'post_disagree_add_disagree' );
			//get agree count for post
			//increment count
			//update database
			function post_disagree_add_disagree() {
				$agree = get_post_meta( $_REQUEST['post_id'], 'post_agree', true );
				$agree--;
				update_post_meta( $_REQUEST['post_id'], 'post_agree', $agree );
				if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
					echo $agree;
					die();
				}
				else {
					wp_redirect( get_permalink( $_REQUEST['post_id'] ) );
					exit();
				}
			}

//---------------------------------------------------------------------------------------//