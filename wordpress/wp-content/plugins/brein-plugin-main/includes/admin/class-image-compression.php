<?php
/**
 * Image Compression
 *
 * Handles automatic and bulk image compression functionality.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class Brein_Image_Compression
 */
class Brein_Image_Compression
{

  /**
   * Batch size for bulk compression.
   *
   * @var int
   */
  private $batch_size = 50;

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
    add_action('add_attachment', array($this, 'compress_on_upload'));
    add_action('admin_menu', array($this, 'register_admin_page'));
    add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    add_action('wp_ajax_compress_images_ajax', array($this, 'ajax_handler'));
  }

  /**
   * Compress image on upload.
   *
   * @param int $attachment_id Attachment ID.
   */
  public function compress_on_upload($attachment_id)
  {
    $this->compress_image($attachment_id);
  }

  /**
   * Core compression function.
   *
   * Compresses an image file using Imagick and replaces the original file.
   * - Only processes files larger than 500KB.
   * - Only processes JPEG and PNG images.
   * - Resizes the image to a maximum of 2560×2560 (preserving aspect ratio).
   * - Converts it to WebP format with quality 75.
   *
   * @param int $attachment_id The attachment ID.
   * @return void
   */
  private function compress_image($attachment_id)
  {
    // Only proceed for JPEG and PNG files.
    $mime_type = get_post_mime_type($attachment_id);
    if (!in_array($mime_type, array('image/jpeg', 'image/png'), true)) {
      return;
    }

    $file = get_attached_file($attachment_id);
    if (!$file || !file_exists($file)) {
      return;
    }

    // Skip if file is smaller than 500KB.
    if (filesize($file) < 500 * 1024) {
      return;
    }

    // Build new file path: same directory, same filename but with .webp extension.
    $pathinfo = pathinfo($file);
    $new_file = $pathinfo['dirname'] . DIRECTORY_SEPARATOR . $pathinfo['filename'] . '.webp';

    try {
      // Initialize Imagick with the source image.
      $image = new Imagick($file);

      // Resize image to fit within 2560x2560 (keeping aspect ratio).
      $image->resizeImage(2560, 2560, Imagick::FILTER_LANCZOS, 1, true);

      // Convert to WebP format.
      $image->setImageFormat('webp');
      $image->setImageCompressionQuality(75);

      // Write the converted image to the new file path.
      $image->writeImage($new_file);

      // Free Imagick resources.
      $image->clear();
      $image->destroy();

      // Remove the original file.
      if (file_exists($file)) {
        unlink($file);
      }

      // Update the attachment to point to the new file.
      update_attached_file($attachment_id, $new_file);

      // Update the MIME type to image/webp.
      wp_update_post(array(
        'ID' => $attachment_id,
        'post_mime_type' => 'image/webp',
      ));

      // Regenerate attachment metadata.
      $metadata = wp_generate_attachment_metadata($attachment_id, $new_file);
      wp_update_attachment_metadata($attachment_id, $metadata);

    } catch (Exception $e) {
      error_log("Error compressing image for attachment {$attachment_id}: " . $e->getMessage());
    }
  }

  /**
   * Register admin page for bulk compression.
   */
  public function register_admin_page()
  {
    add_submenu_page(
      'upload.php',
      __('Compress All Images', 'brein-plugin'),
      __('Compress All Images', 'brein-plugin'),
      'manage_options',
      'compress-all-images',
      array($this, 'render_admin_page')
    );
  }

  /**
   * Render the admin page.
   */
  public function render_admin_page()
  {
    ?>
    <div class="wrap">
      <h1><?php esc_html_e('Compress All Images', 'brein-plugin'); ?></h1>
      <p>
        <?php esc_html_e('Clicking the button below will compress your Media Library images in batches of 50.', 'brein-plugin'); ?>
      </p>
      <button id="start-compression" class="button button-primary">
        <?php esc_html_e('Start Compression', 'brein-plugin'); ?>
      </button>
      <div id="compression-progress" style="margin-top:20px;"></div>
    </div>
    <?php
  }

  /**
   * Enqueue scripts for compression page.
   *
   * @param string $hook Current admin page hook.
   */
  public function enqueue_scripts($hook)
  {
    // Load only on our plugin page.
    if ('media_page_compress-all-images' !== $hook) {
      return;
    }

    wp_enqueue_script(
      'brein-compress-images-ajax',
      plugin_dir_url(dirname(dirname(__FILE__))) . 'assets/js/compress-images-ajax.js',
      array('jquery'),
      '1.0.0',
      true
    );

    wp_localize_script('brein-compress-images-ajax', 'compressImagesData', array(
      'ajaxUrl' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('compress_images_nonce'),
    ));
  }

  /**
   * AJAX handler to process each batch.
   */
  public function ajax_handler()
  {
    check_ajax_referer('compress_images_nonce', 'nonce');

    $current_batch = isset($_POST['batch']) ? intval($_POST['batch']) : 0;

    // Query for JPEG and PNG attachments.
    $args = array(
      'post_type' => 'attachment',
      'post_mime_type' => array('image/jpeg', 'image/png'),
      'posts_per_page' => $this->batch_size,
      'offset' => $current_batch * $this->batch_size,
      'post_status' => 'inherit',
      'fields' => 'ids',
      'no_found_rows' => false,
    );

    $query = new WP_Query($args);

    // If images are found, process the batch.
    if (!empty($query->posts)) {
      foreach ($query->posts as $attachment_id) {
        $this->compress_image($attachment_id);
      }

      $current_batch++;
      $response = array(
        'status' => 'processing',
        'batch' => $current_batch,
        'message' => sprintf(__('Processed batch %d.', 'brein-plugin'), $current_batch),
        'has_more' => true,
      );
    } else {
      // No images found – compression is complete.
      $response = array(
        'status' => 'completed',
        'message' => __('Compression complete.', 'brein-plugin'),
        'has_more' => false,
      );
    }

    wp_send_json($response);
  }
}
