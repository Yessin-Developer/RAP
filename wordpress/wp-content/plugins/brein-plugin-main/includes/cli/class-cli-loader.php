<?php
/**
 * CLI Commands Loader
 *
 * Loads all WP-CLI command files.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class Brein_CLI_Loader
 */
class Brein_CLI_Loader
{

  /**
   * Commands directory.
   *
   * @var string
   */
  private $commands_dir;

  /**
   * Initialize the CLI loader.
   *
   * @param string $commands_dir Path to commands directory.
   */
  public function __construct($commands_dir)
  {
    $this->commands_dir = $commands_dir;
    $this->init_hooks();
  }

  /**
   * Register hooks.
   */
  private function init_hooks()
  {
    add_action('cli_init', array($this, 'load_commands'));
  }

  /**
   * Load all command files.
   */
  public function load_commands()
  {
    $files = glob($this->commands_dir . '/*.php');

    if (is_array($files)) {
      foreach ($files as $file) {
        require_once $file;
      }
    }
  }
}
