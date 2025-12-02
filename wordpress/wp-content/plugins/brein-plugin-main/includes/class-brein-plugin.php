<?php
/**
 * Main Plugin Class
 *
 * Orchestrates all plugin functionality.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class Brein_Plugin
 */
class Brein_Plugin
{

  /**
   * Plugin version.
   *
   * @var string
   */
  private $version = '2.0.0';

  /**
   * Plugin directory path.
   *
   * @var string
   */
  private $plugin_path;

  /**
   * Plugin directory URL.
   *
   * @var string
   */
  private $plugin_url;

  /**
   * Main plugin file.
   *
   * @var string
   */
  private $plugin_file;

  /**
   * Initialize the plugin.
   *
   * @param string $plugin_file Main plugin file path.
   */
  public function __construct($plugin_file)
  {
    $this->plugin_file = $plugin_file;
    $this->plugin_path = plugin_dir_path($plugin_file);
    $this->plugin_url = plugin_dir_url($plugin_file);

    $this->load_dependencies();
    $this->init_components();
  }

  /**
   * Load required dependencies.
   */
  private function load_dependencies()
  {
    // Autoload Composer dependencies.
    require_once $this->plugin_path . 'vendor/autoload.php';

    // Load plugin update checker.
    require_once $this->plugin_path . 'plugin-update-checker/plugin-update-checker.php';

    // Load includes.
    require_once $this->plugin_path . 'incl/incl.vite.php';

    // Load class files.
    require_once $this->plugin_path . 'includes/admin/class-burobrein-menu.php';
    require_once $this->plugin_path . 'includes/admin/class-scripts.php';
    require_once $this->plugin_path . 'includes/filters/class-acf-filters.php';
    require_once $this->plugin_path . 'includes/filters/class-block-editor-filters.php';
    require_once $this->plugin_path . 'includes/filters/class-media-filters.php';
    require_once $this->plugin_path . 'includes/admin/class-admin-ui.php';
    // Frontend assets loader
    require_once $this->plugin_path . 'includes/frontend/class-frontend-assets.php';
    require_once $this->plugin_path . 'includes/admin/class-qam.php';
    require_once $this->plugin_path . 'includes/class-qam-render.php';
    require_once $this->plugin_path . 'includes/admin/class-image-compression.php';
    require_once $this->plugin_path . 'includes/updater/class-plugin-updater.php';
    require_once $this->plugin_path . 'includes/cli/class-cli-loader.php';
  }

  /**
   * Initialize plugin components.
   */
  private function init_components()
  {
    // Initialize Acorn framework.
    // new Brein_Acorn_Bootstrap();

    // Initialize filters.
    new Brein_ACF_Filters();
    new Brein_Media_Filters();
    // new Brein_Block_Editor_Filters();

    // Scripts settings need to hook on frontend as well (wp_head/wp_footer)
    new Brein_Scripts_Settings();

    // Initialize admin components.
    if (is_admin()) {
      new Brein_BuroBrein_Menu();
      new Brein_Admin_UI();
      new Brein_QAM();
      new Brein_Image_Compression();
    }

    // Shortcodes and template tags available on frontend and admin.
    new Brein_QAM_Render();

    // Initialize frontend assets on non-admin (public) side.
    if (!is_admin()) {
      new Brein_Frontend_Assets();
    }

    // Initialize updater.
    new Brein_Plugin_Updater($this->plugin_file);

    // Initialize CLI loader.
    if (defined('WP_CLI') && WP_CLI) {
      new Brein_CLI_Loader($this->plugin_path . 'commands');
    }
  }

  /**
   * Get plugin version.
   *
   * @return string
   */
  public function get_version()
  {
    return $this->version;
  }

  /**
   * Get plugin path.
   *
   * @return string
   */
  public function get_plugin_path()
  {
    return $this->plugin_path;
  }

  /**
   * Get plugin URL.
   *
   * @return string
   */
  public function get_plugin_url()
  {
    return $this->plugin_url;
  }
}
