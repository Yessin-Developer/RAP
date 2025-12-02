<?php
/**
 * ACF Filters
 *
 * Handles all ACF-related filters and customizations.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class Brein_ACF_Filters
 */
class Brein_ACF_Filters
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
    add_filter('acf/format_value/type=text', array($this, 'replace_asterisks_with_strong'));
    add_filter('acf/format_value/type=textarea', array($this, 'replace_asterisks_with_strong'));
    add_filter('wp_get_attachment_image_attributes', array($this, 'add_position_attributes'), 10, 2);
  }

  /**
   * Replace asterisks with strong tags in ACF text fields.
   *
   * @param string $string The field value.
   * @return string Modified value.
   */
  public function replace_asterisks_with_strong($string)
  {
    if (!is_string($string)) {
      return $string;
    }

    $string = preg_replace('/\*(.*?)\*/', '<strong>$1</strong>', $string);
    return $string;
  }

  /**
   * Add ACF position attributes to image.
   *
   * @param array        $attr       Image attributes.
   * @param WP_Post      $attachment Attachment post object.
   * @return array Modified attributes.
   */
  public function add_position_attributes($attr, $attachment)
  {
    $pos_x = get_field('pos_x', $attachment->ID);
    $pos_y = get_field('pos_y', $attachment->ID);

    if ($pos_x !== null && $pos_x !== '') {
      $attr['data-pos-x'] = esc_attr($pos_x);
    }

    if ($pos_y !== null && $pos_y !== '') {
      $attr['data-pos-y'] = esc_attr($pos_y);
    }

    return $attr;
  }
}
