<?php

// Shortcode para exibir o slideshow
function csp_display_slideshow() {

    // Obter as configurações
    $options = get_option('csp_settings');
    $arrow_size = isset($options['arrow_size']) ? $options['arrow_size'] : '20px';
    $slide_size = isset($options['slide_size']) ? $options['slide_size'] : 'auto';
    
    //Título
    $title_size = isset($options['title_size']) ? $options['title_size'] : '4.6rem';
    $title_font = isset($options['title_font']) ? esc_attr($options['title_font']) : '"Times New Roman", Times, serif';
    $title_peso = isset($options['title_peso']) ? esc_attr($options['title_peso']) : '400';
    $title_line = isset($options['title_line']) ? esc_attr($options['title_line']) : '1.0';
    $title_color = isset($options['title_color']) ? $options['title_color'] : '#ffffff';

    //Sub Título
    $size_st = isset($options['size_st']) ? esc_attr($options['size_st']) : ''; 
    $font_st = isset($options['font_st']) ? esc_attr($options['font_st']) : '"Times New Roman", Times, serif';
    $peso_st = isset($options['peso_st']) ? esc_attr($options['peso_st']) : '300';
    $line_st = isset($options['line_st']) ? esc_attr($options['line_st']) : '1.0';
    $color_st = isset($options['color_st']) ? esc_attr($options['color_st']) : '#ffffff';

    //Button
    $size_font_btn = isset($options['size_font_btn']) ? esc_attr($options['size_font_btn']) : '1.7rem'; 
    $font_btn = isset($options['font_btn']) ? esc_attr($options['font_btn']) : '"Times New Roman", Times, serif';
    $btn_color = isset($options['btn_color']) ? esc_attr($options['btn_color']) : '';
    $btn_bg = isset($options['btn_bg']) ? esc_attr($options['btn_bg']) : '';
    $btn_bg_hover = isset($options['btn_bg_hover']) ? esc_attr($options['btn_bg_hover']) : '';
    $btn_padding = isset($options['btn_padding']) ? esc_attr($options['btn_padding']) : '1rem 2rem 1rem 2rem';
    $btn_checkbox = isset($options['btn_checkbox']) ? esc_attr($options['btn_checkbox']) : '';
    $display = ($btn_checkbox == 1) ? "block" : "none";

    //Border radius button
    $br_top_btn = isset($options['br_top_btn']) ? esc_attr($options['br_top_btn']) : '';
    $br_right_btn = isset($options['br_right_btn']) ? esc_attr($options['br_right_btn']) : '';
    $br_bottom_btn = isset($options['br_bottom_btn']) ? esc_attr($options['br_bottom_btn']) : '';
    $br_left_btn = isset($options['br_left_btn']) ? esc_attr($options['br_left_btn']) : '';

    //Alinhamento
    $align_item_cl = isset($options['align_item_cl']) ? esc_attr($options['align_item_cl']) : 'start';

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
                    
                    <style>

                        .content {
                            position: absolute;
                            max-width: 100%;
                            border: 0px solid #c00;
                            top: 20%;
                            left: 8rem;
                            right: 8rem;
                            z-index: 1;
                            display: flex;
                            justify-content: center;
                            flex-direction: column;
                            align-items: <?php echo esc_attr($align_item_cl); ?>;
                            background-color: #00000000;
                            padding: 20px;
                            border-radius: 8px;
                            opacity: 0; 
                            transform: translateY(20px); 
                            transition: opacity 1s ease-in-out, transform 1s ease-in-out;
                        }

                        .content h1 {
                            font-family: <?php echo esc_attr($title_font); ?>;
                            font-size: <?php echo esc_attr($title_size); ?>;
                            font-weight:<?php echo esc_attr($title_peso); ?>;
                            line-height:<?php echo esc_attr($title_line); ?>;
                            display: flex;
                            flex-wrap: wrap;
                            align-items: <?php echo esc_attr($align_item_cl); ?>;
                           
                            color: <?php echo esc_attr($title_color); ?>;
                        }

                        .content p{
                            font-family: <?php echo esc_attr($font_st); ?>;
                            font-weight: <?php echo esc_attr($peso_st); ?>;
                            font-size: <?php echo esc_attr($size_st); ?>;
                            line-height: <?php echo esc_attr($line_st); ?>;
                            display: flex;
                            flex-wrap: wrap;
                            text-align: <?php echo esc_attr($align_item_cl); ?>;
                            align-items: <?php echo esc_attr($align_item_cl); ?>;
                           
                            margin: 0 0 1rem 0;
                            color: <?php echo esc_attr($color_st); ?>;
                        }

                        .prev .next {
                            cursor: pointer;
                            padding: 10px 20px;
                            font-size: <?php echo esc_attr($size_font_btn); ?>;
                            display: block;
                            color: white;
                            background-color: #555;
                            border: none;
                            border-radius: 5px;
                            transition: background-color 0.3s;
                        }

                        .btn-callback {
                            cursor: pointer;
                            padding: <?php echo esc_attr($btn_padding); ?>;
                            font-family: <?php echo esc_attr($font_btn); ?>;
                            font-size: <?php echo esc_attr($size_font_btn); ?>;
                            display: <?php echo esc_attr($display); ?>;
                            color: <?php echo esc_attr($btn_color); ?>;
                            background-color: <?php echo esc_attr($btn_bg); ?>;
                            border: none;
                            border-radius: <?php echo esc_attr($br_top_btn); ?> <?php echo esc_attr($br_right_btn); ?> <?php echo esc_attr($br_bottom_btn); ?> <?php echo esc_attr($br_left_btn); ?>;
                            transition: background-color 0.3s;
                        }

                        .btn-callback:hover {
                            background-color: <?php echo esc_attr($btn_bg_hover); ?>;
                            transform: translateX(2px); 
                        }

                        @media (max-width: 760px) {
                            .prev,
                            .next {
                                display: none;
                            }

                            .content {
                                position: absolute;
                                left: 2rem;
                                right: 2rem;
                                z-index: 1;
                                background-color: rgba(0, 0, 0, 0.1);
                            }

                            .content h1 {
                                font-size: calc(<?php echo esc_attr($title_size); ?>/2);
                                line-height:<?php echo esc_attr($title_line); ?>;
                                max-width: 100%;
                            }

                            .content p {
                                font-size: calc(<?php echo esc_attr($size_st); ?>/2);
                                line-height: <?php echo esc_attr($line_st); ?>;
                                max-width: 100%;
                            }
                        }


                    </style>

                    <div class="content">
                        <h1><?php the_title(); ?></h1>
            
                        <?php the_excerpt(); ?>
            
                        <button class="btn-callback">Saiba Mais</button>
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