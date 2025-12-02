<?php
/**
 * Quick Action Menu (QAM) – Simple settings page
 *
 * Registers a top-level admin page with a handful of text fields
 * to configure QAM items and basic branding without ACF/CPT.
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class Brein_QAM
 */
class Brein_QAM
{

  /**
   * Option name in wp_options.
   *
   * @var string
   */
  private $option_name = 'brein_qam_options';

  /**
   * Hook suffix for our settings page.
   *
   * @var string|null
   */
  private $page_hook_suffix = null;

  /**
   * Initialize hooks.
   */
  public function __construct()
  {
    add_action('admin_menu', array($this, 'register_menu'));
    add_action('admin_init', array($this, 'register_settings'));
    add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
  }

  /**
   * Register top-level QAM admin menu.
   */
  public function register_menu()
  {
    $this->page_hook_suffix = add_submenu_page(
      'brein',
      __('Quick Action Menu', 'brein-plugin'),
      __('Quick Action Menu', 'brein-plugin'),
      'manage_options',
      'brein-qam',
      array($this, 'render_settings_page')
    );
  }

  /**
   * Register settings and fields.
   */
  public function register_settings()
  {
    register_setting(
      'brein_qam_group',
      $this->option_name,
      array(
        'type' => 'array',
        'sanitize_callback' => array($this, 'sanitize_options'),
        'default' => array(),
      )
    );
    // Sections and fields defined in one place, then registered generically.
    $sections = $this->get_sections_config();

    foreach ($sections as $section_id => $section) {
      add_settings_section(
        $section_id,
        $section['title'],
        '__return_false',
        'brein-qam'
      );

      if (!empty($section['fields']) && is_array($section['fields'])) {
        foreach ($section['fields'] as $field) {
          $this->add_field_by_type($field, $section_id);
        }
      }
    }
  }

  /**
   * Return the structured config for sections and fields.
   *
   * @return array
   */
  private function get_sections_config()
  {
    return array(
      'brein_qam_section_phone' => array(
        'title' => __('Phone', 'brein-plugin'),
        'fields' => array(
          array('type' => 'text', 'key' => 'phone_label', 'label' => __('Label', 'brein-plugin')),
          array('type' => 'text', 'key' => 'phone_url', 'label' => __('URL/action', 'brein-plugin'), 'description' => __('bv. tel:+3112345678', 'brein-plugin')),
          array('type' => 'textarea', 'key' => 'phone_icon_svg', 'label' => __('Icon (SVG code)', 'brein-plugin'), 'description' => __('Plak hier de volledige SVG code', 'brein-plugin')),
        ),
      ),
      'brein_qam_section_email' => array(
        'title' => __('Email', 'brein-plugin'),
        'fields' => array(
          array('type' => 'text', 'key' => 'email_label', 'label' => __('Label', 'brein-plugin')),
          array('type' => 'text', 'key' => 'email_url', 'label' => __('URL/action', 'brein-plugin'), 'description' => __('bv. mailto:info@example.com', 'brein-plugin')),
          array('type' => 'textarea', 'key' => 'email_icon_svg', 'label' => __('Icon (SVG code)', 'brein-plugin'), 'description' => __('Plak hier de volledige SVG code', 'brein-plugin')),
        ),
      ),
      'brein_qam_section_whatsapp' => array(
        'title' => __('WhatsApp', 'brein-plugin'),
        'fields' => array(
          array('type' => 'text', 'key' => 'whatsapp_label', 'label' => __('Label', 'brein-plugin')),
          array('type' => 'text', 'key' => 'whatsapp_url', 'label' => __('URL/action', 'brein-plugin'), 'description' => __('bv. https://wa.me/31612345678', 'brein-plugin')),
          array('type' => 'checkbox', 'key' => 'whatsapp_qr_enabled', 'label' => __('Show QR code', 'brein-plugin')),
          array('type' => 'text', 'key' => 'whatsapp_qr_color', 'label' => __('QR color', 'brein-plugin'), 'description' => __('bv. #000000', 'brein-plugin')),
          array('type' => 'textarea', 'key' => 'whatsapp_icon_svg', 'label' => __('Icon (SVG code)', 'brein-plugin'), 'description' => __('Plak hier de volledige SVG code', 'brein-plugin')),
          array('type' => 'text', 'key' => 'whatsapp_qr_title', 'label' => __('QR title', 'brein-plugin')),
          array('type' => 'text', 'key' => 'whatsapp_qr_text', 'label' => __('QR text', 'brein-plugin')),
        ),
      ),
      'brein_qam_section_extra' => array(
        'title' => __('Extra', 'brein-plugin'),
        'fields' => array(
          array('type' => 'text', 'key' => 'extra_label', 'label' => __('Label', 'brein-plugin')),
          array('type' => 'text', 'key' => 'extra_url', 'label' => __('URL/action', 'brein-plugin'), 'description' => __('bv. een pagina of een link naar een andere website', 'brein-plugin')),
          array('type' => 'textarea', 'key' => 'extra_icon_svg', 'label' => __('Icon (SVG code)', 'brein-plugin'), 'description' => __('Plak hier de volledige SVG code', 'brein-plugin')),
        ),
      ),
      'brein_qam_section_general' => array(
        'title' => __('General', 'brein-plugin'),
        'fields' => array(
          array('type' => 'media', 'key' => 'general_logo_id', 'label' => __('Logo (PNG, SVG, WEBP)', 'brein-plugin'), 'allowed' => 'svg,png,webp'),
          array('type' => 'text', 'key' => 'general_title', 'label' => __('Title', 'brein-plugin')),
          array('type' => 'checkbox', 'key' => 'general_enabled', 'label' => __('Enabled', 'brein-plugin')),
        ),
      ),
      'brein_qam_section_popup' => array(
        'title' => __('Popup', 'brein-plugin'),
        'fields' => array(
          array('type' => 'text', 'key' => 'popup_title', 'label' => __('Title', 'brein-plugin')),
          array('type' => 'textarea', 'key' => 'popup_text', 'label' => __('Text', 'brein-plugin')),
          array('type' => 'text', 'key' => 'popup_trigger_text', 'label' => __('Trigger text', 'brein-plugin')),
          array('type' => 'text', 'key' => 'popup_icon_color', 'label' => __('Icon color', 'brein-plugin')),
          array('type' => 'text', 'key' => 'popup_text_color', 'label' => __('Text color', 'brein-plugin')),
          array('type' => 'text', 'key' => 'popup_background_color', 'label' => __('Background color', 'brein-plugin')),
        ),
      ),
      'brein_qam_section_branding' => array(
        'title' => __('Branding', 'brein-plugin'),
        'fields' => array(
          array('type' => 'text', 'key' => 'text_color', 'label' => __('Text color (text)', 'brein-plugin'), 'description' => __('bv. #ffffff or brand token', 'brein-plugin')),
          array('type' => 'text', 'key' => 'background_header', 'label' => __('Background header', 'brein-plugin')),
          array('type' => 'text', 'key' => 'background_body', 'label' => __('Background body', 'brein-plugin')),
          array('type' => 'text', 'key' => 'button_hover', 'label' => __('Button hover', 'brein-plugin')),
          array('type' => 'text', 'key' => 'button_hover_text', 'label' => __('Button hover text', 'brein-plugin')),
        ),
      ),
    );
  }

