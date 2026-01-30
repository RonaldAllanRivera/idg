# IDG WordPress Skills Test — Execution Plan

## Goal
Deliver a clean, performant, maintainable implementation that matches IDG’s agency standards: clear structure, strong judgment, and production-minded decisions (without overbuilding beyond the 4–6 hour timebox).

## North-Star Outcomes (what will impress the CEO/hiring team)
- **Reliable delivery**: every requirement met, nothing fragile, no core edits.
- **Agency quality**: predictable structure, readable code, reversible changes.
- **Performance + SEO awareness**: avoid unnecessary builder bloat; ensure semantic markup where possible.
- **Maintainability**: customizations placed in the right layer (child theme vs custom plugin vs template override).
- **Clear communication**: submission notes that make review effortless.

## Constraints / Assumptions
- Work is completed on the provided staging site.
- Avada + ACF Pro are installed.
- WooCommerce must be installed + configured.
- Deliverables include working staging site + a ZIP/Git repo containing custom code + written notes.

---

# Phase 0 — Setup & Risk Controls (15–30 min)
## Deliverables
- A small repo/zip with a predictable structure:
  - `child-theme/` (if needed)
  - `plugins/idg-custom/` (preferred for CPT/ACF/Woo hooks)
  - `notes/IMPLEMENTATION.md`
  - `notes/DECISIONS.md`
  - `notes/DEBUGGING.md` (Part 4 answer)
  - `notes/QA.md` (checklist + screenshots/URLs)

## Tasks
- Confirm staging access and create a lightweight working log (timestamps + what changed).
- Create a custom plugin scaffold (`idg-custom`) to hold:
  - CPT registration
  - ACF field registration/sync strategy
  - WooCommerce hooks/filters
- Create a child theme only if template overrides or theme-specific styling are needed.

## Acceptance Criteria
- All custom code is isolated and portable.
- No edits to theme core or WooCommerce core.

---

# Phase 1 — Avada Marketing Page (60–90 min)
## Deliverables
- One marketing page built with Avada Builder that includes:
  - Hero section (background image, headline, CTA button)
  - 3-column features section
  - One reusable global element (e.g., CTA strip)
  - Responsive behavior (mobile/tablet)

## “Senior” touches (lightweight)
- Keep builder usage lean: minimize nested containers and heavy effects.
- Use correct heading hierarchy (single H1, logical H2/H3).
- Ensure CTA is meaningful (label + destination).

## Acceptance Criteria
- Page passes a quick manual responsive check (mobile/tablet/desktop).
- Global element reusable and actually used.

---

# Phase 2 — Case Studies (CPT + ACF + Templates) (90–120 min)
## Deliverables
- CPT: `case_study` (label: Case Studies)
- ACF fields:
  - Client Name (text)
  - Project URL (url)
  - Industry (select)
  - Featured Result (number + suffix display e.g. “+42%”)
  - Flexible Content with at least 2 layouts
- Frontend:
  - Single template for case study
  - Listing page with query loop
- Dynamic output implemented in PHP templates (not embedded in builder text blocks).

## Implementation Strategy (what signals seniority)
- **Preferred location**: register CPT and templates in `idg-custom` plugin.
- Use `template_include` (or `single-case_study.php`/archive template if using theme hierarchy) in a child theme when needed.
- Sanitize + escape output properly (`esc_html`, `esc_url`, etc.).
- Use a small, readable template partial structure (no giant functions.php blob).

## ACF Sync Best Practice
- Use **ACF Local JSON** for field group versioning:
  - Save JSON to a tracked folder (`acf-json/`) via filters in the custom plugin or child theme.
  - Treat field groups as code-reviewed artifacts.

## Acceptance Criteria
- Listing page shows case studies (title + key fields) via a query.
- Single page renders all dynamic fields + flexible layouts.
- No hard-coded field values inside builder text blocks.

---

# Phase 3 — WooCommerce Setup + Customizations (60–90 min)
## Deliverables
- WooCommerce installed + configured
- Products:
  - 1 simple product
  - 1 variable product (>=2 attributes)
- Customizations (no core edits):
  - Custom product badge via hook/filter (e.g., “Best Seller”)
  - Display a custom ACF field on single product page

## Implementation Strategy
- Put Woo customizations in `idg-custom` plugin:
  - Badge: hook into single product summary or loop item output
  - ACF field display: output near price/summary with proper escaping
- Keep changes reversible via feature flags/constants if possible.

## Acceptance Criteria
- Badge renders in the correct context(s) and doesn’t break layouts.
- ACF field appears only when populated.

---

# Phase 4 — Debugging Scenario (20–30 min)
## Deliverable
- `notes/DEBUGGING.md` with a structured response:
  - Isolate (reproduce, check logs, plugin/theme toggles, recent deploy diff)
  - Diagnose (identify failing function, stack trace, input validation)
  - Prevent (PR review, CI checks, feature flags, error handling, staging gate)

## Acceptance Criteria
- Shows calm, stepwise production debugging and prevention mindset.

---

# Phase 5 — Short Written Questions (20–30 min)
## Deliverable
- `notes/QUESTIONS.md` answering:
  - When to avoid Avada Builder
  - How to keep ACF field groups in sync (Local JSON / code-driven fields)
  - How to reduce risk during plugin updates
  - How to choose hook vs template override vs custom plugin

## Acceptance Criteria
- Answers are short, direct, and demonstrate judgment.

---

# Phase 6 — QA, Submission, and “Make Review Easy” (30–45 min)
## Deliverables
- `notes/QA.md`
  - URLs to the marketing page, case study listing, a single case study, products
  - Quick checklist proving each requirement
  - Optional screenshots
- A single ZIP or Git repo with:
  - `idg-custom` plugin
  - child theme files (if used)
  - `notes/` folder

## Acceptance Criteria
- Reviewer can verify everything in <10 minutes.

---

# Optional Extra Credit (only if time remains)
- Add lightweight performance considerations:
  - avoid loading extra scripts globally
  - ensure images are appropriately sized
- Add basic coding standards:
  - PHP_CodeSniffer (WordPress rules) notes (no need to fully enforce in 4–6h)
- Add a minimal README with install/activation steps.

---

# Timeline (4–6 hours)
- Phase 0: 0:15–0:30
- Phase 1: 1:00–1:30
- Phase 2: 1:30–2:00
- Phase 3: 1:00–1:30
- Phase 4: 0:20–0:30
- Phase 5: 0:20–0:30
- Phase 6: 0:30–0:45

---

# Approval Questions (to confirm before execution)
1. Do you want to prioritize **speed** (meet requirements only) or **polish** (add extra-credit items if time)?
2. Are you comfortable submitting a **Git repo**, or do you prefer a **ZIP**?
3. Do you want me to structure the custom work as:
   - `idg-custom` plugin (recommended),
   - child theme only, or
   - both (only if needed for template overrides)?
