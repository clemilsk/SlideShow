<?php
// Callback para o campo "Tamanho dos Slides"
function csp_slide_size_callback() {
    $options = get_option('csp_settings');
    $slide_size = isset($options['slide_size']) ? esc_attr($options['slide_size']) : '';
    echo '  
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Example label</label>
                <input type="text" class="form-control" name="csp_settings[slide_size]" value="' . $slide_size . '" />
            </div>
        ';
}