  /**
   * Dispatch to the appropriate field registration based on type.
   *
   * @param array $field Field config.
   * @param string $section_id Section ID.
   */
  private function add_field_by_type($field, $section_id)
  {
    $type = isset($field['type']) ? $field['type'] : 'text';
    $key = isset($field['key']) ? $field['key'] : '';
    $label = isset($field['label']) ? $field['label'] : '';
    $description = isset($field['description']) ? $field['description'] : '';

    switch ($type) {
      case 'media':
        $allowed = isset($field['allowed']) ? $field['allowed'] : 'svg';
        $this->add_media_field($key, $label, $section_id, $allowed);
        break;
      case 'checkbox':
        $this->add_checkbox_field($key, $label, $section_id);
        break;
      case 'textarea':
        $this->add_textarea_field($key, $label, $description, $section_id);
        break;
      case 'text':
      default:
        $this->add_text_field($key, $label, $description, $section_id);
        break;
    }
  }

  /**
   * Helper to register a text field under the correct section.
   *
   * @param string $key Field key.
   * @param string $label Label.
   * @param string $description Optional help text.
   */
  private function add_text_field($key, $label, $description = '', $section = 'brein_qam_section_branding')
  {
    add_settings_field(
      'brein_qam_' . $key,
      $label,
      array($this, 'render_text_field'),
      'brein-qam',
      $section,
      array(
        'key' => $key,
        'description' => $description,
      )
    );
  }

  /**
   * Helper to register a media field (stores attachment ID).
   *
   * @param string $key Field key.
   * @param string $label Label.
   * @param string $section Settings section ID.
   */
  private function add_media_field($key, $label, $section, $allowed = 'svg,webp')
  {
    add_settings_field(
      'brein_qam_' . $key,
      $label,
      array($this, 'render_media_field'),
      'brein-qam',
      $section,
      array(
        'key' => $key,
        'allowed' => $allowed,
      )
    );
  }

