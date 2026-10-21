# Upgrade inventory baseline

Captured from `main` at commit `b3c224e` before feature migration.

## Scope

- 229 runtime application routes (`php artisan route:list --except-vendor`)
- 46 controller classes
- 26 root Eloquent/auth models
- 52 migration files defining 39 original tables
- 50 persistent upload files in the current development snapshot

The route list is the compatibility contract: existing URI, HTTP method, and
route name must remain available until its final caller is migrated. Regenerate
the machine-readable inventory in staging with `php artisan route:list --json`.

## Original tables

`users`, `password_resets`, `failed_jobs`, `suppliers`, `materials`,
`purchase_orders`, `purchase_order_details`, `consumers`, `favorites`,
`products`, `categories`, `job_titles`, `sales_orders`,
`sales_order_details`, `discounts`, `material_logs`, `product_logs`,
`produces`, `produce_details`, `product_recipes`, `notifications`, `pictures`,
`carts`, `cart_details`, `produce_products`, `announcements`,
`consumer_password_resets`, `contacts`, `information`,
`semi_finished_products`, `tags`, `product_tag`, `employees`,
`employee_bank_accounts`, `employee_emergency_contacts`,
`employee_attendance_logs`, `employee_salary_records`,
`employee_salary_additions`, and `employee_salary_deductions`.

All future schema work must use additive, backward-compatible migrations. Do
not rename primary keys, rebuild tables, run `migrate:fresh`, or run `db:wipe`.

## Functional migration groups

1. Identity and permissions: staff and consumer sessions, password reset,
   staff account administration, policies, and navigation.
2. Master data and inventory: suppliers, materials, categories, tags,
   products, recipes, pictures, production, stock, and consumers.
3. Transactions: purchasing, sales, returns, billing, discounts, payment,
   delivery, cart, checkout, and order history.
4. HR and reporting: employees, attendance, salary, dashboards, analysis,
   CSV, PDF, accounts receivable, and accounts payable.
5. Public site: home, about, contact, announcements, products, consumer
   registration/profile, cart, and order history.

## Current compatibility bridge

Vue 3/Inertia/Vite owns newly migrated pages. Vue 2/Mix is isolated under
`legacy/` solely for Blade pages that remain in a later migration group. The
legacy dependency audit is expected to remain noisy and is removed with the
last Blade caller; production SSR and modern pages use only the root lockfile.
