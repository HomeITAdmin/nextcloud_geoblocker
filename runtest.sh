#!/bin/bash

echo ""
echo "<<<<<<<<<<<<<<< Unit Tests  >>>>>>>>>>>>>>>"
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.xml --testdox

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
