<?php
// Add Register CPT
function farm_register_custom_post_types() {
    //Register testimonial CPT
    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name'  ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name'  ),
        'menu_name'          => _x( 'Testimonials', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'testimonial' ),
        'add_new_item'       => __( 'Add New Testimonial' ),
        'new_item'           => __( 'New Testimonial' ),
        'edit_item'          => __( 'Edit Testimonial' ),
        'view_item'          => __( 'View Testimonial'  ),
        'all_items'          => __( 'All Testimonials' ),
        'search_items'       => __( 'Search Testimonials' ),
        'parent_item_colon'  => __( 'Parent Testimonials:' ),
        'not_found'          => __( 'No testimonials found.' ),
        'not_found_in_trash' => __( 'No testimonials found in Trash.' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'editor' ),
        'template'           => array( array( 'core/quote' ) ),
        'template_lock'      => 'all'
    );
    register_post_type( 'farm-testimonial', $args );

    //Register media CPT
    $labels = array(
        'name'               => _x( 'Social', 'post type general name'  ),
        'singular_name'      => _x( 'Social', 'post type singular name'  ),
        'menu_name'          => _x( 'Social', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Social', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'social' ),
        'add_new_item'       => __( 'Add New Social' ),
        'new_item'           => __( 'New Social' ),
        'edit_item'          => __( 'Edit Social' ),
        'view_item'          => __( 'View Social'  ),
        'all_items'          => __( 'All Social' ),
        'search_items'       => __( 'Search Social' ),
        'parent_item_colon'  => __( 'Parent Social:' ),
        'not_found'          => __( 'No social found.' ),
        'not_found_in_trash' => __( 'No social found in Trash.' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'social' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-video-alt',
        'supports'           => array( 'title', 'thumbnail','editor' ),
        'template'           => array( array( 'core/paragraph' ) ),
        'template_lock'      => 'all'
    );
    register_post_type( 'farm-social', $args );

        //Register Dishes CPT
        $labels = array(
            'name'               => _x( 'Dish', 'post type general name'  ),
            'singular_name'      => _x( 'Dish', 'post type singular name'  ),
            'menu_name'          => _x( 'Dish', 'admin menu'  ),
            'name_admin_bar'     => _x( 'Dish', 'add new on admin bar' ),
            'add_new'            => _x( 'Add New', 'dish' ),
            'add_new_item'       => __( 'Add New Dish' ),
            'new_item'           => __( 'New Dish' ),
            'edit_item'          => __( 'Edit Dish' ),
            'view_item'          => __( 'View Dish'  ),
            'all_items'          => __( 'All Dish' ),
            'search_items'       => __( 'Search Dish' ),
            'parent_item_colon'  => __( 'Parent Dish:' ),
            'not_found'          => __( 'No dish found.' ),
            'not_found_in_trash' => __( 'No dish found in Trash.' ),
        );
        
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'dishes' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 7,
            'menu_icon'          => 'dashicons-food',
            'supports'           => array( 'title', 'thumbnail','editor' ),
        );
        register_post_type( 'farm-dish', $args );


}
add_action( 'init', 'farm_register_custom_post_types' );

function farm_register_taxonomies() {
    // for Dish
    $labels = array(
        'name'              => _x( 'Week', 'taxonomy general name' ),
        'singular_name'     => _x( 'Week', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Week' ),
        'all_items'         => __( 'All Week' ),
        'parent_item'       => __( 'Parent Week' ),
        'parent_item_colon' => __( 'Parent Week:' ),
        'edit_item'         => __( 'Edit Week' ),
        'view_item'         => __( 'View Week' ),
        'update_item'       => __( 'Update Week' ),
        'add_new_item'      => __( 'Add New Week' ),
        'new_item_name'     => __( 'New Week Name' ),
        'menu_name'         => __( 'Week' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'week' ),
    );
    register_taxonomy( 'farm-week', array( 'farm-dish' ), $args );

    $labels = array(
        'name'              => _x( 'Kit Type', 'taxonomy general name' ),
        'singular_name'     => _x( 'Kit Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Kit Type' ),
        'all_items'         => __( 'All Kit Type' ),
        'parent_item'       => __( 'Parent Kit Type' ),
        'parent_item_colon' => __( 'Parent Kit Type:' ),
        'edit_item'         => __( 'Edit Kit Type' ),
        'view_item'         => __( 'View Kit Type' ),
        'update_item'       => __( 'Update Kit Type' ),
        'add_new_item'      => __( 'Add New Kit Type' ),
        'new_item_name'     => __( 'New Kit Type Name' ),
        'menu_name'         => __( 'Kit Type' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'kit-type' ),
    );
    register_taxonomy( 'farm-type', array( 'farm-dish' ), $args );
 

}
add_action( 'init', 'farm_register_taxonomies');


//flush the theme
function farm_rewrite_flush() {
    farm_register_custom_post_types();
    farm_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'farm_rewrite_flush' );