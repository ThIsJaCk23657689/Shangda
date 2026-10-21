# Laravel 13 migration runbook

`main` remains the production Laravel 7 branch. Development happens on
`codex/upgrade-laravel13`; `upgrade/laravel8` is reference-only and must not be
merged wholesale.

## Required runtime

- Ubuntu with Nginx and PHP-FPM 8.3 or newer
- MySQL 8
- Node.js 22 or newer
- A persistent `storage/app/public` directory shared between releases

## Build strategy during phased migration

The Vite build in the repository root produces the Vue 3/Inertia application in
`public/build`. A temporary, isolated package under `legacy/` compiles Vue 2
assets for Blade pages that have not yet migrated. Delete the legacy package and
Mix configuration after the final Blade page moves to Inertia.

## Database safety

Never run `migrate:fresh`, `db:wipe`, or destructive schema changes against a
production copy. Every migration must remain readable by the Laravel 7 release
until cutover is complete. Automated tests use the dedicated
`shangda_testing` database configured in `phpunit.xml`.

## Release rehearsal

1. Back up the database and persistent uploads.
2. Restore an anonymized production snapshot to staging.
3. Run migrations and the storage audit.
4. Run PHPUnit, frontend unit tests, the production build, and Playwright.
5. Verify `/up`, the SSR service, scheduled commands, mail, PDF/CSV exports, and
   the route compatibility inventory.
6. Switch Nginx to the new release only after reconciliation checks pass.

Rollback switches Nginx back to the prior release. Migrations must stay
backward-compatible so the prior code can continue reading the upgraded schema.
