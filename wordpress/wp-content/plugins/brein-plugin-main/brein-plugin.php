<?php
/**
 * Plugin Name: Buro Brein Plugin
 * Description: De Buro Brein Plugin met custom functies
 * Version: 2.2.4
 * Author: Buro Brein
 *
 * @package BreinPlugin
 */

/**
 * Development mode toggle.
 * Set to false for production.
 */
define('BBP_IS_VITE_DEVELOPMENT', false);

/**
 * Load the main plugin class and initialize.
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-brein-plugin.php';

/**
 * Initialize the plugin.
 */
function run_brein_plugin()
{
    $plugin = new Brein_Plugin(__FILE__);
    return $plugin;
}

// Run the plugin.
run_brein_plugin();