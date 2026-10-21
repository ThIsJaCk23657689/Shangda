# Backup and rollback procedure

Use a release-specific directory and timestamp for every staging rehearsal and
production deployment. Never place database dumps under the web root.

## Before deployment

1. Put the site into a controlled maintenance window.
2. Create a MySQL 8 single-transaction dump including routines, triggers, and
   events; record its SHA-256 hash.
3. Run `php artisan storage:audit --write-manifest=/backup/storage.json`.
4. Archive the persistent `storage/app/public` directory and record the archive
   size and SHA-256 hash.
5. Record the active release path, Git commit, migration status, PHP version,
   Node version, and SSR service status.
6. Restore both backups into staging and prove they are readable before the
   production migration starts.

## Cutover checks

- Run `php artisan migrate --force`; never use destructive migration commands.
- Run `php artisan storage:audit --manifest=/backup/storage.json` after files
  are copied.
- Verify `/up`, Nginx, PHP-FPM, the Node SSR service, scheduler, mail, PDF/CSV,
  both login guards, purchasing, sales, returns, payroll, cart, and checkout.

## Rollback

Switch Nginx back to the recorded prior release and restart PHP-FPM/SSR for that
release. Because upgrade migrations are additive, do not automatically run
`migrate:rollback`. Restore the database and upload archive only when the
incident explicitly requires data rollback and the business owner has approved
discarding post-cutover transactions.
