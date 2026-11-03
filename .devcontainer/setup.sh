#!/usr/bin/env bash
set -euo pipefail

APP_ID="geoblocker"

cd /srv/nextcloud
if [ ! -f config/config.php ]; then
  php occ maintenance:install --database=sqlite \
    --admin-user=admin --admin-pass=admin
  php occ config:system:set debug --type=boolean --value=true
fi

if [ -f "apps/$APP_ID/composer.json" ]; then
  (cd "apps/$APP_ID" && composer install)
fi

php occ app:enable --force "$APP_ID"

# Test prerequisites for the MaxMind GeoLite2 service
cd "apps/$APP_ID"
curl -fsSL https://github.com/maxmind/GeoIP2-php/releases/latest/download/geoip2.phar \
  -o 3rdparty/maxmind_geolite2/geoip2.phar

MMDB=/var/lib/GeoIP/GeoLite2-Country.mmdb
if [ ! -f "$MMDB" ]; then
  if [ -n "${MAXMIND_ACCOUNT_ID:-}" ] && [ -n "${MAXMIND_LICENSE_KEY:-}" ]; then
    curl -fsSL -u "$MAXMIND_ACCOUNT_ID:$MAXMIND_LICENSE_KEY" \
      "https://download.maxmind.com/geoip/databases/GeoLite2-Country/download?suffix=tar.gz" \
      | tar -xz --strip-components=1 -C /var/lib/GeoIP --wildcards '*/GeoLite2-Country.mmdb'
  else
    echo "WARNING: MAXMIND_ACCOUNT_ID/MAXMIND_LICENSE_KEY not set, $MMDB not downloaded." \
      "MaxMind GeoLite2 tests will fail." >&2
  fi
fi