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
        $links[1] = '<a href="' . esc_url($url) . '" target="_blank">Ver detalhes</a>';
    }

    return $links;
}
add_filter('plugin_row_meta', 'csp_custom_plugin_row_meta', 10, 2);