  /**
   * Helper to register a checkbox (on/off) field.
   *
   * @param string $key Field key.
   * @param string $label Label.
   * @param string $section Settings section ID.
   */
  private function add_checkbox_field($key, $label, $section)
  {
    add_settings_field(
      'brein_qam_' . $key,
      $label,
      array($this, 'render_checkbox_field'),
      'brein-qam',
      $section,
      array(
        'key' => $key,
      )
    );
  }

  /**
   * Render a checkbox field input.
   *
   * @param array $args Renderer args.
   */
  public function render_checkbox_field($args)
  {
    $options = get_option($this->option_name, array());
    $key = isset($args['key']) ? $args['key'] : '';
    $value = isset($options[$key]) ? (int) $options[$key] : 0;
    ?>
    <label>
      <input type="checkbox" name="<?php echo esc_attr($this->option_name . '[' . $key . ']'); ?>" value="1" <?php checked(1, $value); ?> />
    </label>
    <?php
  }

  /**
   * Helper to register a textarea field.
   *
   * @param string $key Field key.
   * @param string $label Label.
   * @param string $description Help text.
   * @param string $section Section ID.
   */
  private function add_textarea_field($key, $label, $description = '', $section = 'brein_qam_section_branding')
  {
    add_settings_field(
      'brein_qam_' . $key,
      $label,
      array($this, 'render_textarea_field'),
      'brein-qam',
      $section,
      array(
        'key' => $key,
        'description' => $description,
      )
    );
  }

  /**
   * Render a textarea input.
   *
   * @param array $args Renderer args.
   */
  public function render_textarea_field($args)
  {
    $options = get_option($this->option_name, array());
    $key = isset($args['key']) ? $args['key'] : '';
    $value = isset($options[$key]) ? $options[$key] : '';
    ?>
    <textarea rows="4" class="large-text"
      name="<?php echo esc_attr($this->option_name . '[' . $key . ']'); ?>"><?php echo esc_textarea($value); ?></textarea>
    <?php if (!empty($args['description'])): ?>
      <p class="description"><?php echo esc_html($args['description']); ?></p>
    <?php endif; ?>
  <?php
  }

  /**
   * Render a simple text input.
   *
   * @param array $args Renderer args.
   */
  public function render_text_field($args)
  {
    $options = get_option($this->option_name, array());
    $key = isset($args['key']) ? $args['key'] : '';
    $value = isset($options[$key]) ? $options[$key] : '';
    ?>
    <input type="text" class="regular-text" name="<?php echo esc_attr($this->option_name . '[' . $key . ']'); ?>"
      value="<?php echo esc_attr($value); ?>" />
    <?php if (!empty($args['description'])): ?>
      <p class="description"><?php echo esc_html($args['description']); ?></p>
    <?php endif; ?>
  <?php
  }

  /**
   * Render a media selector field storing attachment ID.
   *
   * @param array $args Renderer args.
   */
  public function render_media_field($args)
  {
    $options = get_option($this->option_name, array());
    $key = isset($args['key']) ? $args['key'] : '';
    $value = isset($options[$key]) ? absint($options[$key]) : 0;
    $input_id = 'brein_qam_' . $key;
    $allowed = isset($args['allowed']) ? (string) $args['allowed'] : 'svg';
    $filename = '';
    if ($value) {
      $file = get_attached_file($value);
      if ($file) {
        $filename = basename($file);
      }
    }
    ?>
    <input type="text" id="<?php echo esc_attr($input_id); ?>" class="regular-text"
      name="<?php echo esc_attr($this->option_name . '[' . $key . ']'); ?>" value="<?php echo esc_attr($value); ?>" />
    <button type="button" class="button brein-qam-media-button" data-target="<?php echo esc_attr($input_id); ?>"
      data-allowed="<?php echo esc_attr($allowed); ?>"><?php esc_html_e('Select file', 'brein-plugin'); ?></button>
    <?php if ($filename): ?>
      <span class="description brein-qam-media-filename" style="margin-left:8px;"><?php echo esc_html($filename); ?></span>
    <?php endif; ?>
  <?php
  }

