<?php
/**
 * QAM Frontend Renderer
 *
 * Renders the Quick Action Menu based on saved options.
 * Provides a shortcode [brein_qam] and a template tag brein_qam().
 *
 * @package BreinPlugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

class Brein_QAM_Render
{
  /**
   * Option key used by admin settings.
   *
   * @var string
   */
  private $option_name = 'brein_qam_options';

  public function __construct()
  {
    add_shortcode('brein_qam', array($this, 'shortcode'));
    add_action('wp_footer', array($this, 'print_in_footer'), 999);
  }

  /**
   * Shortcode callback – echoes render output.
   *
   * @return string
   */
  public function shortcode()
  {
    return $this->render();
  }

  /**
   * Template function to echo the QAM.
   */
  public function output()
  {
    echo $this->render();
  }

  /**
   * Print the QAM at the very end of the body.
   */
  public function print_in_footer()
  {
    $opts = $this->get_options();
    if (empty($opts['enabled'])) {
      return;
    }
    echo $this->render();
  }

  /**
   * Build normalized options with sensible defaults.
   *
   * @return array
   */
  private function get_options()
  {
    $o = get_option($this->option_name, array());

    $get = function ($key, $default = '') use ($o) {
      return !empty($o[$key]) ? $o[$key] : $default;
    };

    // Default SVG icons
    $default_phone_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_386_335)"><path d="M10.8332 0.833321C10.8332 0.612308 10.921 0.400346 11.0773 0.244066C11.2336 0.0877854 11.4456 -1.19669e-05 11.6666 -1.19669e-05C13.876 0.00241436 15.9942 0.881167 17.5564 2.44344C19.1187 4.00572 19.9975 6.12393 19.9999 8.33332C19.9999 8.55434 19.9121 8.7663 19.7558 8.92258C19.5996 9.07886 19.3876 9.16666 19.1666 9.16666C18.9456 9.16666 18.7336 9.07886 18.5773 8.92258C18.421 8.7663 18.3332 8.55434 18.3332 8.33332C18.3313 6.56582 17.6282 4.87128 16.3784 3.62147C15.1286 2.37166 13.4341 1.66864 11.6666 1.66665C11.4456 1.66665 11.2336 1.57886 11.0773 1.42258C10.921 1.2663 10.8332 1.05434 10.8332 0.833321ZM11.6666 4.99999C12.5506 4.99999 13.3985 5.35118 14.0236 5.9763C14.6487 6.60142 14.9999 7.44927 14.9999 8.33332C14.9999 8.55434 15.0877 8.7663 15.244 8.92258C15.4003 9.07886 15.6122 9.16666 15.8332 9.16666C16.0543 9.16666 16.2662 9.07886 16.4225 8.92258C16.5788 8.7663 16.6666 8.55434 16.6666 8.33332C16.6652 7.00765 16.138 5.73665 15.2006 4.79925C14.2633 3.86185 12.9923 3.33465 11.6666 3.33332C11.4456 3.33332 11.2336 3.42112 11.0773 3.5774C10.921 3.73368 10.8332 3.94564 10.8332 4.16666C10.8332 4.38767 10.921 4.59963 11.0773 4.75591C11.2336 4.91219 11.4456 4.99999 11.6666 4.99999ZM19.2441 13.9492C19.727 14.4334 19.9982 15.0894 19.9982 15.7733C19.9982 16.4572 19.727 17.1132 19.2441 17.5975L18.4857 18.4717C11.6607 25.0058 -4.94759 8.40166 1.48574 1.55499L2.44407 0.721655C2.92888 0.252219 3.57902 -0.00747107 4.25383 -0.00123293C4.92864 0.0050052 5.57386 0.27667 6.04991 0.754988C6.07574 0.780822 7.61991 2.78666 7.61991 2.78666C8.0781 3.26801 8.33316 3.90743 8.33207 4.57199C8.33099 5.23655 8.07384 5.87513 7.61407 6.35499L6.64907 7.56832C7.18311 8.86592 7.96829 10.0452 8.9595 11.0384C9.9507 12.0316 11.1284 12.8192 12.4249 13.3558L13.6457 12.385C14.1257 11.9256 14.7641 11.6687 15.4285 11.6678C16.0928 11.6669 16.732 11.9219 17.2132 12.38C17.2132 12.38 19.2182 13.9233 19.2441 13.9492ZM18.0974 15.1608C18.0974 15.1608 16.1032 13.6267 16.0774 13.6008C15.9057 13.4306 15.6738 13.3351 15.432 13.3351C15.1902 13.3351 14.9583 13.4306 14.7866 13.6008C14.7641 13.6242 13.0832 14.9633 13.0832 14.9633C12.97 15.0535 12.8352 15.1126 12.6921 15.1348C12.5491 15.157 12.4027 15.1416 12.2674 15.09C10.5878 14.4646 9.06219 13.4856 7.79394 12.2192C6.52568 10.9528 5.54441 9.42868 4.91657 7.74999C4.86091 7.61287 4.84276 7.4634 4.86399 7.31694C4.88523 7.17048 4.94509 7.03232 5.03741 6.91666C5.03741 6.91666 6.37657 5.23499 6.39907 5.21332C6.5693 5.04164 6.66481 4.80967 6.66481 4.56791C6.66481 4.32614 6.5693 4.09417 6.39907 3.92249C6.37324 3.89749 4.83907 1.90165 4.83907 1.90165C4.66482 1.74541 4.43741 1.66173 4.20345 1.66778C3.96948 1.67382 3.74669 1.76912 3.58074 1.93415L2.62241 2.76749C-2.07926 8.42082 12.3132 22.015 17.2674 17.3333L18.0266 16.4583C18.2045 16.2935 18.3113 16.066 18.3245 15.8239C18.3378 15.5818 18.2563 15.344 18.0974 15.1608Z" fill="black"/></g><defs><clipPath id="clip0_386_335"><rect width="20" height="20" fill="white"/></clipPath></defs></svg>';
    $default_email_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_386_333)"><path d="M15.8333 0.833313H4.16667C3.062 0.834636 2.00296 1.27405 1.22185 2.05516C0.440735 2.83628 0.00132321 3.89532 0 4.99998L0 15C0.00132321 16.1046 0.440735 17.1637 1.22185 17.9448C2.00296 18.7259 3.062 19.1653 4.16667 19.1666H15.8333C16.938 19.1653 17.997 18.7259 18.7782 17.9448C19.5593 17.1637 19.9987 16.1046 20 15V4.99998C19.9987 3.89532 19.5593 2.83628 18.7782 2.05516C17.997 1.27405 16.938 0.834636 15.8333 0.833313ZM4.16667 2.49998H15.8333C16.3323 2.50096 16.8196 2.65124 17.2325 2.93148C17.6453 3.21172 17.9649 3.6091 18.15 4.07248L11.7683 10.455C11.2987 10.9227 10.6628 11.1854 10 11.1854C9.33715 11.1854 8.70131 10.9227 8.23167 10.455L1.85 4.07248C2.03512 3.6091 2.35468 3.21172 2.76754 2.93148C3.1804 2.65124 3.66768 2.50096 4.16667 2.49998ZM15.8333 17.5H4.16667C3.50363 17.5 2.86774 17.2366 2.3989 16.7677C1.93006 16.2989 1.66667 15.663 1.66667 15V6.24998L7.05333 11.6333C7.83552 12.4135 8.89521 12.8517 10 12.8517C11.1048 12.8517 12.1645 12.4135 12.9467 11.6333L18.3333 6.24998V15C18.3333 15.663 18.0699 16.2989 17.6011 16.7677C17.1323 17.2366 16.4964 17.5 15.8333 17.5Z" fill="black"/></g><defs><clipPath id="clip0_386_333"><rect width="20" height="20" fill="white"/></clipPath></defs></svg>';
    $default_whatsapp_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_386_329)"><path fill-rule="evenodd" clip-rule="evenodd" d="M17.0526 2.90667C15.1809 1.03333 12.6926 0.000833333 10.0418 0C4.57927 0 0.133441 4.445 0.130941 9.91C0.130107 11.6567 0.586774 13.3617 1.45427 14.865L0.0476074 20L5.30094 18.6217C6.74844 19.4117 8.37844 19.8275 10.0368 19.8283H10.0409C15.5026 19.8283 19.9493 15.3825 19.9518 9.9175C19.9534 7.27 18.9234 4.77917 17.0526 2.90667ZM10.0418 18.1542H10.0384C8.56011 18.1542 7.11094 17.7567 5.84594 17.0058L5.54511 16.8275L2.42761 17.645L3.26011 14.605L3.06427 14.2933C2.23927 12.9817 1.80427 11.4658 1.80511 9.91C1.80677 5.36833 5.50261 1.67333 10.0459 1.67333C12.2459 1.67333 14.3143 2.53167 15.8693 4.08833C17.4243 5.64583 18.2801 7.715 18.2793 9.91583C18.2768 14.4592 14.5818 18.1542 10.0418 18.1542ZM14.5601 11.985C14.3126 11.8608 13.0951 11.2617 12.8676 11.1792C12.6409 11.0967 12.4759 11.055 12.3101 11.3025C12.1443 11.55 11.6709 12.1083 11.5259 12.2742C11.3818 12.4392 11.2368 12.46 10.9893 12.3358C10.7418 12.2117 9.94344 11.9508 8.99761 11.1067C8.26177 10.45 7.76427 9.63917 7.62011 9.39083C7.47594 9.1425 7.60511 9.00917 7.72844 8.88583C7.84011 8.775 7.97594 8.59667 8.10011 8.45167C8.22511 8.30833 8.26594 8.205 8.34927 8.03917C8.43177 7.87417 8.39094 7.72917 8.32844 7.605C8.26594 7.48167 7.77094 6.2625 7.56511 5.76667C7.36427 5.28333 7.16011 5.34917 7.00761 5.34167C6.86344 5.33417 6.69844 5.33333 6.53261 5.33333C6.36761 5.33333 6.09927 5.395 5.87261 5.64333C5.64594 5.89167 5.00594 6.49083 5.00594 7.70917C5.00594 8.92833 5.89344 10.1058 6.01677 10.2708C6.14011 10.4358 7.76261 12.9375 10.2468 14.01C10.8376 14.265 11.2993 14.4175 11.6584 14.5317C12.2518 14.72 12.7918 14.6933 13.2184 14.63C13.6943 14.5592 14.6834 14.0308 14.8901 13.4525C15.0968 12.8742 15.0968 12.3775 15.0343 12.275C14.9726 12.1708 14.8076 12.1092 14.5601 11.985Z" fill="black"/></g><defs><clipPath id="clip0_386_329"><rect width="20" height="20" fill="white"/></clipPath></defs></svg>';
    $default_extra_icon = '';

    return array(
      'enabled' => !empty($o['general_enabled']),
      'title' => $get('general_title'),
      'logo_id' => (int) $get('general_logo_id', 0),

      'phone' => array(
        'label' => $get('phone_label'),
        'url' => $get('phone_url'),
        'icon_svg' => $get('phone_icon_svg', $default_phone_icon),
      ),
      'email' => array(
        'label' => $get('email_label'),
        'url' => $get('email_url'),
        'icon_svg' => $get('email_icon_svg', $default_email_icon),
      ),
      'whatsapp' => array(
        'label' => $get('whatsapp_label'),
        'url' => $get('whatsapp_url'),
        'icon_svg' => $get('whatsapp_icon_svg', $default_whatsapp_icon),
        'qr_enabled' => !empty($o['whatsapp_qr_enabled']),
        'whatsapp_title' => $get('whatsapp_qr_title', esc_html('Chatten via WhatsApp?')),
        'whatsapp_text' => $get('whatsapp_qr_text', esc_html('Scan de code, stuur een bericht en wij zullen zo snel mogelijk reageren.')),
      ),
      'extra' => array(
        'label' => $get('extra_label'),
        'url' => $get('extra_url'),
        'icon_svg' => $get('extra_icon_svg', $default_extra_icon),
      ),
      'popup' => array(
        'title' => $get('popup_title'),
        'text' => $get('popup_text'),
        'trigger' => $get('popup_trigger_text'),
      ),

      'colors' => array(
        'text' => $get('text_color'),
        'background' => $get('background_color'),
        'header' => $get('background_header'),
        'body' => $get('background_body'),
        'hover' => $get('button_hover'),
        'whatsapp' => $get('whatsapp_qr_color'),
        'popup_text' => $get('popup_text_color'),
        'popup_background' => $get('popup_background_color'),
        'popup_icon' => $get('popup_icon_color'),
        'hover_text' => $get('button_hover_text'),
      ),
    );
  }

  /**
   * Get an attachment URL by ID.
   *
   * @param int $attachment_id
   * @return string
   */
  private function get_media_url($attachment_id)
  {
    if (!$attachment_id) {
      return '';
    }
    $url = wp_get_attachment_url($attachment_id);
    return $url ? $url : '';
  }

  /**
   * Render HTML for the Quick Action Menu.
   *
   * @return string
   */
  public function render()
  {
    $o = $this->get_options();
    if (!$o['enabled']) {
      return '';
    }

    $items = array();
    foreach (array('phone', 'email', 'whatsapp', 'extra') as $key) {
      $item = $o[$key];
      if (!empty($item['url']) && !empty($item['label'])) {
        $items[] = array(
          'key' => $key,
          'label' => $item['label'],
          'url' => $item['url'],
          'icon_svg' => $item['icon_svg'],
        );
      }
    }

    if (empty($items) && empty($o['popup']['title']) && empty($o['title'])) {
      return '';
    }

    $title = $o['title'];
    $logo = $this->get_media_url($o['logo_id']);

    $style_vars = array();
    foreach ($o['colors'] as $k => $v) {
      if (!empty($v)) {
        $style_vars[] = '--qam-' . sanitize_key($k) . ':' . $v;
      }
    }
    $style_attr = empty($style_vars) ? '' : ' style="' . esc_attr(implode(';', $style_vars)) . '"';

    ob_start();
    ?>
    <div data-whatsapp-modal="<?php echo esc_url($o['whatsapp']['url']); ?>" class="brein-qam" <?php echo $style_attr; ?>
      aria-label="<?php echo esc_attr__('Quick Action Menu', 'brein-plugin'); ?>">
      <div class="brein-qam__popup-container">

        <header class="brein-qam__header">
          <?php if ($logo): ?>
            <img class="brein-qam__logo" src="<?php echo esc_url($logo); ?>" alt="" />
          <?php endif; ?>
        </header>
        <div class="brein-qam__content">

          <?php if (!empty($title)): ?>
            <span class="brein-qam__title"><?php echo esc_html($title); ?></span>
          <?php endif; ?>

          <?php if (!empty($o['whatsapp']['url']) && $o['whatsapp']['qr_enabled']): ?>
            <div class="brein-qam__whatsapp-container">

              <div data-whatsapp-modal-qr-canvas="" class="whatsapp-modal__qr-canvas"></div>
              <?php if (!empty($o['whatsapp']['whatsapp_title'])): ?>
                <span class="brein-qam__title"><?php echo esc_html($o['whatsapp']['whatsapp_title']); ?></span>
              <?php endif; ?>
              <?php if (!empty($o['whatsapp']['whatsapp_text'])): ?>
                <p class="brein-qam__text">
                  <?php echo esc_html($o['whatsapp']['whatsapp_text']); ?>
                </p>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($items)): ?>
            <ul class="brein-qam__items">
              <?php foreach ($items as $it): ?>

                <li class="brein-qam__item">
                  <a data-layer="QAM - <?php echo esc_attr($it['key']); ?>" class="brein-qam__link"
                    href="<?php echo esc_url($it['url']); ?>">
                    <div class="brein-qam__link-content">
                      <?php if (!empty($it['icon_svg'])): ?>
                        <span class="brein-qam__icon"><?php
                        // SVG is already sanitized via wp_kses() on save with allowed SVG elements/attributes
                        echo $it['icon_svg'];
                        ?></span>
                      <?php endif; ?>
                      <span class="brein-qam__label"><?php echo esc_html($it['label']); ?></span>
                    </div>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>

      <div data-whatsapp-modal-tooltip class="brein-qam__tooltip">
        <div class="brein-qam__tooltip-content">
          <span class="heading"><?php echo esc_html($o['popup']['title']); ?></span>
          <div class="brein-qam__tooltip-text">
            <?php echo wp_kses_post($o['popup']['text']); ?>
          </div>
        </div>
        <div class="tooltip-arrow">
          <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M19 15.7574V3C19 1.34315 17.6569 0 16 0H3.24264C0.569927 0 -0.768574 3.23143 1.12132 5.12132L13.8787 17.8787C15.7686 19.7686 19 18.4301 19 15.7574Z"
              fill="#16343C" />
          </svg>

        </div>
      </div>
      <button data-whatsapp-modal-toggle class="brein-qam__popup-trigger">
        <?php if (!empty($o['popup']['trigger'])): ?>
          <span class="brein-qam__trigger-text"><?php echo esc_html($o['popup']['trigger']); ?></span>
        <?php endif; ?>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M12 5.99976V1.99976H8M15 10.9998V12.9998M2 11.9998H4M20 11.9998H22M9 10.9998V12.9998M20 15.9998C20 16.5302 19.7893 17.0389 19.4142 17.414C19.0391 17.789 18.5304 17.9998 18 17.9998H8.828C8.29761 17.9999 7.78899 18.2107 7.414 18.5858L5.212 20.7878C5.1127 20.887 4.9862 20.9546 4.84849 20.982C4.71077 21.0094 4.56803 20.9954 4.43831 20.9416C4.30858 20.8879 4.1977 20.7969 4.11969 20.6802C4.04167 20.5634 4.00002 20.4262 4 20.2858V7.99976C4 7.46932 4.21071 6.96061 4.58579 6.58554C4.96086 6.21047 5.46957 5.99976 6 5.99976H18C18.5304 5.99976 19.0391 6.21047 19.4142 6.58554C19.7893 6.96061 20 7.46932 20 7.99976V15.9998Z"
            stroke="var(--qam-body)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="trigger-close">
          <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <line y1="-1" x2="20.7603" y2="-1" transform="matrix(0.707107 -0.707107 0.675226 0.737611 2.08716 16.9671)"
              stroke="white" stroke-width="2" />
            <line y1="-1" x2="20.7603" y2="-1" transform="matrix(0.707107 0.707107 0.675226 -0.737611 2.08716 1.03284)"
              stroke="white" stroke-width="2" />
          </svg>
        </div>
      </button>
    </div>
    <?php
    return (string) ob_get_clean();
  }
}

/**
 * Template tag convenience function.
 */
function brein_qam()
{
  static $renderer = null;
  if ($renderer === null) {
    $renderer = new Brein_QAM_Render();
  }
  $renderer->output();
}
