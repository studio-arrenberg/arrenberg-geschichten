<?php

/**
 * @package Arrenberg Geschichten 
 * @version 1.0
 */

/*
Plugin Name: Arrenberg Geschichten  
Plugin URI: https://github.com/studio-arrenberg/arrenberg-geschichten
Description: Plugin für die Quartiersplattform am Arrenberg utilizing ACF for WordPress
Author: studio arrenberg
Version: 1.0
Author URI: https://arrenberg.studio
*/

if(!class_exists("ArrenbergGeschichten"))
{
    /**
     * class:   ArrenbergGeschichten
     */
    class ArrenbergGeschichten
    {
        /**
         * Created an instance of the ArrenbergGeschichten class
         */
        public function __construct()
        {
            // Set up ACF
            add_filter('acf/settings/path', function() {
                return sprintf("%s/includes/advanced-custom-fields-pro/", dirname(__FILE__));
            });
            add_filter('acf/settings/dir', function() {
                return sprintf("%s/includes/advanced-custom-fields-pro/", plugin_dir_url(__FILE__));
            });
            require_once(sprintf("%s/includes/advanced-custom-fields-pro/acf.php", dirname(__FILE__)));

            // Settings managed via ACF
            // require_once(sprintf("%s/includes/settings.php", dirname(__FILE__)));
            // $settings = new ArrenbergGeschichten_Settings(plugin_basename(__FILE__));

            // CPT for Geschichten post type
            require_once(sprintf("%s/includes/geschichten-post-type.php", dirname(__FILE__)));
            $geschichtenposttype = new ArrenbergGeschichten_GeschichtenPostType();
        } // END public function __construct()

        /**
         * initialize
         *
         * Sets up Arrenberg Geschichten Plugin.
         *
         * @param	void
         * @return	void
         */
        public function initialize() {

            // Create Page in DB
            add_action( 'after_setup_theme', 'create_geschichten_page' );
            function create_geschichten_page() {

                $my_post = [];
                $my_post = array(
                    'post_title'    => 'Geschichten',
                    'post_status'   => 'publish',
                    'post_content' => '',
                    'post_author'   => 1,
                    'post_type'		=> 'page',
                    // 'post_slug'     => $pages[$i]['slug']
                );

                if ( ! function_exists( 'post_exists' ) ) {
                    require_once( ABSPATH . 'wp-admin/includes/post.php' );
                }

                if(post_exists('Geschichten','','','page') === 0){
                    # create post
                    wp_insert_post( $my_post, true );
                }

            }

            /**
             * Assign templates to pages
             */
            function geschichten_page_template( $page_template, $post_states ) {

                global $post;

                $post_states = [];
                $prefix = "QP Plugin ";

                if ($post->post_title == "Geschichten") {
                    $post_states[] = $prefix.'Geschichten';
                    $page_template= dirname( __FILE__ ) . '/includes/templates/geschichten-page.php';
                }
                
                if (doing_filter( 'page_template') && !empty($page_template)) {
                    return $page_template;
                }
                else if (doing_filter( 'display_post_states') && !empty($post_states)) {
                    return $post_states;
                }
            }
            add_filter( 'page_template', 'geschichten_page_template', 10, 2 );
            add_filter( 'display_post_states', 'geschichten_page_template', 1, 2);

            /**
             * Assign templates for custom post types
             */
            add_filter( 'single_template', 'geschichten_template_hook', 12 );
            function geschichten_template_hook() {

                global $post;

                if ( 'geschichten' === $post->post_type ) {
                    $single_template = dirname( __FILE__ ) . '/includes/templates/single-geschichten.php';
                }

                if ( !empty($single_template) ) {
                    return $single_template;
                }
                
            }

            // Load Gutenberg Block
            require_once(__DIR__ . '/includes/geschichten-block.php');

        }
        
        /**
         * Hook into the WordPress activate hook
         */
        public static function activate()
        {
            // Do something
        }

        /**
         * Hook into the WordPress deactivate hook
         */
        public static function deactivate()
        {
            // Do something
        }
    } // END class ArrenbergGeschichten
} // END if(!class_exists("ArrenbergGeschichten"))

if(class_exists('ArrenbergGeschichten'))
{    
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('ArrenbergGeschichten', 'activate'));
    register_deactivation_hook(__FILE__, array('ArrenbergGeschichten', 'deactivate'));
    
    // instantiate the plugin class
    $plugin = new ArrenbergGeschichten();
    $plugin->initialize(); // call initialize function
    
} // END if(class_exists('ArrenbergGeschichten'))