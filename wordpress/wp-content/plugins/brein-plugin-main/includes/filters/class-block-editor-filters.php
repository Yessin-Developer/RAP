<?php
/**
 * Block Editor Filters
 *
 * Handles all block editor customizations and restrictions.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class Brein_Block_Editor_Filters
 */
class Brein_Block_Editor_Filters
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
    add_filter('allowed_block_types', array($this, 'filter_allowed_blocks'), 10, 2);
    add_filter('block_editor_settings_all', array($this, 'disable_code_editing'));
  }

  /**
   * Filter allowed block types.
   *
   * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
   * @param object     $block_editor_context The current block editor context.
   * @return array Filtered block types.
   */
  public function filter_allowed_blocks($allowed_block_types, $block_editor_context)
  {
    $disallowed_blocks = array(
      'core/archives',
      'core/audio',
      'core/avatar',
      'core/block',
      'core/button',
      'core/buttons',
      'core/calendar',
      'core/categories',
      'core/code',
      'core/column',
      'core/columns',
      'core/comment-author-avatar',
      'core/comment-author-name',
      'core/comment-content',
      'core/comment-date',
      'core/comment-edit-link',
      'core/comment-reply-link',
      'core/comment-template',
      'core/comments',
      'core/comments-pagination',
      'core/comments-pagination-next',
      'core/comments-pagination-numbers',
      'core/comments-pagination-previous',
      'core/comments-title',
      'core/cover',
      'core/details',
      'core/embed',
      'core/file',
      'core/footnotes',
      'core/form',
      'core/form-input',
      'core/form-submission-notification',
      'core/form-submit-button',
      'core/freeform',
      'core/gallery',
      'core/quote',
      'core/preformatted',
      'core/pullquote',
      'core/verse',
      'core/table',
      'core/video',
      'core/group',
      'core/heading',
      'core/home-link',
      'core/html',
      'core/image',
      'core/latest-comments',
      'core/latest-posts',
      'core/loginout',
      'core/media-text',
      'core/missing',
      'core/more',
      'core/navigation',
      'core/navigation-link',
      'core/navigation-submenu',
      'core/nextpage',
      'core/page-list',
      'core/separator',
      'core/spacer',
      'core/rss',
      'core/search',
      'core/social-icons',
      'core/tag-cloud',
    );

    if (!is_array($allowed_block_types) || empty($allowed_block_types)) {
      $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
      $allowed_block_types = array_keys($registered_blocks);
    }

    // Filter out disallowed blocks.
    $filtered_blocks = array();
    foreach ($allowed_block_types as $block) {
      if (!in_array($block, $disallowed_blocks, true)) {
        $filtered_blocks[] = $block;
      }
    }

    return $filtered_blocks;
  }

  /**
   * Disable code editing in block editor.
   *
   * @param array $settings Block editor settings.
   * @return array Modified settings.
   */
  public function disable_code_editing($settings)
  {
    $settings['codeEditingEnabled'] = false;
    return $settings;
  }
}
