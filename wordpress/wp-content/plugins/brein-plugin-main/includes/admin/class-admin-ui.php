<?php
/**
 * Admin UI Customizations
 *
 * Handles admin interface customizations like resizable sidebar.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class Brein_Admin_UI
 */
class Brein_Admin_UI
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
    add_action('admin_enqueue_scripts', array($this, 'enqueue_jquery_ui'));
    add_action('admin_head', array($this, 'resizable_sidebar'));
  }

  /**
   * Enqueue jQuery UI resizable.
   */
  public function enqueue_jquery_ui()
  {
    wp_enqueue_script('jquery-ui-resizable');
  }

  /**
   * Add resizable sidebar functionality.
   */
  public function resizable_sidebar()
  {
    ?>
    <style>
      .interface-interface-skeleton__sidebar .interface-complementary-area,
      .interface-complementary-area__fill {
        width: 100% !important;
      }

      .is-sidebar-opened .interface-interface-skeleton__sidebar {
        width: 350px;
      }

      /*UI Styles*/
      .ui-dialog .ui-resizable-n {
        height: 2px;
        top: 0;
      }

      .ui-dialog .ui-resizable-e {
        width: 2px;
        right: 0;
      }

      .ui-dialog .ui-resizable-s {
        height: 2px;
        bottom: 0;
      }

      .ui-dialog .ui-resizable-w {
        width: 2px;
        left: 0;
      }

      .ui-dialog .ui-resizable-se,
      .ui-dialog .ui-resizable-sw,
      .ui-dialog .ui-resizable-ne,
      .ui-dialog .ui-resizable-nw {
        width: 7px;
        height: 7px;
      }

      .ui-dialog .ui-resizable-se {
        right: 0;
        bottom: 0;
      }

      .ui-dialog .ui-resizable-sw {
        left: 0;
        bottom: 0;
      }

      .ui-dialog .ui-resizable-ne {
        right: 0;
        top: 0;
      }

      .ui-dialog .ui-resizable-nw {
        left: 0;
        top: 0;
      }

      .ui-draggable .ui-dialog-titlebar {
        cursor: move;
      }

      .ui-draggable-handle {
        -ms-touch-action: none;
        touch-action: none;
      }

      .ui-resizable {
        position: relative;
      }

      .ui-resizable-handle {
        position: absolute;
        font-size: 0.1px;
        display: block;
        -ms-touch-action: none;
        touch-action: none;
      }

      .ui-resizable-disabled .ui-resizable-handle,
      .ui-resizable-autohide .ui-resizable-handle {
        display: none;
      }

      .ui-resizable-n {
        cursor: n-resize;
        height: 7px;
        width: 100%;
        top: -5px;
        left: 0;
      }

      .ui-resizable-s {
        cursor: s-resize;
        height: 7px;
        width: 100%;
        bottom: -5px;
        left: 0;
      }

      .ui-resizable-e {
        cursor: e-resize;
        width: 7px;
        right: -5px;
        top: 0;
        height: 100%;
      }

      .ui-resizable-w {
        cursor: w-resize;
        width: 7px;
        left: -5px;
        top: 0;
        height: 100%;
      }

      .ui-resizable-se {
        cursor: se-resize;
        width: 12px;
        height: 12px;
        right: 1px;
        bottom: 1px;
      }

      .ui-resizable-sw {
        cursor: sw-resize;
        width: 9px;
        height: 9px;
        left: -5px;
        bottom: -5px;
      }

      .ui-resizable-nw {
        cursor: nw-resize;
        width: 9px;
        height: 9px;
        left: -5px;
        top: -5px;
      }

      .ui-resizable-ne {
        cursor: ne-resize;
        width: 9px;
        height: 9px;
        right: -5px;
        top: -5px;
      }
    </style>

    <script>
      jQuery(window).ready(function () {
        setTimeout(function () {
          jQuery('.interface-interface-skeleton__sidebar, .interface-complementary-area__fill').width(localStorage.getItem('toast_sidebar_width'))
          jQuery('.interface-interface-skeleton__sidebar').resizable({
            handles: 'w',
            resize: function (event, ui) {
              jQuery(this).css({ 'left': 0 });
              localStorage.setItem('toast_sidebar_width', jQuery(this).width());
            }
          });
        }, 500)
      });
    </script>
    <?php
  }
}
