<?php
/*
Plugin Name: Content-Instagram
Plugin URI: https://github.com/ravenwilde/content-instagram
Description: A plugin that creates a custom post type for instagram imports.
Version: 1.0
Author: Jennifer Scroggins
Author URI: http://www.ravenwilde.com/
License: GPLv2
*/

/* Create Instagram Taxonomy */

function register_instagram_taxonomy() {
    register_taxonomy(
        'instagram',
        array( 'instagram'),
        array(
            'public' => true,
            'labels' => array(
                'name' => __( 'Instagram' ),
                'singular_name' => __( 'Instagram' ),
                'search_items' => __( 'Instagrams' ),
                'popular_items' => __( 'Popular Instagrams' ),
                'all_items' => __( 'All Instagrams' ),
                'edit_item' => __( 'Edit Instagram' ),
                'update_item' => __( 'Update Instagram' ),
                'add_new_item' => __( 'Add Instagram' ),
                'new_item_name' => __( 'New Instagram Name' ),
                ),
            'show_ui'           => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'hierarchical' => false,
            'query_var' => 'instagram',
            )

        );
}

/* Instagram Custom Post Type */
function create_instagram_post_types() {    

    register_post_type( 'instagram',
        array(
            'labels' => array(
                'name' => 'Instagram',
                'singular_name' => 'Instagram',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Instagram',
                'edit' => 'Edit',
                'edit_item' => 'Edit Instagram',
                'new_item' => 'New Instagram',
                'view' => 'View',
                'view_item' => 'View Instagram',
                'search_items' => 'Search Instagrams',
                'not_found' => 'No Instagrams found',
                'not_found_in_trash' => 'No Instagrams found in Trash',
                'parent' => 'Parent Instagrams'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'revisions' ),
            'taxonomies' => array( 'instagram' ),
            'has_archive' => true
        )
    );
}

/* Load Custom CSS */
function register_instagram_styles()  
{  
    // Register the style like this for a plugin:  
    wp_register_style( 'instagram-style', plugins_url( '/css/content-instagram-style.css', __FILE__ ), array(), '20141013', 'all' );  
    wp_enqueue_style( 'instagram-style' );  
}  
  
/* Make everything happen */
add_action( 'init', 'register_instagram_taxonomy', 0 );
add_action( 'init', 'create_instagram_post_types' );
add_action( 'wp_enqueue_scripts', 'register_instagram_styles' );


?>