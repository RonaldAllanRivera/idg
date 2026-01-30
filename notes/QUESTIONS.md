# Short Written Questions (Part 5)

## 1) When would you recommend avoiding the Avada Builder?
I’d avoid Avada Builder when:

- The page needs to be **as fast as possible** (for SEO and conversions), and the builder’s extra layout code could slow it down.
- The page is **mostly driven by data** (for example: a list of products, search results, or a “Case Studies” listing). Those are usually easier to keep clean and consistent with purpose-built templates.
- The site needs **lots of consistency** across many pages, where a more structured approach is easier to maintain long-term.
- The client wants **less lock-in** (so changing themes later is easier).

I still use Avada for true marketing pages when it speeds delivery and the content is mostly static.

## 2) ACF fields are stored in the database by default. How do you keep ACF field groups in sync across dev/staging/prod?
Best practice is to **save the field setup in version control**, so you don’t have to manually recreate fields in each environment.

- One approach is to have ACF save field definitions into files (often called “Local JSON”) so the fields can be deployed along with the code.
- Another approach is exporting the field group into code and keeping it inside a custom plugin or theme.

For this skills test, field groups were created in the WordPress admin on staging due to deployment constraints.

## 3) How would you reduce risk during plugin updates?
- Update on **staging first**, not production, and test the important paths (checkout, forms, key pages).
- Take a **backup** so you can quickly restore if something goes wrong.
- Update in **small batches** (one plugin, or a small group at a time) so it’s clear what caused any issue.
- Have a **rollback plan** (revert the plugin version and/or restore the backup).
- After updating, watch for errors and broken user flows (error logs + quick manual testing).

## 4) How do you decide between using a hook, a template override, or a custom plugin?
- **Hook/filter**: best for small changes when the platform gives you a safe “extension point.” This is usually the least risky and easiest to maintain.
- **Template override**: best when you need to change the actual page structure/layout and hooks aren’t enough. I keep these minimal because theme/plugin updates can require re-checking them.
- **Custom plugin**: best for reusable “site features” that should keep working even if the theme changes (custom post types, WooCommerce custom behavior, integrations, etc.).

Rule of thumb: **design/layout lives in the theme**, **site features live in a plugin**, **small tweaks use hooks**.
