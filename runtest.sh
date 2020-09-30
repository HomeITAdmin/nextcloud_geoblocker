#!/bin/bash

echo ""
echo "<<<<<<<<<<<<<<< Unit Tests + Code Coverage  >>>>>>>>>>>>>>>"
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.xml --testdox --coverage-html build/coverage_report --coverage-filter lib/

echo ""
echo ""
echo "<<<<<<<<<<<<<<< Special Unit Tests  >>>>>>>>>>>>>>>"
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.special.xml --testdox

echo ""
echo ""
echo "<<<<<<<<<<<<<<< Integration Tests >>>>>>>>>>>>>>>"
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.integration.xml --testdox
