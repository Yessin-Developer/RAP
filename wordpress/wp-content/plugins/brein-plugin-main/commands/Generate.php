<?php
if (defined('WP_CLI') && WP_CLI) {

  class Generate_Multi_Posts_Command
  {

    /**
     * Generate multiple posts or pages in one go.
     *
     * ## OPTIONS
     *
     * --post_type=<post_type>
     * : Required. Bijvoorbeeld: page of post.
     *
     * [--post_status=<status>]
     * : Optioneel. publish, draft, private. [default: publish]
     *
     * --posts=<list>
     * : Vereist. Komma-gescheiden titels of JSON array string.
     *
     * [--parent=<id>]
     * : Optioneel. Parent post ID.
     *
     * [--template=<slug>]
     * : Optioneel. Pagina template (alleen voor pages), bijv. template-contact.php of 'default'.
     *
     * [--skip_existing]
     * : Optioneel. Sla over als titel + post_type al bestaan.
     *
     * ## EXAMPLES
     *   wp generate --post_type=page --posts="Opslagunits,Oplossingen"
     *   wp generate --post_type=page --post_status=draft --posts='["Locatie","Contact"]'
     */
    public function __invoke($args, $assoc_args)
    {
      // Helper om zowel post_status als post-status te ondersteunen
      $get = function ($key, $default = null) use ($assoc_args) {
        $val = \WP_CLI\Utils\get_flag_value($assoc_args, $key, null);
        if (null !== $val)
          return $val;
        // fallback voor hyphen/underscore varianten
        $alt = str_replace(['_', '-'], ['-', '_'], $key);
        return \WP_CLI\Utils\get_flag_value($assoc_args, $alt, $default);
      };

      $post_type = $get('post_type');
      $post_status = $get('post_status', 'publish');
      $parent = (int) $get('parent', 0);
      $template = (string) $get('template', '');
      $skip_existing = (bool) $get('skip_existing', false);
      $posts_raw = $get('posts');

      if (empty($post_type)) {
        \WP_CLI::error('--post_type is required.');
      }
      if (empty($posts_raw)) {
        \WP_CLI::error('--posts is required.');
      }

      // Titels parsen: JSON array of komma-gescheiden
      $posts_raw = trim($posts_raw);
      if ($posts_raw !== '' && $posts_raw[0] === '[') {
        $titles = json_decode($posts_raw, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($titles)) {
          \WP_CLI::error('Could not parse --posts JSON array.');
        }
        $titles = array_map('strval', $titles);
      } else {
        // Let op: komma in titels -> gebruik JSON variant hierboven
        $titles = array_filter(array_map('trim', explode(',', $posts_raw)));
      }

      foreach ($titles as $title) {
        if ($skip_existing) {
          $existing = get_page_by_title($title, OBJECT, $post_type);
          if ($existing) {
            \WP_CLI::log("Skipped existing: {$title} (ID: {$existing->ID})");
            continue;
          }
        }

        $postarr = [
          'post_type' => $post_type,
          'post_status' => $post_status,
          'post_title' => $title,
        ];
        if ($parent > 0) {
          $postarr['post_parent'] = $parent;
        }

        $post_id = wp_insert_post($postarr);

        if (is_wp_error($post_id)) {
          \WP_CLI::warning("Failed: {$title} – " . $post_id->get_error_message());
          continue;
        }

        if ($template && $post_type === 'page') {
          update_post_meta($post_id, '_wp_page_template', $template);
        }

        \WP_CLI::success("Created: {$title} (ID: {$post_id})");
      }
    }
  }

  \WP_CLI::add_command('generate', 'Generate_Multi_Posts_Command');
}
