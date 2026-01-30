# Changelog

All notable changes to this assignment repo.

## 2026-01-30
### Added
- Docker-based local WordPress dev setup.
- PHP ini overrides for local development (upload limits / safer debug settings).
- `PLAN.md` outlining phased delivery with acceptance criteria.
- `notes/` documentation:
  - `DECISIONS.md`, `IMPLEMENTATION.md`, `QA.md`, `QUESTIONS.md`, `DEBUGGING.md`.
- `wp-content/plugins/idg-custom/` plugin scaffolding:
  - Case Studies CPT registration (`case_study`).
  - Template loader and templates:
    - `archive-case_study.php`
    - `single-case_study.php`
  - Health checks for ACF/WooCommerce dependency visibility.
  - Documentation moved to root `README.md` for portfolio/reviewer visibility.
- Root `README.md` and `CHANGELOG.md` for reviewer-friendly project navigation.
- Phase 2 documentation and verification updates.
- Verified Phase 2 staging URLs:
  - https://dev.staging.idgadvertising.com/ronald/case-studies/
  - https://dev.staging.idgadvertising.com/ronald/all-case-studies/
  - https://dev.staging.idgadvertising.com/ronald/case-studies/case-1/
  - https://dev.staging.idgadvertising.com/ronald/wp-admin/edit.php?post_type=case_study&page=idg-case-studies-shortcode

### Changed
- Docker Compose hardening:
  - Configurable HTTP port binding.
  - DB healthcheck and service dependency ordering.
- `wp-config.php` adjustments for environment-driven configuration and safer debug output.
- Updated documentation to reflect a staging-friendly ACF workflow (field groups created in WP Admin when filesystem write access is unavailable).

### Fixed
- Local upload size limits impacting WordPress/ACF media uploads.
- Debug output/header issues (e.g. notices breaking page output).
- Case Study flexible content `image_text` rendering when ACF image return format is not an array (support array/ID/URL).
