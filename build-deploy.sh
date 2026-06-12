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

echo "==> Creating deployment zip..."
rm -rf deploy
mkdir -p deploy

# Zip the whole app EXCEPT things the server doesn't need or must not receive.
zip -r -q deploy/amadersomaj-deploy.zip . \
  -x '*.git*' \
  -x 'node_modules/*' \
  -x 'deploy/*' \
  -x 'tests/*' \
  -x 'storage/framework/cache/data/*' \
  -x 'storage/framework/sessions/*' \
  -x 'storage/framework/views/*' \
  -x 'storage/logs/*' \
  -x 'database/*.sqlite' \
  -x '.env' \
  -x 'build-deploy.sh'

echo ""
echo "==> Done:  deploy/amadersomaj-deploy.zip"
echo "    Upload that ONE file to your app folder on the server and extract it"
echo "    with cPanel File Manager. Then follow DEPLOY.md from step 4."
echo ""
echo "    NOTE: this left your local vendor/ without dev tools (phpunit, etc.)."
echo "    To restore local dev:  composer install"
