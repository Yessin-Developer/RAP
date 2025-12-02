# Buro Brein Plugin

De Buro Brein Plugin met custom functies voor WordPress.

## Version
2.1.6

## Structure

The plugin has been refactored into a clean, organized structure following WordPress best practices:

```
brein-plugin/
├── brein-plugin.php              # Main plugin file (bootstrapper)
├── app/                           # Acorn application files
│   └── Providers/
│       └── PluginServiceProvider.php
├── assets/                        # Static assets
│   ├── css/
│   │   └── app.scss
│   └── js/
│       ├── compress-images-ajax.js
│       └── front.js               # Frontend JavaScript (QAM)
├── commands/                      # WP-CLI commands
│   └── Generate.php
├── dist/                          # Build output (Vite)
├── includes/                      # PHP classes
│   ├── class-brein-plugin.php    # Main plugin orchestrator
│   ├── class-qam-render.php      # Quick Action Menu frontend renderer
│   ├── admin/                     # Admin functionality
│   │   ├── class-admin-ui.php    # Admin UI customizations
│   │   ├── class-image-compression.php  # Image compression
│   │   └── class-qam.php         # Quick Action Menu settings
│   ├── cli/                       # CLI loaders
│   │   └── class-cli-loader.php
│   ├── filters/                   # WordPress filters
│   │   ├── class-acf-filters.php
│   │   ├── class-block-editor-filters.php
│   │   └── class-media-filters.php
│   └── updater/                   # Plugin updates
│       └── class-plugin-updater.php
├── incl/                          # Legacy includes
│   └── incl.vite.php
└── vendor/                        # Composer dependencies
```

## Features

### Roots Acorn Integration
- **Laravel framework**: Uses Roots Acorn for modern PHP development
- **Service providers**: Organized service provider architecture
- **Dependency injection**: Laravel's IoC container available throughout the plugin

### ACF Customizations
- **Bold text formatting**: Automatically converts `*text*` to `<strong>text</strong>` in ACF text fields
- **Image positioning**: Adds custom `data-pos-x` and `data-pos-y` attributes from ACF fields to images

### Block Editor
- **Block restrictions**: Disables unnecessary Gutenberg blocks for a cleaner editing experience
- **Code editing disabled**: Prevents users from accessing code editor in block editor

### Media Management
- **High-quality images**: Sets JPEG quality to 100% and disables WordPress auto-compression
- **Automatic WebP conversion**: Automatically converts uploaded JPEG/PNG images larger than 500KB to WebP format (max 2560×2560px)
- **Bulk compression**: Admin page under Media → Compress All Images to batch-process existing images

### Admin UI
- **Resizable sidebar**: Makes the Gutenberg sidebar resizable and remembers width preference

### Quick Action Menu (QAM)
- **Contact widget**: Floating contact menu with customizable phone, email, WhatsApp, and extra action items
- **SVG icons**: Inline SVG support with default icons for phone, email, and WhatsApp
- **Custom branding**: Configurable colors, logo, and styling options
- **Popup functionality**: Optional popup with custom trigger text and messaging
- **WhatsApp QR**: Built-in WhatsApp QR code generator for easy mobile access
- **Shortcode**: `[brein_qam]` to display anywhere in content
- **Template tag**: `brein_qam()` for direct theme integration
- **Auto-display**: Can be enabled to automatically appear in footer site-wide

### Updates
- **GitHub integration**: Automatic updates from the GitHub repository

## Classes

### `Brein_Plugin`
Main orchestrator class that initializes all components.

### `Brein_ACF_Filters`
Handles ACF-related filters and customizations.

### `Brein_Block_Editor_Filters`
Manages block editor restrictions and settings.

### `Brein_Media_Filters`
Controls media upload quality settings.

### `Brein_Admin_UI`
Customizes the WordPress admin interface.

### `Brein_Image_Compression`
Handles automatic and bulk image compression to WebP format.

### `Brein_Plugin_Updater`
Manages plugin updates from GitHub repository.

### `Brein_CLI_Loader`
Loads WP-CLI command files.

### `Brein_QAM`
Admin settings page for Quick Action Menu configuration. Manages contact item settings (phone, email, WhatsApp, extra), branding, and popup options. Uses inline SVG code for icons.

### `Brein_QAM_Render`
Frontend renderer for the Quick Action Menu. Outputs HTML structure with configurable styling and provides the `brein_qam()` template tag and `[brein_qam]` shortcode.

## Usage

### Quick Action Menu

The QAM can be configured via the admin menu at **Buro Brein → Quick Action Menu**.

**Settings available:**
- **Phone, Email, WhatsApp, Extra**: Each section includes label, URL/action, and SVG icon code
- **General**: Logo upload, title, and enable/disable toggle
- **Popup**: Custom title, text, trigger text, and color customization
- **Branding**: Text color, background colors, and button hover colors

**Display options:**

1. **Automatic (footer)**: Enable the "Enabled" checkbox in General settings to show in `wp_footer`
2. **Shortcode**: Use `[brein_qam]` anywhere in post/page content
3. **Template tag**: Use `brein_qam()` directly in theme files

**SVG Icons:**
Default icons are provided for phone, email, and WhatsApp. Paste custom SVG code in the textarea fields to override defaults. The SVG code is sanitized for security.

## Development

### Requirements
- PHP 7.4+
- WordPress 5.8+
- Imagick PHP extension (for image compression)
- Composer
- Node.js & npm

### Development Mode
Set `IS_VITE_DEVELOPMENT` to `true` in `brein-plugin.php` for development mode with Vite HMR.

**Important**:
- When `IS_VITE_DEVELOPMENT` is `true`, the plugin will try to load assets from `http://localhost:3000`
- Make sure to run `npm run dev` or set it to `false` for production mode to use compiled assets from `/dist/`
- If you don't see CSS in admin, check that either:
  1. Vite dev server is running (`npm run dev`), OR
  2. `IS_VITE_DEVELOPMENT` is set to `false`

### Build Assets
```bash
npm install
npm run dev    # Development with HMR
npm run build  # Production build
```

### Install Composer Dependencies
```bash
composer install
```

## Support
Contact: hallo@burobrein.nl
Phone: 071 20 32 402

## License
Proprietary - Buro Brein
