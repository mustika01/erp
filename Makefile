install:
	mkdir -p /var/log/nginx
	mkdir -p /var/cache/nginx
	composer install --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader --ignore-platform-req=ext-imagick
	PUPPETEER_CACHE_DIR=/app/.cache/puppeteer npm ci
	cp ./.puppeteerrc.dist.cjs ./.puppeteerrc.cjs

build:
	npm run prod
