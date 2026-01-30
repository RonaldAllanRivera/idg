# Decisions & Rationale

## Why a custom plugin (`idg-custom`)
- CPTs, ACF sync strategy, and WooCommerce behavior are **features** that should survive theme changes.
- A plugin keeps the theme focused on presentation (Avada/child theme), and keeps feature logic portable and reviewable.

## When the Avada child theme is used
- Only for presentation concerns:
  - template overrides when hooks are insufficient
  - minor theme-level styling adjustments

## ACF synchronization approach
- For this skills test, the Case Studies field group was created directly in **WP Admin (ACF UI)** on staging and stored in the database.
- This was chosen to avoid requiring FTP/filesystem write access during the assignment.

## Performance mindset
- Keep Avada Builder usage lean (avoid unnecessary nesting/effects).
- Prefer hooks/filters over heavy overrides where possible.

## Risk reduction mindset
- Changes are staged, minimal, and reversible.
- Debugging and QA steps are documented (see `notes/DEBUGGING.md` and `notes/QA.md`).
