<?php
/**
 * Frontend Assets Loader
 *
 * Enqueues plugin CSS/JS on the public-facing site.
 * Supports Vite dev server and production manifest assets.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class Brein_Frontend_Assets
 */
class Brein_Frontend_Assets
{
  /**
   * Initialize hooks.
   */
  public function __construct()
  {
    $this->init_hooks();
  }

  /**
   * Register WordPress hooks for enqueuing assets.
   */
  private function init_hooks()
  {
    add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
  }

  /**
   * Enqueue frontend assets depending on environment.
   *
   * Uses constants defined in `incl/incl.vite.php`.
   */
  public function enqueue_assets()
  {
    if (defined('BBP_IS_VITE_DEVELOPMENT') && BBP_IS_VITE_DEVELOPMENT === true) {
      // Development: inject Vite client and frontend entry for HMR.
      add_action('wp_head', function () {
        echo '<script type="module" src="' . esc_url(BBP_VITE_SERVER . '/@vite/client') . '"></script>';
        echo '<script type="module" crossorigin src="' . esc_url(BBP_VITE_SERVER . BBP_VITE_ENTRY_FRONT) . '"></script>';
      });
      return;
    }

    // Production: read Vite manifest and enqueue built assets.
    $manifest_path = trailingslashit(BBP_DIST_PATH) . '.vite/manifest.json';
    if (!file_exists($manifest_path)) {
      return;
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);
    if (!is_array($manifest)) {
      return;
    }

    // Target the named entry 'front' only
    $entry = isset($manifest['front']) ? $manifest['front'] : null;

    if (!$entry) {
      // Fallback: find an entry file starting with 'front-'
      foreach ($manifest as $value) {
        if (!empty($value['isEntry']) && isset($value['file'])) {
          $basename = basename($value['file']);
          if (strpos($basename, 'front-') === 0) {
            $entry = $value;
            break;
          }
        }
      }
    }

    if (!$entry) {
      return;
    }

    if (isset($entry['css']) && is_array($entry['css'])) {
      foreach ($entry['css'] as $css_file) {
        wp_enqueue_style(
          'brein-plugin-frontend-' . basename($css_file),
          trailingslashit(BBP_DIST_URI) . ltrim($css_file, '/'),
          array(),
          null
        );
      }
    }

    if (!empty($entry['file'])) {
      wp_enqueue_script(
        'brein-plugin-frontend-' . basename($entry['file']),
        trailingslashit(BBP_DIST_URI) . ltrim($entry['file'], '/'),
        defined('BBP_JS_DEPENDENCY') ? BBP_JS_DEPENDENCY : array(),
        null,
        defined('BBP_JS_LOAD_IN_FOOTER') ? BBP_JS_LOAD_IN_FOOTER : true
      );
    }
  }
}
