# QA Checklist & URLs

## URLs (fill in once complete)
- Marketing page: https://dev.staging.idgadvertising.com/ronald/
- Global element used on: 
- Case studies listing: 
- Case study single example: 
- Simple product: 
- Variable product: 
- Checkout page:

## Phase 1 — Marketing page (Avada)
- [x] Hero section has background image, headline, CTA
- [x] 3-column features section present
- [x] Global element created and reused
- [x] Responsive: mobile/tablet/desktop checked

## Phase 2 — Case Studies (CPT + ACF)
- [ ] CPT exists and can create entries
- [ ] ACF fields created and populated
- [ ] Flexible content has at least two layouts
- [ ] Listing page uses a query loop
- [ ] Single template renders dynamic fields
- [ ] Dynamic values are output via PHP (not hardcoded in builder text blocks)

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
- [ ] Case study listing + single loads
- [ ] Add-to-cart works
- [ ] Checkout loads without errors
