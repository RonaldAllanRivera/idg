# QA Checklist & URLs

## URLs (fill in once complete)
- Marketing page: https://dev.staging.idgadvertising.com/ronald/
- Global element used on: 
- Case studies listing (archive): https://dev.staging.idgadvertising.com/ronald/case-studies/
- Case studies listing (page with query loop): https://dev.staging.idgadvertising.com/ronald/all-case-studies/
- Case study single example: https://dev.staging.idgadvertising.com/ronald/case-studies/case-1/
- ACF field group (admin): https://dev.staging.idgadvertising.com/ronald/wp-admin/post.php?post=202&action=edit
- Case Studies (admin): https://dev.staging.idgadvertising.com/ronald/wp-admin/edit.php?post_type=case_study
- Listing shortcode helper (admin): https://dev.staging.idgadvertising.com/ronald/wp-admin/edit.php?post_type=case_study&page=idg-case-studies-shortcode
- Simple product: 
- Variable product: 
- Checkout page:

## Phase 1 — Marketing page (Avada)
- [x] Hero section has background image, headline, CTA
- [x] 3-column features section present
- [x] Global element created and reused
- [x] Responsive: mobile/tablet/desktop checked

## Phase 2 — Case Studies (CPT + ACF)
- [x] CPT exists and can create entries
- [x] ACF fields created and populated
- [x] Flexible content has at least two layouts
- [x] Listing page uses a query loop
- [x] Single template renders dynamic fields
- [x] Dynamic values are output via PHP (not hardcoded in builder text blocks)

## Phase 3 — WooCommerce
- [ ] WooCommerce configured (currency, pages)
- [ ] Simple product created
- [ ] Variable product created with >=2 attributes
- [ ] Product badge appears as expected
- [ ] Custom ACF field displays on single product page
- [ ] No WooCommerce core files edited

## Phase 4 — Debugging scenario
- [ ] `notes/DEBUGGING.md` included

## Phase 5 — Written questions
- [ ] `notes/QUESTIONS.md` included

## Quick Smoke Tests
- [ ] Homepage loads
- [ ] Marketing page loads
- [x] Case study listing + single loads
- [ ] Add-to-cart works
- [ ] Checkout loads without errors
