<?php

/**
 * Plugin Name: Post Layouts
 * Plugin URI: https://wordpress.org/plugins/post-layouts/
 * Description: Responsive post layout block with grid, list, and template-style post displays.
 * Author: Techeshta
 * Author URI: https://www.techeshta.com
 * Version: 2.0.0
 * Requires at least: 5.0
 * Tested up to: 7.0
 * Requires PHP: 5.6
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: post-layouts
 * Domain Path: /languages
 */
/**
 * Exit if accessed directly
 */

if (!defined('ABSPATH')) {
    exit;
}

define('POST_LAYOUTS_DOMAIN', 'post-layouts');
define('POST_LAYOUTS_DIR', plugin_dir_path(__FILE__));
define('POST_LAYOUTS_URL', plugins_url('/', __FILE__));
define('POST_LAYOUTS_VERSION', '2.0.0');

/**
 * Initialize the blocks
 */
function post_layouts_gutenberg_loader() {
    /**
     * Load the blocks functionality
     */
    require_once ( POST_LAYOUTS_DIR . 'dist/init.php');

    /**
     * Load Post Grid PHP
     */
    require_once ( POST_LAYOUTS_DIR . 'src/blocks/index.php');
}

add_action('plugins_loaded', 'post_layouts_gutenberg_loader');

/**
 * Load the plugin text-domain
 */
// WordPress 4.6+ automatically loads translations for plugin slugs on WordPress.org.
// No manual load_plugin_textdomain() call is needed for this plugin.

/**
 * Add a check for our plugin before redirecting
 */
function post_layouts_gutenberg_activate() {
    add_option('post_layouts_gutenberg_do_activation_redirect', true);
}

register_activation_hook(__FILE__, 'post_layouts_gutenberg_activate');

/**
 * Add image sizes
 */
function post_layouts_gutenberg_image_sizes() {
    // Post Grid Block
    add_image_size('pl-blogpost-landscape', 600, 400, true);
    add_image_size('pl-blogpost-square', 600, 600, true);
}

add_action('after_setup_theme', 'post_layouts_gutenberg_image_sizes');
