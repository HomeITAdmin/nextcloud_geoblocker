# This file is licensed under the Affero General Public License version 3 or
# later. See the COPYING file.

# Dependencies:
# * make
# * which
# * curl: used if phpunit and composer are not installed to fetch them from the web
# * tar: for building the archive
# * npm: for building and testing everything JS
# * ...
# ...

app_name=$(notdir $(CURDIR))
build_dir=$(CURDIR)/build
build_tools_directory=$(build_dir)/tools
source_build_directory=$(build_dir)/artifacts/source
source_package_name=$(source_build_directory)/$(app_name)
appstore_build_directory:=$(CURDIR)/build/appstore/$(app_name)
appstore_sign_dir=$(appstore_build_directory)/sign
appstore_artifact_directory:=$(CURDIR)/build/artifacts/appstore
appstore_package_name:=$(appstore_artifact_directory)/$(app_name)
# cert_dir=$(build_dir)/cert
cert_dir=$(HOME)/.nextcloud/certificates
npm=$(shell which npm 2> /dev/null)
composer=$(shell which composer 2> /dev/null)
version=0.5.5

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
ifneq (, $(npm))
	$(npm) install
else
	@echo "npm command not available, please install nodejs first"
	@exit 1
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

# Builds the source package for the app store for the github action
.PHONY: appstore2
appstore2:
	rm -rf $(appstore_build_directory) $(appstore_sign_dir) $(appstore_artifact_directory) 
	mkdir -p $(appstore_sign_dir)/$(app_name)
	cp -r \
	"3rdparty" \
	"appinfo" \
	"css" \
	"img" \
	"js" \
	"l10n" \
	"lib" \
	"templates" \
	"COPYING" \
	$(appstore_sign_dir)/$(app_name)

	rm -f $(appstore_sign_dir)/$(app_name)/3rdparty/maxmind_geolite2/*
	rm -f $(appstore_sign_dir)/$(app_name)/3rdparty/rir_data/*
	rm -f $(appstore_sign_dir)/$(app_name)/3rdparty/maxmind_geolite2/.gitkeep
	rm -f $(appstore_sign_dir)/$(app_name)/3rdparty/rir_data/.gitkeep
	rm -f $(appstore_sign_dir)/$(app_name)/3rdparty/.gitkeep

	mkdir -p $(cert_dir)
	php ./bin/tools/file_from_env.php "app_private_key" "$(cert_dir)/$(app_name).key"
	php ./bin/tools/file_from_env.php "app_public_crt" "$(cert_dir)/$(app_name).crt"

	#@if [ -f $(cert_dir)/$(app_name).key ]; then \
	#	echo "Signing app files…"; \
	#	php ../../occ integrity:sign-app \
	#		--privateKey=$(cert_dir)/$(app_name).key\
	#		--certificate=$(cert_dir)/$(app_name).crt\
	#		--path=$(appstore_sign_dir)/$(app_name); \
	#	echo "Signing app files ... done"; \
	#fi

	mkdir -p $(appstore_artifact_directory)
	tar -czf $(appstore_package_name).tar.gz -C $(appstore_sign_dir) $(app_name)

.PHONY: unit-test
unit-test:	
	$(CURDIR)/vendor/phpunit/phpunit/phpunit -c $(CURDIR)/phpunit.xml
	$(CURDIR)/vendor/phpunit/phpunit/phpunit -c $(CURDIR)/phpunit.special1.xml
	$(CURDIR)/vendor/phpunit/phpunit/phpunit -c $(CURDIR)/phpunit.special2.xml 
	$(CURDIR)/vendor/phpunit/phpunit/phpunit -c $(CURDIR)/phpunit.special3.xml 

.PHONY: integration-test
integration-test:
	$(CURDIR)/vendor/phpunit/phpunit/phpunit -c $(CURDIR)/phpunit.integration.xml
	
.PHONY: test
test: unit-test integration-test

.PHONY: unit-test-cov
unit-test-cov:	
	$(CURDIR)/vendor/phpunit/phpunit/phpunit -c $(CURDIR)/phpunit.xml --coverage-html $(CURDIR)/build/coverage_report_unit --coverage-filter $(CURDIR)/lib/

.PHONY: integration-test-cov
integration-test-cov:
	$(CURDIR)/vendor/phpunit/phpunit/phpunit -c $(CURDIR)/phpunit.integration.xml --coverage-html build/coverage_report_integration --coverage-filter lib/

.PHONY: test-cov
test-cov: unit-test-cov integration-test-cov

.PHONY: prepare-test
prepare-test: 
	make composer
	rm -R $(CURDIR)/../../3rdparty/nikic/php-parser/
	cp -R $(CURDIR)/vendor/nikic/php-parser/ $(CURDIR)/../../3rdparty/nikic/
	wget https://github.com/maxmind/GeoIP2-php/releases/latest/download/geoip2.phar -O $(CURDIR)/3rdparty/maxmind_geolite2/geoip2.phar
        chown www-data:1000 $(CURDIR)/3rdparty/maxmind_geolite2/geoip2.phar
