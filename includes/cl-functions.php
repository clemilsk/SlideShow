<?php

// Registrar o Custom Post Type
function csp_create_slide_post_type() {
    $labels = array(
        'name'                  => _x('Slides', 'Post type general name', 'custom-slideshow-plugin'),
        'singular_name'         => _x('Slide', 'Post type singular name', 'custom-slideshow-plugin'),
        'menu_name'             => _x('Slide', 'Admin Menu text', 'custom-slideshow-plugin'),
        'name_admin_bar'        => _x('Slide', 'Add New on Toolbar', 'custom-slideshow-plugin'),
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
        'menu_icon'          => 'dashicons-slides',
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
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

    // Enfileirar JavaScript
    wp_enqueue_script('meu-plugin-script', MEU_PLUGIN_URL . '/assets/js/scripts.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'csp_enqueue_assets');

// Shortcode para exibir o slideshow
function csp_display_slideshow() {
    // Obter as configurações
    $options = get_option('csp_settings');
    $arrow_size = isset($options['arrow_size']) ? $options['arrow_size'] : '30px';
    $slide_size = isset($options['slide_size']) ? $options['slide_size'] : '1280px';

    $args = array(
        'post_type'      => 'slide',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => -1,
    );

    $slide_query = new WP_Query($args);
    ob_start();

    if ($slide_query->have_posts()) : ?>

        <div class="csp-slideshow-container" style="max-width: <?php echo esc_attr($slide_size); ?>;">
            <?php $slide_index = 0; while ($slide_query->have_posts()) : $slide_query->the_post(); ?>
                <div class="slide">
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail('full', array(
                            'class' => 'slide-image',
                            'alt'   => get_the_title()
                        ));
                    } ?>
                    
                    <div class="content">
                        <h1><?php the_title(); ?></h1>
                        <p><?php the_content(); ?></p>
                        <button>Saiba Mais</button>
                    </div>
                </div>
            <?php $slide_index++; endwhile; ?>
            
            <!-- Indicadores -->
            <div class="carousel-indicators">
                <?php $slide_index = 0; while ($slide_query->have_posts()) : $slide_query->the_post(); ?>
                    <span class="indicator" onclick="currentSlide(<?php echo $slide_index; ?>)" class="<?php echo $slide_index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $slide_index + 1; ?>)"></span>
                <?php $slide_index++; endwhile; ?>
            </div>
            <button class="prev" onclick="changeSlide(-1)" style="font-size: <?php echo esc_attr($arrow_size); ?>;">&#10094;</button>
            <button class="next" onclick="changeSlide(1)" style="font-size: <?php echo esc_attr($arrow_size); ?>;">&#10095;</button>
        </div>

    <?php wp_reset_postdata(); ?>
    <?php endif;

    return ob_get_clean();
}
add_shortcode('custom_slideshow', 'csp_display_slideshow');
 //[custom_slideshow]