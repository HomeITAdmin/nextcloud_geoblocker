#!/bin/bash

echo ""
echo "<<<<<<<<<<<<<<< Unit Tests + Code Coverage  >>>>>>>>>>>>>>>"
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.xml --testdox --coverage-html build/coverage_report_unit --coverage-filter lib/

echo ""
echo ""
echo "<<<<<<<<<<<<<<< Special Unit Tests  >>>>>>>>>>>>>>>"
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.special1.xml --testdox
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.special2.xml --testdox
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.special3.xml --testdox

echo ""
echo ""
echo "<<<<<<<<<<<<<<< Integration Tests >>>>>>>>>>>>>>>"
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.integration.xml --testdox --coverage-html build/coverage_report_integration --coverage-filter lib/
