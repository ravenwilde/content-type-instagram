<?php
/*
Plugin Name: Content Type Instagram
Plugin URI: https://github.com/ravenwilde/content-instagram
Description: A plugin that creates a custom post type for instagram imports - comes with minimal styling, can be used with any WordPress theme.
Version: 1.0
Author: Jennifer Scroggins
Author URI: http://www.ravenwilde.com/
License: GPLv2
*/


/* Instagram Custom Post Type */

function ci_register_post_type() {

    $labels = array(
        'name'                => _x( 'Instagrams', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Instagram', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Instagram', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Instagrams:', 'text_domain' ),
        'all_items'           => __( 'All Instagrams', 'text_domain' ),
        'view_item'           => __( 'View Instagram', 'text_domain' ),
        'add_new_item'        => __( 'Add New Instagram', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'edit_item'           => __( 'Edit Instagram', 'text_domain' ),
        'update_item'         => __( 'Update Instagram', 'text_domain' ),
        'search_items'        => __( 'Search Instagram', 'text_domain' ),
        'not_found'           => __( 'No Instagrams Found', 'text_domain' ),
        'not_found_in_trash'  => __( 'No Instagrams found in Trash', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                => 'instagram',
        'with_front'          => true,
        'pages'               => true,
        'feeds'               => true,
    );
    $args = array(
        'label'               => __( 'instagram_post', 'text_domain' ),
        'description'         => __( 'Instagram Imports', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'rewrite'             => $rewrite,
        'capability_type'     => 'page',
    );
    register_post_type( 'instagram_post', $args );

}


/* Load Custom CSS */
function ci_register_styles()  
{  
    // Register the style like this for a plugin:  
    wp_register_style( 'instagram-style', plugins_url( '/css/content-instagram-style.css', __FILE__ ), array(), '20141013', 'all' );  
    wp_enqueue_style( 'instagram-style' );  
}

/* Add Instagram Posts to the Main Query */
function ci_query( $query ) {
    
    if( is_home() && $query->is_main_query() ) {
        
        $query->set( 'post_type', array('post', 'instagram_post') );
        return $query;
    }
 
}  

/* Add Custom Templates */
function ci_include_template( $template_path ) {
    if ( get_post_type() == 'instagram_post' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-instagram_post.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-instagram_post.php';
            }
        }
    }
    return $template_path;
}
  
/* Make everything happen */
add_action( 'init', 'ci_register_post_type', 0 );
add_action( 'wp_enqueue_scripts', 'ci_register_styles' );
add_action( 'pre_get_posts', 'ci_query' );
add_filter( 'template_include', 'ci_include_template', 1 );


?>