# Implementation Notes

## Overview
This document describes what custom code was added for the IDG WordPress skills test, what it does, and where it lives.

## Custom Code Locations
- Custom plugin: `wp-content/plugins/idg-custom/`
  - Purpose: CPT registration, Case Studies templates, WooCommerce customizations (hooks/filters).
  - Entry point: `wp-content/plugins/idg-custom/idg-custom.php`

## ACF Field Group Sync
- For this skills test, the Case Studies field group was created in **WP Admin (ACF UI)** on staging and is stored in the database.
- This avoids requiring filesystem write access / FTP for field group deployment.

## Staging URLs (Phase 2)
- Case studies listing: https://dev.staging.idgadvertising.com/ronald/case-studies/
- Case studies listing (page with query loop): https://dev.staging.idgadvertising.com/ronald/all-case-studies/
- Case study single example: https://dev.staging.idgadvertising.com/ronald/case-studies/case-1/
- ACF field group (admin): https://dev.staging.idgadvertising.com/ronald/wp-admin/post.php?post=202&action=edit
- Case Studies (admin): https://dev.staging.idgadvertising.com/ronald/wp-admin/edit.php?post_type=case_study

## Listing page query loop
- A dedicated listing page can be created using the `[idg_case_studies]` shortcode, which renders a `WP_Query` loop of `case_study` posts.

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
