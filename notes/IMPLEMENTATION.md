# Implementation Notes

## Overview
This document describes what custom code was added for the IDG WordPress skills test, what it does, and where it lives.

## Custom Code Locations
- Custom plugin: `wp-content/plugins/idg-custom/`
  - Purpose: CPT registration, ACF sync strategy, WooCommerce customizations (hooks/filters).
  - Entry point: `wp-content/plugins/idg-custom/idg-custom.php`

## ACF Field Group Sync
- Strategy: ACF Local JSON
- JSON path (plugin-managed): `wp-content/plugins/idg-custom/acf-json/`

## Theme/Builder Work
- Avada Builder: used for marketing page layout and global element creation.
- Child theme: used only if a template override or theme-level styling is required.

## WooCommerce
- WooCommerce installed and configured on staging.
- Customizations implemented via hooks/filters inside `idg-custom` plugin.

## Notes for Reviewers
- No WordPress core edits.
- No WooCommerce core edits.
- All dynamic data output is handled in PHP (not embedded directly in page builder text blocks).
