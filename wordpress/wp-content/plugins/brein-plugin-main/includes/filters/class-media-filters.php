<?php
/**
 * Media Filters
 *
 * Handles media-related filters and customizations.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class Brein_Media_Filters
 */
class Brein_Media_Filters
{

  /**
   * Initialize the class and set its properties.
   */
  public function __construct()
  {
    $this->init_hooks();
  }

  /**
   * Register hooks.
   */
  private function init_hooks()
  {
    add_filter('jpeg_quality', array($this, 'set_jpeg_quality'));
    add_filter('big_image_size_threshold', '__return_false');
  }

  /**
   * Set JPEG quality to maximum.
   *
   * @param int $quality Default quality.
   * @return int Maximum quality.
   */
  public function set_jpeg_quality($quality)
  {
    return 100;
  }
}
