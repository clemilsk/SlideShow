<?php

function listar_opcoes_fontes_st() {
    // Lista de fontes padrão
    $fontes_padrao_st = array(
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
    $opcoes_fontes_st = '';

    // Gerar as opções a partir das fontes padrão
    foreach ($fontes_padrao_st as $nome_fonte_st => $familia_fonte_st) {
        $opcoes_fontes_st .= '<option value="' . $subtitle_font = esc_attr($nome_fonte_st) . '" style="font-family:' . esc_attr($familia_fonte_st) . ';">' . esc_html($nome_fonte_st) . '</option>';
    }
    
    return $opcoes_fontes_st;
} 

function listar_pesos_fontes_st() {
    // Array com os pesos de fonte e seus respectivos nomes
    $pesos_fontes_st = array(
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '400' => '400',
        '500' => '500',
        '600' => '600',
        '700' => '700',
        '800' => '800',
        '900' => '900'
    );

    // Iniciar o output do <select>
    $output_st = '';
 
    // Loop para criar as <option> para cada peso de fonte
    foreach ($pesos_fontes_st as $valor_st => $nome_st) {
        $output_st .= '<option value="' . $peso_st = esc_attr($valor_st) . '">' . esc_html($nome_st) . '</option>';
    }

    // Retornar o output
    return $output_st;
}

function listar_lineheight_fontes_st() {
    // Array com os pesos de fonte e seus respectivos nomes
    $lh_fontes_st = array(
        '1.0' => '1.0',
        '1.2' => '1.2',
        '1.4' => '1.4',
        '1.5' => '1.5',
        '1.6' => '1.6',
        '1.8' => '1.8',
        '2.0' => '2.0',
        '2.5' => '2.5',
        '3.0' => '3.0'
    );

    // Iniciar o output do <select>
    $outputline_st = '';
 
    // Loop para criar as <option> para cada peso de fonte
    foreach ($lh_fontes_st as $line_st => $nome_st) {
        $outputline_st .= '<option value="' . $line_st = esc_attr($line_st) . '">' . esc_html($nome_st) . '</option>';
    }

    // Retornar o output
    return $outputline_st;
}


// Callback para o campo "Titulo"
function csp_subtitle_size_callback() {
    $options = get_option('csp_settings');
    $size_st = isset($options['size_st']) ? esc_attr($options['size_st']) : ''; 
    $font_st = isset($options['font_st']) ? esc_attr($options['font_st']) : '';
    $peso_st = isset($options['peso_st']) ? esc_attr($options['peso_st']) : '';
    $line_st = isset($options['line_st']) ? esc_attr($options['line_st']) : '';
    $color_st = isset($options['color_st']) ? esc_attr($options['color_st']) : '';

    echo '
            <fieldset class="border my-4 p-2">
                <legend  class="float-none w-auto px-2">Sub Título</legend>
                  
                    <div class="row g-3 my-2 mx-2">
                        <div class="col-sm-1">
                            <label for="exampleFormControlInput1" class="form-label">Tamanho da fonte</label>
                            <input type="text" class="form-control" name="csp_settings[size_st]" placeholder="Title Size" aria-label="Title" value="' . $size_st . '" />
                            <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;">Ex.: 1px, 1rem, 1% </div>
                        </div>
    
                        <div class="col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Fonte</label>
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" name="csp_settings[font_st]" aria-label="Floating label select example">
                                    <option selected>' . $font_st . '</option>' 
                                ?>
                                    <?php echo listar_opcoes_fontes_st(); ?>
                                <?php 
    echo '        
                                </select>
                            </div>
                    </div>
                            
                    <div class="col-sm-4">
                        <label for="exampleFormControlInput1" class="form-label">Peso da Fonte</label>
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" name="csp_settings[peso_st]" aria-label="Floating label select example">
                                <option selected>' . $peso_st . '</option>' ?>
                                    <?php echo listar_pesos_fontes_st(); ?>
                                <?php 
    echo '   
                            </select>
                        </div>
                    </div>

                        <div class="col-sm">
                            <label for="exampleFormControlInput1" class="form-label">Atura da linha</label>
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" name="csp_settings[line_st]" aria-label="Floating label select example">
                                    <option selected>' . $line_st . '</option>' ?>
                                        <?php echo listar_lineheight_fontes_st(); ?>
                                    <?php 
    echo '   
                            </select>
                        </div>
                    </div>
                        
                    </div>

                    <div class="row g-3 my-2 mx-2">
                        <div class="col-sm-1">
                                <label for="exampleColorInput" class="form-label">Cor</label>
                                <input type="color" class="form-control form-control-color" name="csp_settings[color_st]" id="exampleColorInput" value="' . $color_st . '" title="Choose your color">
                        </div>
                    </div>
            </fieldset>
        ';
}







