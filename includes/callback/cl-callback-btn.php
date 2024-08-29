<?php
function listar_opcoes_fontes_btn()
{
    // Lista de fontes padrão
    $fontes_padrao_btn = array(
        'Arial' => 'Arial, sans-serif',
        'Courier New' => '"Courier New", monospace',
        'Georgia' => 'Georgia, serif',
        'Lato' => 'Lato, sans-serif',
        'Montserrat' => 'Montserrat, sans-serif',
        'Open Sans' => 'Open Sans, sans-serif',
        'Poppins' => 'Poppins, sans-serif',
        'Roboto' => '"Roboto", sans-serif',
        'Times New Roman' => '"Times New Roman", serif',
        'Ubuntu' => 'Ubuntu, sans-serif',
        'Verdana' => 'Verdana, sans-serif'
    );

    // Iniciar as opções
    $opcoes_fontes_btn = '';

    // Gerar as opções a partir das fontes padrão
    foreach ($fontes_padrao_btn as $nome_fonte_btn => $familia_fonte_btn) {
        $opcoes_fontes_btn .= '<option value="' . $font_btn = esc_attr($nome_fonte_btn) . '" style="font-family:' . esc_attr($familia_fonte_btn) . ';">' . esc_html($nome_fonte_btn) . '</option>';
    }

    return $opcoes_fontes_btn;
}

// Callback para o campo "Titulo"
function csp_btn_callback() {
    $options = get_option('csp_settings');

    $size_font_btn_cl = isset($options['size_font_btn_cl']) ? esc_attr($options['size_font_btn_cl']) : '';

    $border_btn_cl = isset($options['border_btn_cl']) ? esc_attr($options['border_btn_cl']) : ''; 
    
    $font_btn = isset($options['font_btn']) ? esc_attr($options['font_btn']) : ''; 
    $btn_color = isset($options['btn_color']) ? esc_attr($options['btn_color']) : '';
    $btn_bg = isset($options['btn_bg']) ? esc_attr($options['btn_bg']) : '';
    $btn_bg_opacidade = isset($options['btn_bg_opacidade']) ? esc_attr($options['btn_bg_opacidade']) : '';
    $btn_bg_hover = isset($options['btn_bg_hover']) ? esc_attr($options['btn_bg_hover']) : '';
    $btn_checkbox = isset($options['btn_checkbox']) ? esc_attr($options['btn_checkbox']) : '';
    $valor_true = 1;
    $status_mensagem = ($btn_checkbox == 1) ? "Ativo" : "Inativo";

    // Campos Border radius
    $br_top_btn = isset($options['br_top_btn']) ? esc_attr($options['br_top_btn']) : '';
    $br_right_btn = isset($options['br_right_btn']) ? esc_attr($options['br_right_btn']) : '';
    $br_bottom_btn = isset($options['br_bottom_btn']) ? esc_attr($options['br_bottom_btn']) : '';
    $br_left_btn = isset($options['br_left_btn']) ? esc_attr($options['br_left_btn']) : '';

    echo '
                <div class="row">
                    <div class="col-4">
                        <fieldset class="border my-4 p-2">
                            <legend  class="float-none w-auto px-2">Botão</legend>
                                <div class="row g-3 my-2 mx-2">
                                    <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">Tamanho da fonte</label>
                                        <input type="text" class="form-control" name="csp_settings[size_font_btn_cl]" placeholder="" aria-label="Title" value="' . $size_font_btn_cl . '" />
                                        <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;">Ex.: 1px, 1rem, 1% </div>
                                    </div>
                                </div>

                                <div class="row g-3 my-2 mx-2">
                                    <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">Fonte</label>
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" name="csp_settings[font_btn]" aria-label="Floating label select example">
                                                <option selected>' . $font_btn . '</option>'?>

                                                    <?php echo listar_opcoes_fontes_btn(); ?><?php
        echo '        
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 my-2 mx-2">
                                    <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">Top</label>
                                        <input type="text" class="form-control" name="csp_settings[br_top_btn]" placeholder="" aria-label="Title" value="' . $br_top_btn . '" />
                                        <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;">Border Radius </div>
                                    </div>
                                     <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">Right</label>
                                        <input type="text" class="form-control" name="csp_settings[br_right_btn]" placeholder="" aria-label="Title" value="' . $br_right_btn . '" />
                                        <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;" ></div>
                                    </div>
                                     <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">Bottom</label>
                                        <input type="text" class="form-control" name="csp_settings[br_bottom_btn]" placeholder="" aria-label="Title" value="' . $br_bottom_btn . '" />
                                        <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;"></div>
                                    </div>
                                     <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">Left</label>
                                        <input type="text" class="form-control" name="csp_settings[br_left_btn]" placeholder="" aria-label="Title" value="' . $br_left_btn . '" />
                                        <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;"></div>
                                    </div>
                                </div>

                                <div class="row g-3 my-2 mx-2">
                                    <div class="col">
                                            <label for="exampleColorInput" class="form-label">Cor do texto</label>
                                            <input type="color" class="form-control form-control-color" name="csp_settings[btn_color]" id="exampleColorInput" value="' . $btn_color . '" title="">
                                    </div>
                                    <div class="col">
                                            <label for="exampleColorInput" class="form-label">Cor do botão</label>
                                            <input type="color" class="form-control form-control-color" name="csp_settings[btn_bg]" id="exampleColorInput" value="' . $btn_bg . '" title="">
                                    </div>
                                    <div class="col">
                                            <label for="exampleColorInput" class="form-label">Cor do botão hover</label>
                                            <input type="color" class="form-control form-control-color" name="csp_settings[btn_bg_hover]" id="exampleColorInput" value="' . $btn_bg_hover . '" title="">
                                    </div>
                                </div>

                                <div class="row g-3 my-2 mx-2">
                                    <div class="col-6">
                                        <label for="exampleFormControlInput1" class="form-label">Background Transparente</label>
                                        <input type="text" class="form-control" name="csp_settings[btn_bg_opacidade]" placeholder="" aria-label="Title" value="' . $btn_bg_opacidade . '" />
                                        <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;">Ex.: (00 = 0%)...(50 = 50%)...(ff = 100%) </div>
                                    </div>
                                </div>
                                
                                <div class="row g-3 my-2 mx-3">
                                    <div class="form-check" style="display: block;">
                                   
                                        <input id="flexCheckChecked" class="form-check-input" type="checkbox" name="csp_settings[btn_checkbox]" value="' . $valor_true . '" ' ?> <?php checked($valor_true, $btn_checkbox, true); ?> <?php echo ' />
                                        <label class="form-check-label" for="flexCheckChecked" style="display: block; line-height: 0">' ?> <?php echo $status_mensagem; ?> <?php echo '</label>
                             
                                 </div>
                                </div>
                        </fieldset>
                    </div>

                    <div class="col">
                        <fieldset class="border my-4 p-2">

                            <legend  class="float-none w-auto px-2">...</legend>

                            <div class="row g-3 my-2 mx-2">
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">Border Size</label>
                                        <input type="text" class="form-control" name="csp_settings[border_btn_cl]" placeholder="" aria-label="Title" value="' . $border_btn_cl . '" />
                                    <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;">Ex.: 1px, 1%, 1rem </div>
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







