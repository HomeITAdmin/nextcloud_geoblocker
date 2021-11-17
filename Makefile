# This file is licensed under the Affero General Public License version 3 or
# later. See the COPYING file.

# Generic Makefile for building and packaging a Nextcloud app which uses npm and
# Composer.
#
# Dependencies:
# * make
# * which
# * curl: used if phpunit and composer are not installed to fetch them from the web
# * tar: for building the archive
# * npm: for building and testing everything JS
#
# If no composer.json is in the app root directory, the Composer step
# will be skipped. The same goes for the package.json which can be located in
# the app root or the js/ directory.
#
# The npm command by launches the npm build script:
#
#    npm run build
#
# The npm test command launches the npm test script:
#
#    npm run test
#
# The idea behind this is to be completely testing and build tool agnostic. All
# build tools and additional package managers should be installed locally in
# your project, since this won't pollute people's global namespace.
#
# The following npm scripts in your package.json install and update the bower
# and npm dependencies and use gulp as build system (notice how everything is
# run from the node_modules folder):
#
#    "scripts": {
#        "test": "node node_modules/gulp-cli/bin/gulp.js karma",
#        "prebuild": "npm install && node_modules/bower/bin/bower install && node_modules/bower/bin/bower update",
#        "build": "node node_modules/gulp-cli/bin/gulp.js"
#    },

app_name=$(notdir $(CURDIR))
build_dir=$(CURDIR)/build
build_tools_directory=$(build_dir)/tools
source_build_directory=$(build_dir)/artifacts/source
source_package_name=$(source_build_directory)/$(app_name)
cert_dir=$(build_dir)/cert
npm=$(shell which npm 2> /dev/null)
composer=$(shell which composer 2> /dev/null)
version=0.5.1

all: build

# Fetches the PHP and JS dependencies and compiles the JS. If no composer.json
# is present, the composer step is skipped, if no package.json or js/package.json
# is present, the npm step is skipped
.PHONY: build
build:
ifneq (,$(wildcard $(CURDIR)/composer.json))
	make composer
endif
ifneq (,$(wildcard $(CURDIR)/package.json))
	make npm
endif
ifneq (,$(wildcard $(CURDIR)/js/package.json))
	make npm
endif

# Installs and updates the composer dependencies. If composer is not installed
# a copy is fetched from the web
.PHONY: composer
composer:
ifeq (, $(composer))
	@echo "No composer command available, downloading a copy from the web"
	mkdir -p $(build_tools_directory)
	curl -sS https://getcomposer.org/installer | php
	mv composer.phar $(build_tools_directory)
	php $(build_tools_directory)/composer.phar install --prefer-dist
	php $(build_tools_directory)/composer.phar update --prefer-dist
else
	composer install --prefer-dist
	composer update --prefer-dist
endif

# Installs npm dependencies
.PHONY: npm
npm:
ifeq (,$(wildcard $(CURDIR)/package.json))
	cd js && $(npm) build
else
	npm build
endif

# Removes the appstore build
.PHONY: clean
clean:
	rm -rf $(build_tools_directory)
	rm -rf $(source_build_directory)
	rm -rf $(build_dir)/$(app_name)-*.tar.gz

# Same as clean but also removes dependencies installed by composer, bower and
# npm
.PHONY: distclean
distclean: clean
	rm -rf vendor
	rm -rf node_modules
	rm -rf js/vendor
	rm -rf js/node_modules

# Builds the source and appstore package
.PHONY: dist
dist:
	make source
	make appstore

# Builds the source package
.PHONY: source
source:
	rm -rf $(source_build_directory)
	mkdir -p $(source_build_directory)
	tar cvzf $(source_package_name).tar.gz ../$(app_name) \
	--exclude-vcs \
	--exclude="../$(app_name)/build" \
	--exclude="../$(app_name)/js/node_modules" \
	--exclude="../$(app_name)/node_modules" \
	--exclude="../$(app_name)/*.log" \
	--exclude="../$(app_name)/js/*.log" \

.PHONY: release
release: appstore create-tag

.PHONY: create-tag
create-tag:
	git tag -s -a v$(version) -m "Tagging the $(version) release."
	git push origin v$(version)

# Builds the source package for the app store, ignores php and js tests
.PHONY: appstore
appstore:
	tar cvz \
	--exclude-vcs \
	--exclude="../$(app_name)/build" \
	--exclude="../$(app_name)/tests" \
	--exclude="../$(app_name)/Makefile" \
	--exclude="../$(app_name)/README.md" \
	--exclude="../$(app_name)/phpunit*.xml" \
	--exclude="../$(app_name)/composer.*" \
	--exclude="../$(app_name)/package*.json" \
	--exclude="../$(app_name)/.*" \
	--exclude="../$(app_name)/runtest.sh" \
	--exclude="../$(app_name)/helper_scripts" \
	--exclude="../$(app_name)/3rdparty/*/*" \
	--exclude="../$(app_name)/3rdparty/.*" \
	--exclude="../$(app_name)/l10n/.*" \
	--exclude="../$(app_name)/vendor" \
	--exclude="../$(app_name)/node_modules" \
	-f $(build_dir)/$(app_name)-$(version).tar.gz ../$(app_name)
	@if [ -f $(cert_dir)/$(app_name).key ]; then \
		echo "Signing package…"; \
		openssl dgst -sha512 -sign $(cert_dir)/$(app_name).key $(build_dir)/$(app_name)-$(version).tar.gz | openssl base64; \
	fi

.PHONY: unit-test
unit-test:	
	$(CURDIR)/vendor/phpunit/phpunit/phpunit -c $(CURDIR)/phpunit.xml
	
.PHONY: test
test: 	make unit-test
	

.PHONY: prepare-test
prepare-test: 
	make composer
	rm -R $(CURDIR)/../../3rdparty/nikic/php-parser/
	cp -R $(CURDIR)/vendor/nikic/php-parser/ $(CURDIR)/../../3rdparty/nikic/
	wget https://github.com/maxmind/GeoIP2-php/releases/latest/download/geoip2.phar -O 3rdparty/maxmind_geolite2/geoip2.phar
