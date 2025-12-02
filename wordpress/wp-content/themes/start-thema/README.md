# Clean Starter Theme Extended

Minimal, development-ready WordPress starter theme.

**Features**:
- Template parts structure
- Example custom post type: `project`
- ACF-ready: `inc/acf.php` registers example fields when ACF is active
- Basic theme supports (title-tag, thumbnails, HTML5)
- Enqueue pattern for assets (assets/dist)

**How to use**:
1. Place this folder in `wp-content/themes/`.
2. Activate the theme from the WP admin.
3. If you want the example ACF fields, install and activate ACF (free) or ACF Pro.
4. Add posts / projects and start developing.

**Ideas to extend**:
- Add a `package.json` + build tooling (Vite/webpack) to output to `assets/dist`
- Add block templates and theme.json for full-site-editing support
- Add starter styles and utility CSS (Tailwind or custom)
