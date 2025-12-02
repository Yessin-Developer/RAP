<?php
/**
 * Plugin Updater
 *
 * Handles automatic plugin updates from GitHub.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

/**
 * Class Brein_Plugin_Updater
 */
class Brein_Plugin_Updater
{

  /**
   * Update checker instance.
   *
   * @var object
   */
  private $update_checker;

  /**
   * GitHub repository URL.
   *
   * @var string
   */
  private $github_url = 'https://github.com/Buro-Brein/brein-plugin/';

  /**
   * GitHub access token.
   *
   * @var string
   */
  private $github_token = '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';

  /**
   * Main plugin file.
   *
   * @var string
   */
  private $plugin_file;

  /**
   * Plugin slug.
   *
   * @var string
   */
  private $plugin_slug = 'brein-plugin';

  /**
   * Initialize the updater.
   *
   * @param string $plugin_file Main plugin file path.
   */
  public function __construct($plugin_file)
  {
    $this->plugin_file = $plugin_file;
    $this->init_update_checker();
  }

  /**
   * Initialize the update checker.
   */
  private function init_update_checker()
  {
    $this->update_checker = PucFactory::buildUpdateChecker(
      $this->github_url,
      $this->plugin_file,
      $this->plugin_slug
    );

    // Set the branch that contains the stable release.
    $this->update_checker->getVcsApi()->enableReleaseAssets();

    // Set authentication for private repository.
    $this->update_checker->setAuthentication($this->github_token);
  }

  /**
   * Get the update checker instance.
   *
   * @return object
   */
  public function get_update_checker()
  {
    return $this->update_checker;
  }
}
