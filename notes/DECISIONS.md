# Decisions & Rationale

## Why a custom plugin (`idg-custom`)
- CPTs, ACF sync strategy, and WooCommerce behavior are **features** that should survive theme changes.
- A plugin keeps the theme focused on presentation (Avada/child theme), and keeps feature logic portable and reviewable.

## When the Avada child theme is used
- Only for presentation concerns:
  - template overrides when hooks are insufficient
  - minor theme-level styling adjustments

## ACF synchronization approach
- Preferred: **ACF PHP export** (code-based field groups in `idg-custom`) so field groups are versioned and consistent across environments even when staging/prod filesystem isn’t writable.
- Optional: **ACF Local JSON** when filesystem writes are available.

## Performance mindset
- Keep Avada Builder usage lean (avoid unnecessary nesting/effects).
- Prefer hooks/filters over heavy overrides where possible.

## Risk reduction mindset
- Changes are staged, minimal, and reversible.
- Debugging and QA steps are documented (see `notes/DEBUGGING.md` and `notes/QA.md`).
