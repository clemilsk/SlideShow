<?php
/*
Plugin Name: CL-Slider
Plugin URI: https://www.behance.net/clemilsksouza
Description: Adiciona um custom post type para slides e exibe um por meio de Shortcode.
Version: 1.0
Author: Clemilsk Souza
Author URI: https://github.com/clemilsk
Text Domain: cl-slide
Domain Path: /languages
License: GPLv2 or later
*/

if (!defined('ABSPATH')) {
    exit; // Impedir acesso direto
}

// Incluir arquivo de funções
require_once plugin_dir_path(__FILE__) . 'includes/cl-functions.php';

// Carregar arquivos de tradução
function cl_load_textdomain() {
    load_plugin_textdomain('cl-slide-languages', false, basename(dirname(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'cl_load_textdomain');

// Alterar o texto do link "Plugin URI" na listagem de plugins
function csp_custom_plugin_row_meta($links, $file) {
    // Nome do arquivo principal do plugin
    $plugin = plugin_basename(__FILE__);

    // Verifica se é o plugin certo
    if ($file == $plugin) {
        // URL desejada para "Ver detalhes"
        $url = 'https://www.behance.net/clemilsksouza';

        // Texto a ser exibido
        $links[2] = '<a href="' . esc_url($url) . '" target="_blank">Ver detalhes</a>';
    }

    return $links;
}
add_filter('plugin_row_meta', 'csp_custom_plugin_row_meta', 10, 2);

// Adicionar link "Opções" na listagem de plugins
function csp_add_settings_link($links) {
    // URL da página de opções/configurações
    $settings_url = admin_url('admin.php?page=csp-plugin-settings');

    // Adiciona o link "Opções"
    $settings_link = '<a href="' . esc_url($settings_url) . '">Opções</a>';
    
    // Adiciona o link ao início da lista de links
    array_unshift($links, $settings_link);
    
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'csp_add_settings_link');

// Adicionar uma página de opções ao menu do plugin
function csp_add_settings_submenu() {
    add_submenu_page(
        'edit.php?post_type=slide', // O slug do menu pai (o Custom Post Type "Slide")
        'Configurações do Slideshow', // Título da página
        'Opções', // Título do menu
        'manage_options', // Capacidade necessária
        'csp-plugin-settings', // Slug da página de opções
        'csp_display_settings_page' // Função que exibe o conteúdo da página
    );
}
add_action('admin_menu', 'csp_add_settings_submenu');

// Função para exibir o conteúdo da página de configurações
function csp_display_settings_page() {
    ?>
    <div class="wrap">
        <h1>Configurações do Slideshow</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('csp-settings-group');
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
    register_setting('csp-settings-group', 'csp_settings');

    // Adicionar uma seção
    add_settings_section(
        'csp_settings_section',
        'Configurações Gerais',
        'csp_settings_section_callback',
        'csp-plugin-settings'
    );

    // Adicionar campos de configuração
    add_settings_field(
        'csp_arrow_size',
        'Tamanho das Setas',
        'csp_arrow_size_callback',
        'csp-plugin-settings',
        'csp_settings_section'
    );

    add_settings_field(
        'csp_slide_size',
        'Tamanho dos Slides',
        'csp_slide_size_callback',
        'csp-plugin-settings',
        'csp_settings_section'
    );
}
add_action('admin_init', 'csp_register_settings');

// Callback da seção
function csp_settings_section_callback() {
    echo 'Aqui você pode configurar as opções do slideshow.';
}

// Callback para o campo "Tamanho das Setas"
function csp_arrow_size_callback() {
    $options = get_option('csp_settings');
    $arrow_size = isset($options['arrow_size']) ? esc_attr($options['arrow_size']) : '';
    echo '<input type="text" name="csp_settings[arrow_size]" value="' . $arrow_size . '" />';
}

// Callback para o campo "Tamanho dos Slides"
function csp_slide_size_callback() {
    $options = get_option('csp_settings');
    $slide_size = isset($options['slide_size']) ? esc_attr($options['slide_size']) : '';
    echo '<input type="text" name="csp_settings[slide_size]" value="' . $slide_size . '" />';
}