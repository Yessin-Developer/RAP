<?php
if (!defined('ABSPATH'))
    exit;

/**
 * VITE setup - Plugin variant (unique prefix BBP_)
 * Sluit aan op eerdere adviezen:
 * - eigen dev server (3010)
 * - admin entry: /assets/js/admin.js
 * - ES modules in productie
 */

define('BBP_DIST_DEF', 'dist');
define('BBP_DIST_URI', plugin_dir_url(dirname(__FILE__)) . BBP_DIST_DEF);
define('BBP_DIST_PATH', plugin_dir_path(dirname(__FILE__)) . BBP_DIST_DEF);

define('BBP_JS_DEPENDENCY', array());
define('BBP_JS_LOAD_IN_FOOTER', true);

define('BBP_VITE_SERVER', 'http://localhost:3010'); // plugin dev-port
define('BBP_VITE_ENTRY_ADMIN', '/assets/js/admin.js'); // <— was /main.js
define('BBP_VITE_ENTRY_FRONT', '/assets/js/front.js'); // (niet gebruikt hier)

/**
 * Helper: haal 'admin' entry uit manifest (of eerste admin-* fallback)
 */
if (!function_exists('bbp_manifest_get_admin_entry')) {
    function bbp_manifest_get_admin_entry(string $manifest_path): ?array
    {
        if (!is_readable($manifest_path))
            return null;
        $manifest = json_decode(file_get_contents($manifest_path), true);
        if (!is_array($manifest))
            return null;

        // 1) named entry 'admin'
        if (isset($manifest['admin']) && is_array($manifest['admin'])) {
            return $manifest['admin'];
        }
        // 2) fallback: eerste entry met filename die start met 'admin-'
        foreach ($manifest as $value) {
            if (!empty($value['isEntry']) && !empty($value['file'])) {
                $basename = basename($value['file']);
                if (strpos($basename, 'admin-') === 0) {
                    return $value;
                }
            }
        }
        return null;
    }
}

/** Admin enqueue (plugin) */
if (!function_exists('bbp_enqueue_admin_assets')) {
    function bbp_enqueue_admin_assets()
    {
        // Alleen op echte wp-admin schermen
        if (!is_admin())
            return;

        // DEV: inject @vite/client + entry als ES modules (eenmalig)
        if (defined('BBP_IS_VITE_DEVELOPMENT') && BBP_IS_VITE_DEVELOPMENT === true) {
            static $bbp_admin_dev_injected = false;
            if ($bbp_admin_dev_injected)
                return;
            $bbp_admin_dev_injected = true;

            add_action('admin_head', function () {
                echo '<script type="module" crossorigin src="' . esc_url(BBP_VITE_SERVER . '/@vite/client') . '"></script>' . "\n";
                echo '<script type="module" crossorigin src="' . esc_url(BBP_VITE_SERVER . BBP_VITE_ENTRY_ADMIN) . '"></script>' . "\n";
            }, 1);

            return;
        }

        // PROD: lees manifest en enqueue als ES module
        $manifest_path = BBP_DIST_PATH . '/.vite/manifest.json';
        $entry = bbp_manifest_get_admin_entry($manifest_path);
        if (!$entry)
            return;

        // CSS
        if (!empty($entry['css']) && is_array($entry['css'])) {
            foreach ($entry['css'] as $i => $css_file) {
                wp_enqueue_style(
                    'brein-plugin-admin-' . $i,
                    BBP_DIST_URI . '/' . ltrim($css_file, '/'),
                    [],
                    null
                );
            }
        }

        // JS (als module)
        if (!empty($entry['file'])) {
            $handle = 'brein-plugin-admin';
            wp_enqueue_script(
                $handle,
                BBP_DIST_URI . '/' . ltrim($entry['file'], '/'),
                BBP_JS_DEPENDENCY,
                null,
                BBP_JS_LOAD_IN_FOOTER
            );
            wp_script_add_data($handle, 'type', 'module'); // cruciaal
        }
    }
}
add_action('admin_enqueue_scripts', 'bbp_enqueue_admin_assets', 20);

/** Login enqueue (plugin) — zelfde admin bundle op login scherm */
if (!function_exists('bbp_enqueue_login_assets')) {
    function bbp_enqueue_login_assets()
    {
        // DEV
        if (defined('BBP_IS_VITE_DEVELOPMENT') && BBP_IS_VITE_DEVELOPMENT === true) {
            static $bbp_login_dev_injected = false;
            if ($bbp_login_dev_injected)
                return;
            $bbp_login_dev_injected = true;

            add_action('login_head', function () {
                echo '<script type="module" crossorigin src="' . esc_url(BBP_VITE_SERVER . '/@vite/client') . '"></script>' . "\n";
                echo '<script type="module" crossorigin src="' . esc_url(BBP_VITE_SERVER . BBP_VITE_ENTRY_ADMIN) . '"></script>' . "\n";
            }, 1);

            return;
        }

        // PROD
        $manifest_path = BBP_DIST_PATH . '/.vite/manifest.json';
        $entry = bbp_manifest_get_admin_entry($manifest_path);
        if (!$entry)
            return;

        // CSS
        if (!empty($entry['css']) && is_array($entry['css'])) {
            foreach ($entry['css'] as $i => $css_file) {
                wp_enqueue_style(
                    'brein-plugin-login-' . $i,
                    BBP_DIST_URI . '/' . ltrim($css_file, '/'),
                    [],
                    null
                );
            }
        }

        // JS (als module)
        if (!empty($entry['file'])) {
            $handle = 'brein-plugin-login';
            wp_enqueue_script(
                $handle,
                BBP_DIST_URI . '/' . ltrim($entry['file'], '/'),
                BBP_JS_DEPENDENCY,
                null,
                BBP_JS_LOAD_IN_FOOTER
            );
            wp_script_add_data($handle, 'type', 'module'); // cruciaal
        }
    }
}
add_action('login_enqueue_scripts', 'bbp_enqueue_login_assets', 20);
