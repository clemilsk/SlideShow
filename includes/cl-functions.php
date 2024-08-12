<?php

// Registrar o Custom Post Type
function csp_create_slide_post_type() {
    $labels = array(
        'name'                  => _x('Slides', 'Post type general name', 'custom-slideshow-plugin'),
        'singular_name'         => _x('Slidec', 'Post type singular name', 'custom-slideshow-plugin'),
        'menu_name'             => _x('Slidec', 'Admin Menu text', 'custom-slideshow-plugin'),
        'name_admin_bar'        => _x('Slidec', 'Add New on Toolbar', 'custom-slideshow-plugin'),
        'add_new'               => __('Adicionar Novo', 'custom-slideshow-plugin'),
        'add_new_item'          => __('Add New Slide', 'custom-slideshow-plugin'),
        'new_item'              => __('New Slide', 'custom-slideshow-plugin'),
        'edit_item'             => __('Editar Slide', 'custom-slideshow-plugin'),
        'view_item'             => __('View Slide', 'custom-slideshow-plugin'),
        'all_items'             => __('Todos', 'custom-slideshow-plugin'),
        'search_items'          => __('Search Slides', 'custom-slideshow-plugin'),
        'not_found'             => __('No slides found.', 'custom-slideshow-plugin'),
        'not_found_in_trash'    => __('No slides found in Trash.', 'custom-slideshow-plugin'),
        'featured_image'        => _x('Slide Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'custom-slideshow-plugin'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'custom-slideshow-plugin'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'custom-slideshow-plugin'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'custom-slideshow-plugin'),
        'archives'              => _x('Slide archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'custom-slideshow-plugin'),
        'insert_into_item'      => _x('Insert into slide', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'custom-slideshow-plugin'),
        'uploaded_to_this_item' => _x('Uploaded to this slide', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'custom-slideshow-plugin'),
        'filter_items_list'     => _x('Filter slides list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'custom-slideshow-plugin'),
        'items_list_navigation' => _x('Slides list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'custom-slideshow-plugin'),
        'items_list'            => _x('Slides list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'custom-slideshow-plugin'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'slide'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-ellipsis',
        'menu_position'      => null,
        'supports' => array('title', 'thumbnail', 'excerpt'),
    );

    register_post_type('slide', $args);
}
add_action('init', 'csp_create_slide_post_type');

// Definir constantes do plugin
define('MEU_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MEU_PLUGIN_PATH', plugin_dir_path(__FILE__));
//var_dump(MEU_PLUGIN_URL);

// Enfileirar arquivos CSS e JavaScript
function csp_enqueue_assets() {

    // Enfileirar CSS
    wp_enqueue_style('meu-plugin-style', MEU_PLUGIN_URL . '/assets/css/style.css', array(), '1.0', 'all');

    //wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), '5.0.2', 'all');

    // Enfileirar JavaScript
    wp_enqueue_script('meu-plugin-script', MEU_PLUGIN_URL . '/assets/js/scripts.js', array(), '1.0', true);

    // Enfileirar o JS do Bootstrap
    //wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.0.2', true);

}
add_action('wp_enqueue_scripts', 'csp_enqueue_assets');

// Função para enfileirar o Bootstrap apenas nas páginas do plugin
function csp_enqueue_bootstrap_for_plugin($hook) {

    // Verifica se estamos na página do plugin
    if ($hook === 'toplevel_page_csp-plugin-settings' || strpos($hook, 'csp-plugin-settings') !== false) {

        // Enfileirar CSS
        wp_enqueue_style('meu-plugin-style', MEU_PLUGIN_URL . '/assets/css/style.css', array(), '1.0', 'all');

        // Enfileirar o CSS do Bootstrap
        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), '5.0.2', 'all');

        // Enfileirar o JS do Bootstrap
        wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.0.2', true);
        
    }
}
add_action('admin_enqueue_scripts', 'csp_enqueue_bootstrap_for_plugin');


