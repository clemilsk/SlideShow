<?php
/**
 * Classic Editor
 *
 * Plugin Name: Slidec
 * Plugin URI: https://www.behance.net/clemilsksouza
 * Description: Adiciona um custom post type para slides e exibe um por meio de Shortcode.
 * Version: 1.0
 * Requires at least: 5.8
 * Requires PHP: 5.6.20
 * Author: Clemilsk Souza
 * Author URI: https://github.com/clemilsk
 * License: GPLv2 or later
 * Domain Path: /languages
 * Text Domain: slidec
 */

if (!defined('ABSPATH')) {
    exit; // Impedir acesso direto
}

// Incluir arquivo de funções
require_once plugin_dir_path(__FILE__) . 'includes/cl-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-plugin-row-meta.php';
require_once plugin_dir_path(__FILE__) . 'includes/cl-callback.php';
require_once plugin_dir_path(__FILE__) . 'includes/cl-shortcode.php';


// Carregar arquivos de tradução
function cl_load_textdomain() {
    load_plugin_textdomain('cl-slide-languages', false, basename(dirname(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'cl_load_textdomain');