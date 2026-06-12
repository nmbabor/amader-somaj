#!/usr/bin/env bash
#
# Builds a production-ready deployment package for shared hosting.
# Produces: deploy/amadersomaj-deploy.zip  (upload this one file, then extract
# it on the server with cPanel File Manager).
#
# Run on your LOCAL machine:  bash build-deploy.sh
#
set -e

echo "==> Installing production PHP dependencies (no dev packages)..."
composer install --optimize-autoloader --no-dev

echo "==> Building front-end assets (Tailwind/Vite)..."
npm install
npm run build

# Empty the local framework caches but KEEP the directory structure + the
# .gitignore placeholders, so the required storage/framework/* dirs ship in the
# zip (their absence causes "Please provide a valid cache path." on the server).
echo "==> Clearing local caches..."
php artisan optimize:clear || true

echo "==> Creating deployment zip..."
rm -rf deploy
mkdir -p deploy

# IMPORTANT: exclude the ".git" repo dir only — NOT ".gitignore" files, which
# keep the otherwise-empty storage/framework/* and bootstrap/cache dirs alive.
# We exclude generated cache *content* but never the directories themselves.
zip -r -q deploy/amadersomaj-deploy.zip . \
  -x '.git/*' \
  -x 'node_modules/*' \
  -x 'deploy/*' \
  -x 'tests/*' \
  -x 'storage/framework/views/*.php' \
  -x 'storage/logs/*.log' \
  -x 'bootstrap/cache/*.php' \
  -x 'database/*.sqlite' \
  -x 'database/*.sqlite-journal' \
  -x '.env' \
  -x 'build-deploy.sh'

# Safety check: the framework dirs MUST be in the archive (empty dirs are kept
# alive by their .gitignore). Fail loudly if any are missing.
for d in storage/framework/views storage/framework/cache storage/framework/sessions bootstrap/cache; do
  if ! unzip -l deploy/amadersomaj-deploy.zip "$d/*" >/dev/null 2>&1; then
    echo "WARNING: $d not found in zip — the server will error. Check .gitignore exists in it."
  fi
done

echo ""
echo "==> Done:  deploy/amadersomaj-deploy.zip"
echo "    Upload that ONE file to your app folder on the server and extract it"
echo "    with cPanel File Manager. Then follow DEPLOY.md from step 4."
echo ""
echo "    NOTE: this left your local vendor/ without dev tools (phpunit, etc.)."
echo "    To restore local dev:  composer install"
