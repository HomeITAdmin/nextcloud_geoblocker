#!/bin/bash

echo ""
echo "<<<<<<<<<<<<<<< Run Unit Tests  >>>>>>>>>>>>>>>"
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.xml --testdox

echo ""
echo ""
echo "<<<<<<<<<<<<<<<Integration Tests>>>>>>>>>>>>>>>"
echo ""
vendor/phpunit/phpunit/phpunit -c phpunit.integration.xml --testdox
