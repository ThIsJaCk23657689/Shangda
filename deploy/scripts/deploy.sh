#!/usr/bin/env bash
set -euo pipefail

release_path="${1:?Usage: deploy.sh /absolute/release/path}"

cd "$release_path"

composer install --no-dev --classmap-authoritative --no-interaction
npm ci
npm run build:ssr
npm --prefix legacy ci
npm run legacy:build

php artisan migrate --force
php artisan optimize
php artisan storage:link --force

sudo systemctl restart php8.3-fpm
sudo systemctl restart shangda-ssr
sudo systemctl reload nginx

php artisan about --only=environment
curl --fail --silent --show-error http://127.0.0.1/up
