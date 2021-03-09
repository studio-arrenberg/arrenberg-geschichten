<?php
if(!class_exists('ArrenbergGeschichten_GeschichtenPostType'))
{
    class ArrenbergGeschichten_GeschichtenPostType
    {
        const SLUG = "geschichten";

        /**
         * Construct the custom post type for Reports
         */
        public function __construct()
        {
            // register actions
            add_action('init', array(&$this, 'init'));
        } // END public function __construct()
        
        /**
         * Hook into the init action
         */
        public function init()
        {
            // Register the Analytics Report post type
            register_post_type(self::SLUG,
                array(
                    "label" => __( "Geschichten", "quartiersplattform" ),
                    "labels" => array(
                        "name" => __( "Geschichten", "quartiersplattform" ),
                        "singular_name" => __( "geschichten", "quartiersplattform" ),
                    ),
                    "description" => "Geschiten Post Type",
                    "public" => true,
                    "publicly_queryable" => true,
                    "show_ui" => true,
                    "show_in_rest" => true,
                    "rest_base" => "",
                    "rest_controller_class" => "WP_REST_Posts_Controller",
                    "has_archive" => false,
                    "show_in_menu" => true,
                    "show_in_nav_menus" => true,
                    "delete_with_user" => false,
                    "exclude_from_search" => false,
                    "capability_type" => "post",
                    "map_meta_cap" => true,
                    "hierarchical" => false,
                    "rewrite" => [ "slug" => "geschichten", "with_front" => true ],
                    "query_var" => true,
                    "menu_icon" => "dashicons-text-page",
                    "supports" => [ "title", "editor", "thumbnail", "excerpt", "author" ],
                )
            );

            if(function_exists("register_field_group"))
            {
                // Our ACF Goodies are going to go here
            } // END if(function_exists("register_field_group"))
        } // END public function init()
    } // END class ArrenbergGeschichten_GeschichtenPostType
} // END if(!class_exists('ArrenbergGeschichten_GeschichtenPostType'))