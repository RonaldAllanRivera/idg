# WordPress Feature Plugin — CPT + ACF + Template Layer

This repository includes a small, project-focused plugin (`idg-custom`) that demonstrates a maintainable way to ship custom functionality (CPTs, templates, shortcodes, and integrations) without modifying WordPress core or theme core.

Plugin path: `wp-content/plugins/idg-custom/`

## Why a custom plugin (even when ACF Pro is installed)
ACF Pro provides the **field framework** (UI + API). This plugin provides the **project features**.

Keeping CPTs, templates, and WooCommerce customizations in a custom plugin is best practice because:

- Features like CPTs and Woo behavior should **survive theme changes** (theme-agnostic functionality).
- It keeps concerns separated:
  - **Theme** = presentation
  - **Plugin** = functionality / business logic
- It makes changes **portable, reviewable, and version-controlled** in Git.
- It supports predictable deployments across environments.

## What this plugin includes
- Case Studies CPT (`case_study`)
  - Archive URL: `/case-studies/`
  - Single URL: `/case-studies/{slug}/`
- Plugin-owned templates
  - `templates/archive-case_study.php`
  - `templates/single-case_study.php`
- Listing page shortcode (explicit query loop)
  - `[idg_case_studies]`
- ACF field output (ACF Pro required)
  - Field groups are expected to be created in WP Admin (stored in the database)

## WooCommerce (Phase 3)
- Product badge output via WooCommerce hooks.
  - ACF field name: `product_badge_text`
- Product highlight output on the single product page.
  - ACF field name: `product_highlight`

## Engineering notes
- Output is escaped/sanitized (`esc_html`, `esc_url`, `wp_kses_post`) and avoids hardcoding dynamic values in builder text blocks.
- Query loops use `WP_Query` and reset global post state via `wp_reset_postdata()`.
- Image rendering supports common ACF image return formats (array / attachment ID / URL).

## Local testing steps

### 1) Start the site
```bash
docker compose up -d --build
```
Open the site using your configured host/port and path.

### 2) Activate the plugin
- WP Admin → Plugins → Activate **IDG Custom**

### 3) Flush permalinks
- Settings → Permalinks → Save Changes

### 4) Verify the CPT
- WP Admin should show **Case Studies**
- Create 2 Case Studies and publish them

### 5) Verify templates
- Visit the archive (CPT archive):
  - `/case-studies/`
- Click through to a single case study

### 6) Create a listing page with a query loop (recommended)
This plugin registers a shortcode that renders a `WP_Query` loop of Case Studies:
 
- Shortcode: `[idg_case_studies]`
- Optional attribute: `[idg_case_studies posts_per_page="6"]`
 
On staging, create a normal WordPress Page (Avada layout is fine) and add the shortcode using an Avada **Shortcode** element.

Shortcode instructions are also available in WP Admin:
- Case Studies → Listing Shortcode

### 7) Create required ACF Field Group in WP Admin
Create a field group assigned to the **Case Study** post type using these field names:

- `client_name` (text)
- `project_url` (url)
- `industry` (select)
- `featured_result` (number)
- `featured_result_suffix` (text)
- `flexible_content` (flexible content)
  - Add a layout (this is a repeatable block inside the flexible field):
    - Layout label: `Content Block`
    - Layout name: `content_block`
    - Inside this layout, add sub fields:
      - `heading` (text)
      - `content` (WYSIWYG)
  - Add a second layout:
    - Layout label: `Image + Text`
    - Layout name: `image_text`
    - Inside this layout, add sub fields:
      - `image` (image)
      - `text` (WYSIWYG/textarea)

## Staging deployment (no FTP)
If you can delete/re-upload plugins on staging:
- Zip the `wp-content/plugins/idg-custom/` folder
- WP Admin → Plugins → Deactivate/Delete old version
- Add New → Upload Plugin → Upload zip → Activate
- Settings → Permalinks → Save Changes