  /**
   * Sanitize options array.
   *
   * @param array $input Raw input.
   * @return array
   */
  public function sanitize_options($input)
  {
    $output = array();
    if (!is_array($input)) {
      return $output;
    }

    $allowed_keys = array(
      'phone_label',
      'phone_url',
      'phone_icon_svg',
      'email_label',
      'email_url',
      'email_icon_svg',
      'whatsapp_label',
      'whatsapp_url',
      'whatsapp_qr_enabled',
      'whatsapp_qr_color',
      'whatsapp_qr_title',
      'whatsapp_qr_text',
      'whatsapp_icon_svg',
      'extra_label',
      'extra_url',
      'extra_icon_svg',
      'general_logo_id',
      'general_title',
      'general_enabled',
      'popup_title',
      'popup_text',
      'popup_trigger_text',
      'popup_icon_color',
      'popup_text_color',
      'popup_background_color',
      'background_color',
      'text_color',
      'background_header',
      'background_body',
      'button_hover',
      'button_hover_text',
    );

    foreach ($allowed_keys as $key) {
      if (!isset($input[$key])) {
        continue;
      }
      if (substr($key, -9) === '_icon_svg') {
        // Allow SVG code with minimal sanitization
        $output[$key] = wp_kses($input[$key], array(
          'svg' => array(
            'xmlns' => array(),
            'width' => array(),
            'height' => array(),
            'viewbox' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'stroke-linecap' => array(),
            'stroke-linejoin' => array(),
            'class' => array(),
            'style' => array(),
          ),
          'path' => array(
            'd' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'stroke-linecap' => array(),
            'stroke-linejoin' => array(),
            'class' => array(),
            'style' => array(),
          ),
          'circle' => array(
            'cx' => array(),
            'cy' => array(),
            'r' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'class' => array(),
            'style' => array(),
          ),
          'rect' => array(
            'x' => array(),
            'y' => array(),
            'width' => array(),
            'height' => array(),
            'rx' => array(),
            'ry' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'class' => array(),
            'style' => array(),
          ),
          'line' => array(
            'x1' => array(),
            'y1' => array(),
            'x2' => array(),
            'y2' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'stroke-linecap' => array(),
            'class' => array(),
            'style' => array(),
          ),
          'polyline' => array(
            'points' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'stroke-linecap' => array(),
            'stroke-linejoin' => array(),
            'class' => array(),
            'style' => array(),
          ),
          'polygon' => array(
            'points' => array(),
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'class' => array(),
            'style' => array(),
          ),
          'g' => array(
            'fill' => array(),
            'stroke' => array(),
            'stroke-width' => array(),
            'transform' => array(),
            'class' => array(),
            'style' => array(),
          ),
        ));
      } elseif (substr($key, -8) === '_icon_id' || substr($key, -8) === 'logo_id') {
        $output[$key] = absint($input[$key]);
      } elseif (substr($key, -4) === '_url') {
        $output[$key] = esc_url_raw($input[$key]);
      } elseif (substr($key, -8) === '_enabled') {
        $output[$key] = $input[$key] ? 1 : 0;
      } elseif (substr($key, -5) === '_text') {
        $output[$key] = sanitize_textarea_field($input[$key]);
      } else {
        $output[$key] = sanitize_text_field($input[$key]);
      }
    }

    return $output;
  }

  /**
   * Render settings page.
   */
  public function render_settings_page()
  {
    ?>
    <div class="wrap">
      <h1><?php esc_html_e('Quick Action Menu', 'brein-plugin'); ?></h1>
      <form action="options.php" method="post">
        <?php
        settings_fields('brein_qam_group');
        do_settings_sections('brein-qam');
        submit_button();
        ?>
      </form>
    </div>
    <?php
  }

  /**
   * Enqueue media uploader and inline JS on our page only.
   *
   * @param string $hook Current admin page hook.
   */
  public function enqueue_assets($hook)
  {
    if ($this->page_hook_suffix === null || $hook !== $this->page_hook_suffix) {
      return;
    }

    wp_enqueue_media();
    wp_register_script('brein-qam-admin', false, array('jquery'), '1.0.0', true);
    wp_enqueue_script('brein-qam-admin');
    $inline = "jQuery(document).on('click', '.brein-qam-media-button', function(e){e.preventDefault(); var target = jQuery('#'+jQuery(this).data('target')); var allowed = (jQuery(this).data('allowed') || 'svg').split(','); var frame = wp.media({title: 'Select File', library: { type: ['image'] }, multiple: false}); frame.on('select', function(){ var att = frame.state().get('selection').first().toJSON(); var name = (att && att.filename) ? att.filename.toLowerCase() : ''; var mime = (att && att.mime) ? att.mime.toLowerCase() : ''; var ok = false; if (allowed.indexOf('svg') !== -1 && (mime.indexOf('svg') !== -1 || /\\.svg$/.test(name))) ok = true; if (allowed.indexOf('png') !== -1 && (mime.indexOf('png') !== -1 || /\\.png$/.test(name))) ok = true; if(!ok){ alert('Please select an allowed file type: ' + allowed.join(', ')); return; } target.val(att.id).trigger('change'); }); frame.open();});";
    wp_add_inline_script('brein-qam-admin', $inline);
  }
}
