<?php
/*
Plugin Name: Aqua-Instagram
Plugin URI: https://github.com/ravenwilde/content-instagram
Description: A plugin that creates a custom post type for instagram imports - designed for use with my 'Aqua-One' Theme but can be used with any WordPress theme..
Version: 1.0
Author: Jennifer Scroggins
Author URI: http://www.ravenwilde.com/
License: GPLv2
*/


/* Instagram Custom Post Type */
function create_instagram_post_type() {    

    register_post_type( 'instagram_post',
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
            'has_archive' => true
            'rewrite' => array('slug' => 'instagram'),
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
add_action( 'init', 'create_instagram_post_type' );
add_action( 'wp_enqueue_scripts', 'register_instagram_styles' );


?>