<?php
/*
   Plugin Name: ISITC Fintech Glossary
   Plugin URI : -
   Description: Fintech Glossary
   Version    : 1.0
   Author     : Robert Morel
   Author URI: https://amarria.com/
   License: GPLv2 or later
   Text Domain: ISITC_fintech_glossary
 
 */
 

/*
class, methods and functions in this file are common to all plugins and
handle basic requirements 
 */


// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// if the class does not exist
if( !class_exists( 'ISITC_fintech_glossary_boilerplate' ) ) {
    
    //main class of plugin
    class ISITC_fintech_glossary_boilerplate{

        //static function and private instance vaiables ensure only one instance of plugin class created
    
        //define variable to hold instance of class
        //variable is private to the class
        //static variables have a single value for all instances of a class
        private static $instance;
        //Use instance function to generate a public static object from class
        public static function instance() {

    /*
    Use $this to refer to the current object. Use self to refer to the current class. In other words, use  $this->member for non-static members, use self::$member for static members.
    */
            //restricts the instantiation of the  class to one object (singleton pattern)
            //only execute code if object does not already exist
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ISITC_fintech_glossary_boilerplate ) ) {
                //create new object of class and assign to instance variable
                self::$instance = new ISITC_fintech_glossary_boilerplate();
                //add methods to object
                //setup constants defines constants of the plugin. eg: plugin path, directory,uri
                self::$instance->ISITC_fintech_glossary_setup_constants();
                //includes functions.php
                self::$instance->ISITC_fintech_glossary_includes();
                //include ajax
                self::$instance->ISITC_fintech_glossary_includes_ajax();
                //load all plugin specific scripts for back end
                add_action( 'admin_enqueue_scripts',array(self::$instance,'ISITC_fintech_glossary_load_admin_scripts'),9);
                //load all plugin specific scripts for front end
                add_action( 'wp_enqueue_scripts',array(self::$instance,'ISITC_fintech_glossary_load_scripts'),9);
                //initialize custom post type creation code
                add_action( 'init', array(self::$instance,'ISITC_fintech_glossary_boiler_plate_cpt'));
                //plugin specific archive template
                add_filter( 'archive_template', array(self::$instance,'fintech_terms_archive_template' ));
                //plugin specific single template
                add_filter( 'single_template', array(self::$instance,'fintech_terms_single_template' ));
                
            }

            //return the newly created object
            return self::$instance;
        }

        public function ISITC_fintech_glossary_setup_constants() { 

            if ( ! defined( 'ISITC_fintech_glossary_VERSION' ) ) {
                define( 'ISITC_fintech_glossary_VERSION', '1.0' );
            }

            if ( ! defined( 'ISITC_fintech_glossary_PLUGIN_DIR' ) ) {
                define( 'ISITC_fintech_glossary_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
            }

            if ( ! defined( 'ISITC_fintech_glossary_PLUGIN_URL' ) ) {
                define( 'ISITC_fintech_glossary_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
            }

        }
        
        public function ISITC_fintech_glossary_load_scripts(){

            wp_enqueue_script( 'jquery' );
            wp_register_script( 'ISITC_fintech_glossary-scripts', plugins_url( 'js/ISITC_fintech_glossary_scripts.js', __FILE__ ), array('jquery'), '1.0', TRUE );
            wp_enqueue_script( 'ISITC_fintech_glossary-scripts' );

            wp_register_style( 'ISITC_fintech_glossary-styles-css', plugins_url( 'css/ISITC_fintech_glossary_styles.css', __FILE__ ) );
            wp_enqueue_style( 'ISITC_fintech_glossary-styles-css' );

            //config array used to pass php variables to javascript
            $config_array = array(
                    'ajax_url' => admin_url( 'admin-ajax.php' ),
                    'ajax_nonce' => wp_create_nonce( 'ques-nonce' )
            );

            //function to pass php variables in to script files(handle,,variable name used in script,configuration array with values)
            wp_localize_script( 'isitcfintechglossaryconf', 'isitcfintechglossaryconf', $config_array );

            
            
        }
        
        public function ISITC_fintech_glossary_load_admin_scripts(){
            
        }
        
        private function ISITC_fintech_glossary_includes() {
            
            require_once ISITC_fintech_glossary_PLUGIN_DIR . 'ISITC_fintech_glossary_functions.php';
            
        }

        private function ISITC_fintech_glossary_includes_ajax() {
            
            //require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax-scripts/php/get_posts.php';
            require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax-scripts/php/ajax_search_results.php';
            //require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax/ajax-function.php';
            //require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax/button-ajax.php';
            //require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax/button.php';
            //require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax/enqueue.php';
            //require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax/fallback.php';
            //require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax/has_clicked.php';
            //require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax/search-action.php';
            //require ISITC_fintech_glossary_PLUGIN_DIR . 'ajax/set-meta.php';
            
        }

        //configure language settings
        public function ISITC_fintech_glossary_load_textdomain() {
            
        }

        //custom post type labels


        // Register Custom Post Type
        public function ISITC_fintech_glossary_boiler_plate_cpt() {

            $labels = array(
                'name'                  => _x( 'Fintech Glossary', 'Post Type General Name', 'ISITC_fintech_glossary' ),
                'singular_name'         => _x( 'Fintech terms', 'Post Type Singular Name', 'ISITC_fintech_glossary' ),
                'menu_name'             => __( 'Fintech terms', 'ISITC_fintech_glossary' ),
                'name_admin_bar'        => __( 'Fintech terms', 'ISITC_fintech_glossary' ),
                'archives'              => __( 'Fintech terms Archives', 'ISITC_fintech_glossary' ),
                'attributes'            => __( 'Item Attributes', 'ISITC_fintech_glossary' ),
                'parent_item_colon'     => __( 'Parent Item:', 'ISITC_fintech_glossary' ),
                'all_items'             => __( 'All Items', 'ISITC_fintech_glossary' ),
                'add_new_item'          => __( 'Add New Item', 'ISITC_fintech_glossary' ),
                'add_new'               => __( 'Add New', 'ISITC_fintech_glossary' ),
                'new_item'              => __( 'New Item', 'ISITC_fintech_glossary' ),
                'edit_item'             => __( 'Edit Item', 'ISITC_fintech_glossary' ),
                'update_item'           => __( 'Update Item', 'ISITC_fintech_glossary' ),
                'view_item'             => __( 'View Item', 'ISITC_fintech_glossary' ),
                'view_items'            => __( 'View Items', 'ISITC_fintech_glossary' ),
                'search_items'          => __( 'Search Item', 'ISITC_fintech_glossary' ),
                'not_found'             => __( 'Not found', 'ISITC_fintech_glossary' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'ISITC_fintech_glossary' ),
                'featured_image'        => __( 'Featured Image', 'ISITC_fintech_glossary' ),
                'set_featured_image'    => __( 'Set featured image', 'ISITC_fintech_glossary' ),
                'remove_featured_image' => __( 'Remove featured image', 'ISITC_fintech_glossary' ),
                'use_featured_image'    => __( 'Use as featured image', 'ISITC_fintech_glossary' ),
                'insert_into_item'      => __( 'Insert into item', 'ISITC_fintech_glossary' ),
                'uploaded_to_this_item' => __( 'Uploaded to this item', 'ISITC_fintech_glossary' ),
                'items_list'            => __( 'Items list', 'ISITC_fintech_glossary' ),
                'items_list_navigation' => __( 'Items list navigation', 'ISITC_fintech_glossary' ),
                'filter_items_list'     => __( 'Filter items list', 'ISITC_fintech_glossary' ),
            );
            $args = array(
                'label'                 => __( 'Fintech terms', 'ISITC_fintech_glossary' ),
                'description'           => __( 'Boilerplate cpt', 'ISITC_fintech_glossary' ),
                'labels'                => $labels,
                'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
                'taxonomies'            => array('topics', 'category', 'post_tag' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'menu_icon'             => 'dashicons-admin-tools',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'page',
                'show_in_rest'          => true,
            );
            register_post_type( 'Fintech-glossary', $args );

        }



        //get plugin root archive template for question archive
        public function fintech_terms_archive_template($template){
            global $post;

            if ( is_post_type_archive ( 'fintech-glossary' ) ) {
                //$template = ISITC_fintech_glossary_PLUGIN_DIR . '/fintech_terms_archive_template.php';      
            }
            return $template;
        }

        public function fintech_terms_single_template($template){
            global $post;

            if ( is_singular( 'fintech-glossary' ) ) {
                $template = ISITC_fintech_glossary_PLUGIN_DIR . '/fintech_terms_single_template.php';
            }
            return $template;
        }
        
    }
}


//initialize plugin
function ISITC_fintech_glossary_init() {
    global $ISITC_fintech_glossary_boilerplate;
    $ISITC_fintech_glossary = ISITC_fintech_glossary_boilerplate::instance();
}

ISITC_fintech_glossary_init();

// Show posts of custom post type only
//in production add conditions
function search_filter( $query ) {
    if (is_category()){
      $query->set( 'post_type', array( 'fintech-glossary' ) );
    }

}
 
add_action( 'pre_get_posts','search_filter' );
