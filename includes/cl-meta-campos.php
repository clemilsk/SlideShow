<?php

// Alterar o texto do link "Plugin URI" na listagem de plugins
function csp_custom_plugin_row_meta($links, $file) {
    // Obtém o caminho base do plugin
    $plugin = plugin_basename(__FILE__);

    // Verifica se o arquivo atual é o do plugin em questão
    if ($file === $plugin) {
        // Define a URL personalizada para o link
        $custom_url = 'https://www.behance.net/clemilsksouza';

        // Define o texto a ser exibido
        $custom_text = esc_html__('Ver detalhes', 'csp-textdomain');

        // Substitui o link "Plugin URI" pelo link personalizado
        if (isset($links[2])) {
            $links[2] = '<a href="' . esc_url($custom_url) . '" target="_blank" rel="noopener noreferrer">' . $custom_text . '</a>';
        }
    }

    return $links;
}
add_filter('plugin_row_meta', 'csp_custom_plugin_row_meta', 10, 2);

// Adicionar link "Opções" na listagem de plugins
function csp_add_settings_link($links) {
    // Definir o slug da página de opções do plugin
    $settings_page_slug = 'csp-plugin-settings';
    
    // Gerar a URL completa para a página de opções/configurações
    $settings_url = admin_url('admin.php?page=' . $settings_page_slug);

    // Criar o link "Opções" com segurança para evitar XSS
    $settings_link = '<a href="' . esc_url($settings_url) . '">' . esc_html__('Opções', 'csp-textdomain') . '</a>';
    
    // Adicionar o link "Opções" ao início da lista de links
    array_unshift($links, $settings_link);
    
    return $links;
}

// Adicionar o filtro para o plugin específico
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'csp_add_settings_link');

// Adicionar uma página de opções ao menu do Custom Post Type "Slide"
function csp_add_settings_submenu() {
    // Parâmetros para a página de opções
    $parent_slug = 'edit.php?post_type=slide'; // Slug do menu pai (CPT "Slide")
    $page_title = __('Configurações do Slideshow', 'csp-textdomain'); // Título da página
    $menu_title = __('Opções', 'csp-textdomain'); // Título do menu
    $capability = 'manage_options'; // Capacidade necessária para acessar
    $menu_slug  = 'csp-plugin-settings'; // Slug da página de opções
    $callback   = 'csp_display_settings_page'; // Função que exibe o conteúdo da página

    // Adicionar a página de submenu
    add_submenu_page(
        $parent_slug,
        $page_title,
        $menu_title,
        $capability,
        $menu_slug,
        $callback
    );
}
add_action('admin_menu', 'csp_add_settings_submenu');

// Função de callback para exibir o conteúdo da página de configurações
function csp_display_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('', 'csp-textdomain'); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Gera os campos de configuração para a página de opções
            settings_fields('csp_settings_group');
            do_settings_sections('csp-plugin-settings'); 
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Registrar configurações do plugin
function csp_register_settings() {
    // Registrar um grupo de configurações
    register_setting('csp_settings_group', 'csp_settings');

    // Adicionar uma seção
    add_settings_section(
        'csp_geral_section',
        'Configurações Gerais',
        'csp_geral_section_callback',
        'csp-plugin-settings'
    );
    
    // Adicionar campos para título
    add_settings_field(
        'csp_title_size',
        '',
        'csp_title_size_callback',
        'csp-plugin-settings',
        'csp_geral_section'
    );

    // Adicionar campos para Sub-título
    add_settings_field(
        'csp_subtitle_size',
        '',
        'csp_subtitle_size_callback',
        'csp-plugin-settings',
        'csp_geral_section'
    );

     // Adicionar campos para Button
     add_settings_field(
        'csp_btn',
        '',
        'csp_btn_callback',
        'csp-plugin-settings',
        'csp_geral_section'
    );

    /* Adicionar campos de configuração
    add_settings_field(
        'csp_arrow_size',
        '',
        'csp_arrow_size_callback',
        'csp-plugin-settings',
        'csp_geral_section',
        [
            'label_for' => 'csp_arrow_size',
            'class' => 'setas_my',
        ]
        
    );

    add_settings_field(
        'csp_slide_size',
        '',
        'csp_slide_size_callback',
        'csp-plugin-settings',
        'csp_geral_section'
    );*/

}
add_action('admin_init', 'csp_register_settings');
