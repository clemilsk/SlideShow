<?php
function listar_align_flex()
{
    // Array com os pesos de fonte e seus respectivos nomes
    $align_item_cl = array(
        'stretch' => 'stretch',
        'flex-start' => 'flex-start',
        'flex-end' => 'flex-end',
        'start' => 'start',
        'end' => 'end',
        'center' => 'center',
        'baseline' => 'baseline',
        'first baseline' => 'first baseline',
        'last baseline' => 'last baseline'
    );

    // Iniciar o output do <select>
    $output_st = '';

    // Loop para criar as <option> para cada peso de fonte
    foreach ($align_item_cl as $value_ai => $nome_ai) {
        $output_st .= '<option value="' . $align_item_cl = esc_attr($value_ai) . '">' . esc_html($nome_ai) . '</option>';
    }

    // Retornar o output
    return $output_st;
}

function csp_align_text_callback()
{
    $options = get_option('csp_settings');
    $align_item_cl = isset($options['align_item_cl']) ? esc_attr($options['align_item_cl']) : '';

    echo '
                <div class="row">
                    <div class="col-4">
                        <fieldset class="border my-4 p-2">
                            <legend  class="float-none w-auto px-2">Alinhar conteúdo</legend>
                            
                            <div class="row g-3 my-2 mx-2">
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">Alinhamento</label>
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="csp_settings[align_item_cl]" aria-label="Floating label select example">
                                            <option selected>' . $align_item_cl . '</option>' ?>
                                                <?php echo listar_align_flex(); ?>
                                            <?php
    echo '   
                                        </select>
                                    </div>
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
