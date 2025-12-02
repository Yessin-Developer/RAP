<?php
/**
 * Header & Footer Scripts Settings
 *
 * Allows admins to inject scripts/styles in the <head> and before </body>.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

class Brein_Scripts_Settings
{
  /** @var string */
  private $option_name = 'brein_scripts_options';

  /** @var string|null */
  private $page_hook_suffix = null;

  public function __construct()
  {
    add_action('admin_menu', array($this, 'register_menu'));
    add_action('admin_init', array($this, 'register_settings'));
    add_action('admin_init', array($this, 'fix_legacy_slugs'));
    add_action('wp_head', array($this, 'print_head_scripts'), 99);
    add_action('wp_footer', array($this, 'print_footer_scripts'), 99);
  }

  /**
   * Add submenu under Buro Brein.
   */
  public function register_menu()
  {
    $this->page_hook_suffix = add_submenu_page(
      'brein',
      __('Scripts (Header & Footer)', 'brein-plugin'),
      __('Scripts', 'brein-plugin'),
      'manage_options',
      'brein-plugin-scripts',
      array($this, 'render_settings_page'),
      1
    );
  }

  public function register_settings()
  {
    register_setting(
      'brein_scripts_group',
      $this->option_name,
      array(
        'type' => 'array',
        'sanitize_callback' => array($this, 'sanitize_options'),
        'default' => array(),
      )
    );

    add_settings_section('brein_scripts_section', __('Header & Footer Scripts', 'brein-plugin'), '__return_false', 'brein-plugin-scripts');

    add_settings_field('brein_scripts_head', __('Head (before </head>)', 'brein-plugin'), array($this, 'render_textarea_field'), 'brein-plugin-scripts', 'brein_scripts_section', array(
      'key' => 'head',
      'description' => __('Paste HTML/JS. Avoid PHP. Will output on the frontend only.', 'brein-plugin'),
    ));

    add_settings_field('brein_scripts_footer', __('Footer (before </body>)', 'brein-plugin'), array($this, 'render_textarea_field'), 'brein-plugin-scripts', 'brein_scripts_section', array(
      'key' => 'footer',
      'description' => __('Paste HTML/JS. Avoid PHP. Will output on the frontend only.', 'brein-plugin'),
    ));
  }

  /**
   * Sanitize options.
   */
  public function sanitize_options($input)
  {
    $output = array();
    if (!is_array($input)) {
      return $output;
    }
    // Allow only a safe subset of HTML; scripts allowed intentionally.
    $allowed = array(
      'script' => array(
        'type' => true,
        'src' => true,
        'async' => true,
        'defer' => true,
        'id' => true,
        'data-*' => true,
      ),
      'style' => array('type' => true, 'media' => true),
      'noscript' => array(),
      'link' => array('rel' => true, 'href' => true, 'as' => true, 'crossorigin' => true, 'media' => true),
      'meta' => array('name' => true, 'content' => true, 'property' => true),
      'div' => array('id' => true, 'class' => true, 'data-*' => true),
      'span' => array('id' => true, 'class' => true, 'data-*' => true),
    );

    if (isset($input['head'])) {
      $output['head'] = wp_kses((string) $input['head'], $allowed);
    }
    if (isset($input['footer'])) {
      $output['footer'] = wp_kses((string) $input['footer'], $allowed);
    }
    return $output;
  }

  public function render_textarea_field($args)
  {
    $options = get_option($this->option_name, array());
    $key = isset($args['key']) ? $args['key'] : '';
    $value = isset($options[$key]) ? (string) $options[$key] : '';
    ?>
    <textarea rows="10" class="large-text code"
      name="<?php echo esc_attr($this->option_name . '[' . $key . ']'); ?>"><?php echo esc_textarea($value); ?></textarea>
    <?php if (!empty($args['description'])): ?>
      <p class="description"><?php echo esc_html($args['description']); ?></p>
    <?php endif; ?>
  <?php
  }

  public function render_settings_page()
  {
    ?>
    <div class="wrap">
      <h1><?php esc_html_e('Scripts (Header & Footer)', 'brein-plugin'); ?></h1>
      <form action="options.php" method="post">
        <?php
        settings_fields('brein_scripts_group');
        do_settings_sections('brein-plugin-scripts');
        submit_button();
        ?>
      </form>
    </div>
    <?php
  }

  /**
   * Redirect legacy/wrong slugs to the correct settings page slug.
   */
  public function fix_legacy_slugs()
  {
    if (!is_admin()) {
      return;
    }
    $page = isset($_GET['page']) ? (string) $_GET['page'] : '';
    if ($page === 'brein-scripts' || $page === 'brien-scripts') {
      wp_safe_redirect(admin_url('admin.php?page=brein-plugin-scripts'));
      exit;
    }
  }

  /**
   * Print sanitized head scripts on frontend only.
   */
  public function print_head_scripts()
  {
    if (is_admin()) {
      return;
    }
    $options = get_option($this->option_name, array());
    if (!empty($options['head'])) {
      echo $options['head'];
    }
  }

  /**
   * Print sanitized footer scripts on frontend only.
   */
  public function print_footer_scripts()
  {
    if (is_admin()) {
      return;
    }
    $options = get_option($this->option_name, array());
    if (!empty($options['footer'])) {
      echo $options['footer'];
    }
  }
}
