<?php

function listar_opcoes_fontes() {
    // Lista de fontes padrão
    $fontes_padrao = array(
        'Arial' => 'Arial, sans-serif',
        'Times New Roman' => '"Times New Roman", serif',
        'Georgia' => 'Georgia, serif',
        'Courier New' => '"Courier New", monospace',
        'Verdana' => 'Verdana, sans-serif',
        'Roboto' => '"Roboto", sans-serif',
        'Tahoma' => 'Tahoma, sans-serif'
    );

    // Iniciar as opções
    $opcoes_fontes = '';

    // Gerar as opções a partir das fontes padrão
    foreach ($fontes_padrao as $nome_fonte => $familia_fonte) {
        $opcoes_fontes .= '<option value="' . $title_font = esc_attr($nome_fonte) . '" style="font-family:' . esc_attr($familia_fonte) . ';">' . esc_html($nome_fonte) . '</option>';
    }
    
    return $opcoes_fontes;
} 

function listar_pesos_fontes() {
    // Array com os pesos de fonte e seus respectivos nomes
    $pesos_fontes = array(
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
    $output = '';
 
    // Loop para criar as <option> para cada peso de fonte
    foreach ($pesos_fontes as $valor => $nome) {
        $output .= '<option value="' . $title_peso = esc_attr($valor) . '">' . esc_html($nome) . '</option>';
    }

    // Retornar o output
    return $output;
}

function listar_lineheight_fontes() {
    // Array com os pesos de fonte e seus respectivos nomes
    $lh_fontes = array(
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
    $outputline = '';
 
    // Loop para criar as <option> para cada peso de fonte
    foreach ($lh_fontes as $line => $nome) {
        $outputline .= '<option value="' . $title_peso = esc_attr($line) . '">' . esc_html($line) . '</option>';
    }

    // Retornar o output
    return $outputline;
}


// Callback da seção
function csp_geral_section_callback() {
    echo 'Aqui você pode configurar as opções do slideshow.';
}

// Callback para o campo "Titulo"
function csp_title_size_callback() {
    $options = get_option('csp_settings');
    $title_size = isset($options['title_size']) ? esc_attr($options['title_size']) : '';
    $title_color = isset($options['title_color']) ? esc_attr($options['title_color']) : '';
    $title_font = isset($options['title_font']) ? esc_attr($options['title_font']) : '';
    $title_peso = isset($options['title_peso']) ? esc_attr($options['title_peso']) : '400';
    $title_line = isset($options['title_line']) ? esc_attr($options['title_line']) : '1.0';

    echo '
            <fieldset class="border p-2">
                <legend  class="float-none w-auto px-2">Título</legend>
                  
                    <div class="row g-3 my-2 mx-2">
                        <div class="col-sm-1">
                            <input type="number" class="form-control" name="csp_settings[title_size]" placeholder="Title Size" aria-label="Title" value="' . $title_size . '" />
                        </div>

                        <div class="col-sm-4">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" name="csp_settings[title_font]" aria-label="Floating label select example">
                                    <option selected>' . $title_font . '</option>' 
                                ?>
                                    <?php echo listar_opcoes_fontes(); ?>
                                <?php 
    echo '        
                                </select>
                            </div>
                    </div>
                            
                    <div class="col-sm-4">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" name="csp_settings[title_peso]" aria-label="Floating label select example">
                                <option selected>' . $title_peso . '</option>' ?>
                                    <?php echo listar_pesos_fontes(); ?>
                                <?php 
    echo '   
                            </select>
                        </div>
                    </div>

                        <div class="col-sm">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" name="csp_settings[title_line]" aria-label="Floating label select example">
                                    <option selected>' . $title_line . '</option>' ?>
                                        <?php echo listar_lineheight_fontes(); ?>
                                    <?php 
    echo '   
                            </select>
                        </div>
                    </div>
                        
                    </div>
                    <div class="row g-3 my-2 mx-2">
                        <div class="col-sm-1">
                                <label for="exampleColorInput" class="form-label">Cor</label>
                                <input type="color" class="form-control form-control-color" name="csp_settings[title_color]" id="exampleColorInput" value="' . $title_color . '" title="Choose your color">
                        </div>
                    </div>
            </fieldset>
        ';
}


// Callback para o campo "Tamanho das Setas"
function csp_arrow_size_callback($args) {
    $options = get_option('csp_settings');
    $arrow_size = isset($options['arrow_size']) ? esc_attr($options['arrow_size']) : '';
    
   /* echo '
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Example label</label>
                <input type="text" class="form-control" id="'. esc_attr($args['label_for']) .'" name="csp_settings[arrow_size]" value="' . $arrow_size . '" />
            </div>
        ';
    */
        echo '
        <fieldset class="border p-2">
            <legend  class="float-none w-auto px-2">Texto</legend>
              
                <div class="row g-3 my-2 mx-2">
                    <div class="col-sm-1">
                        <input type="number" class="form-control" name="csp_settings[arrow_size]" placeholder="Title Size" aria-label="Title" value="' . $arrow_size . '" />
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected>FONTES</option>
                                <option value="Arial" style="font-family: Arial, sans-serif;">Arial</option>
                                <option value="Times New Roman" style="font-family: "Times New Roman", serif;">Times New Roman</option>
                                <option value="Georgia" style="font-family: Georgia, serif;">Georgia</option>
                                <option value="Courier New" style="font-family: "Courier New", monospace;">Courier New</option>
                                <option value="Verdana" style="font-family: Verdana, sans-serif;">Verdana</option>
                                <option value="Roboto" style="font-family: "Roboto", sans-serif;">Roboto</option>
                                <option value="Tahoma" style="font-family: Tahoma, sans-serif;">Tahoma</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected> PESO </option>
                                <option value="100">Thin (100)</option>
                                <option value="200">Extra Light (200)</option>
                                <option value="300">Light (300)</option>
                                <option value="400">Normal (400)</option>
                                <option value="500">Medium (500)</option>
                                <option value="600">Semi Bold (600)</option>
                                <option value="700">Bold (700)</option>
                                <option value="800">Extra Bold (800)</option>
                                <option value="900">Black (900)</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected> ALTURA DA LINHA </option>
                                <option value="1.0">1.0 (Normal)</option>
                                <option value="1.2">1.2</option>
                                <option value="1.4">1.4</option>
                                <option value="1.5">1.5</option>
                                <option value="1.6">1.6</option>
                                <option value="1.8">1.8</option>
                                <option value="2.0">2.0</option>
                                <option value="2.5">2.5</option>
                                <option value="3.0">3.0</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="row g-3 my-2 mx-2">
                    <div class="col-sm-1">
                            <label for="exampleColorInput" class="form-label">Cor</label>
                            <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#f7f7f7" title="Choose your color">
                    </div>
                </div>
        </fieldset>
    ';
}

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






