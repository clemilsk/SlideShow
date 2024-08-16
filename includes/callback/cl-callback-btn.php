<?php

// Callback para o campo "Titulo"
function csp_btn_callback() {
    $options = get_option('csp_settings');
    $size_font_btn = isset($options['size_font_btn']) ? esc_attr($options['size_font_btn']) : ''; 
    $btn_color = isset($options['btn_color']) ? esc_attr($options['btn_color']) : '';
    $btn_checkbox = isset($options['btn_checkbox']) ? esc_attr($options['btn_checkbox']) : '';
    $valor_true = 1;

    echo '
                <div class="row">
                    <div class="col-3">
                        <fieldset class="border my-4 p-2">
                            <legend  class="float-none w-auto px-2">Botão</legend>
                                <div class="row g-3 my-2 mx-2">
                                    <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">Tamanho da fonte</label>
                                        <input type="text" class="form-control" name="csp_settings[size_font_btn]" placeholder="Fonte BTN" aria-label="Title" value="' . $size_font_btn . '" />
                                        <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;">Ex.: 1px, 1rem, 1% </div>
                                    </div>
                                </div>

                                <div class="row g-3 my-2 mx-2">
                                    <div class="col">
                                            <label for="exampleColorInput" class="form-label">Cor do botão</label>
                                            <input type="color" class="form-control form-control-color" name="csp_settings[btn_color]" id="exampleColorInput" value="' . $btn_color . '" title="Choose your color">
                                    </div>
                                </div>
                                
                                <div class="row g-3 my-2 mx-3">
                                    <div class="form-check" style="display: block;">
                                   
                                        <input id="flexCheckChecked" class="form-check-input" type="checkbox" name="csp_settings[btn_checkbox]" value="' . $valor_true . '" ' ?> <?php checked($valor_true, $btn_checkbox, true); ?> <?php echo ' />
                                        <label class="form-check-label" for="flexCheckChecked" style="display: block; line-height: 0">Ativado</label>
                             
                                 </div>
                                </div>
                        </fieldset>
                    </div>

                    <div class="col">
                        <fieldset class="border my-4 p-2">

                            <legend  class="float-none w-auto px-2">...</legend>
                            

                        </fieldset>
                    </div>
                </div>
         
         ';
}







