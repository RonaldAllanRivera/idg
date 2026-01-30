# Short Written Questions (Part 5)

## 1) When would you recommend avoiding the Avada Builder?
I’d avoid Avada Builder when:

- The page is on a **critical performance path** (Core Web Vitals / PageSpeed), and the builder’s extra markup/assets would be hard to justify.
- The layout is **template-driven and dynamic** (CPT archives, search results, product/category grids, complex query loops) where PHP templates are more maintainable than builder content.
- The project requires **high consistency and scalability** across many pages (shared components, predictable semantics/accessibility).
- The client wants **reduced lock-in** and easier future migrations.

I still use Avada for true marketing pages when it speeds delivery and the content is largely static.

## 2) ACF fields are stored in the database by default. How do you keep ACF field groups in sync across dev/staging/prod?
Preferred: version field definitions via **ACF Local JSON** or **ACF Tools → Export → PHP** (committed into a custom plugin/theme) so field groups are deployed through Git and not recreated manually.

Optional: use **ACF Local JSON** when the environment allows filesystem writes:

- Save field groups to a tracked `acf-json/` directory.
- Load JSON in each environment so field group changes are deployed through Git.

For this skills test, field groups were created in the WP Admin UI on staging due to filesystem/FTP constraints.

## 3) How would you reduce risk during plugin updates?
- Update on **staging first**, validate critical flows (checkout/cart, forms, SEO pages, caching behavior).
- Take a **DB backup + restore point** before updating.
- Update in **small batches** (one plugin or a small set) to isolate regressions.
- Maintain a **rollback plan** (revert plugin versions / restore DB snapshot).
- Monitor errors and UX:
  - Review PHP error logs
  - Enable logging on staging to catch fatals/notices early

## 4) How do you decide between using a hook, a template override, or a custom plugin?
- **Hook/filter**: best for small behavior changes where WordPress/WooCommerce provides stable extension points (least invasive, easiest to maintain).
- **Template override**: when you must change markup/layout significantly and hooks aren’t sufficient (keep overrides minimal and documented because updates can require re-checking diffs).
- **Custom plugin**: for reusable “feature/business logic” that should survive theme changes:
  - CPTs / taxonomies
  - WooCommerce custom behavior
  - integrations
  - ACF sync strategy

Rule of thumb: **presentation = theme/templates**, **features = plugin**, **small tweaks = hooks**.
