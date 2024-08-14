<?php

// Shortcode para exibir o slideshow
function csp_display_slideshow() {
    // Obter as configurações
    $options = get_option('csp_settings');
    $arrow_size = isset($options['arrow_size']) ? $options['arrow_size'] : '20px';
    $slide_size = isset($options['slide_size']) ? $options['slide_size'] : '800px';
    $title_size = isset($options['title_size']) ? $options['title_size'] : '4.6rem';
    $title_color = isset($options['title_color']) ? $options['title_color'] : '#ffffff';
    $title_font = isset($options['title_font']) ? esc_attr($options['title_font']) : '"Times New Roman", Times, serif';
    $title_peso = isset($options['title_peso']) ? esc_attr($options['title_peso']) : '400';
    $title_line = isset($options['title_line']) ? esc_attr($options['title_line']) : '1.0';

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
                        <h1 style="font-size: <?php echo esc_attr($title_size); ?>rem; color: <?php echo esc_attr($title_color); ?>; font-family:<?php echo esc_attr($title_font); ?>; font-weight:<?php echo esc_attr($title_peso); ?>; line-height:<?php echo esc_attr($title_line); ?>;"><?php the_title(); ?></h1>
               
                        <p><?php the_excerpt(); ?></p>
                        <button>Saiba Mais</button>
                    </div>
                </div>
            <?php $slide_index++; endwhile; ?>
            
            <!-- Indicadores -->
            <div class="carousel-indicators-cl">
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