<?php

function listar_opcoes_fontes() {
    // Lista de fontes padrão
    $fontes_padrao = array(
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
        $outputline .= '<option value="' . $title_peso = esc_attr($line) . '">' . esc_html($nome) . '</option>';
    }

    // Retornar o output
    return $outputline;
}


// Callback para o campo "Titulo"
function csp_title_size_callback() {
    $options = get_option('csp_settings');
    $title_size = isset($options['title_size']) ? esc_attr($options['title_size']) : '';
    $title_font = isset($options['title_font']) ? esc_attr($options['title_font']) : '';
    $title_peso = isset($options['title_peso']) ? esc_attr($options['title_peso']) : '400';
    $title_line = isset($options['title_line']) ? esc_attr($options['title_line']) : '1.0';
    $title_color = isset($options['title_color']) ? esc_attr($options['title_color']) : '';

    echo '
            <fieldset class="border my-4 p-2">
                <legend  class="float-none w-auto px-2">Título</legend>
                  
                    <div class="row g-3 my-2 mx-2">
                        <div class="col-sm-1">
                            <label for="exampleFormControlInput1" class="form-label">Tamanho da fonte</label>
                            <input type="text" class="form-control" name="csp_settings[title_size]" placeholder="Title Size" aria-label="Title" value="' . $title_size . '" />
                            <div id="emailHelp" class="form-text" style="color: #c00; font-style: italic;">Ex.: 1px, 1rem, 1% </div>
                        </div>
                       
                        <div class="col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Fonte</label>
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
                        <label for="exampleFormControlInput1" class="form-label">Peso da Fonte</label>
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
                            <label for="exampleFormControlInput1" class="form-label">Atura da linha</label>
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







