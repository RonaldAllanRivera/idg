# Debugging Scenario (Part 4)

## Scenario
A recent update caused the checkout page to white-screen. Debug mode shows a fatal error related to a custom function added recently.

## How I would handle it

## 1) Isolate the issue
- Confirm the scope:
  - Is it only checkout, or cart/account too?
  - Is it logged-in only, or all users?
- Reproduce in a controlled way:
  - Use an incognito session
  - Use the same steps/order that triggers the issue
- Capture the evidence:
  - Screenshot the error
  - Copy the exact fatal error message + stack trace
- Identify what changed:
  - Check recent deploy notes / commit history / changed plugin/theme files

If the site is down in production, first priority is restoring checkout:
- Temporarily roll back the last change if possible, or disable the suspected custom code path.

## 2) Diagnose the root cause
- Use logs as the source of truth:
  - `wp-content/debug.log` (if enabled)
  - PHP-FPM/Apache logs (depending on hosting)
- Locate the custom function and determine:
  - Where it’s defined (child theme, custom plugin, mu-plugin)
  - How it’s called (hook/filter/action, direct call in a template)
  - What inputs it expects and what assumptions it makes
- Common fatal patterns I check immediately:
  - Function redeclared / wrong namespace / missing include
  - Calling a function/class that doesn’t exist (plugin dependency not active)
  - Wrong hook timing (running Woo/checkout logic before Woo is initialized)
  - Type errors (PHP 8 strictness) from unexpected values
  - Missing guard clauses when WooCommerce isn’t active

I’ll fix it at the source with a minimal, safe patch:
- Add guards (`function_exists`, `class_exists`, `is_admin`, `did_action`, etc.)
- Validate inputs and fail gracefully
- Ensure the hook is the correct one for checkout context

## 3) Prevent similar issues in the future
- Process controls:
  - Require code review (even lightweight) for checkout-related changes
  - Deploy to staging first, run a checkout smoke test before production
- Technical controls:
  - Add feature flags / configuration toggles for risky changes
  - Add defensive coding patterns (guards + clear error handling)
  - Add automated checks where feasible:
    - PHP linting
    - basic integration smoke tests (cart/checkout endpoints)
- Release discipline:
  - Smaller deploy batches
  - Clear rollback plan (DB snapshot + version pinning)

## Short summary
I treat checkout failures as a **revenue-impacting incident**: restore service quickly, use logs and diffs to pinpoint the exact change, fix with guarded code and correct hooks, then add a lightweight staging/QA gate to prevent repeats.
