#!/bin/sh

echo '[behat] Running acceptance tests'

php vendor/bin/behat

echo '[phpspec] Running specification tests'

php vendor/bin/phpspec
rm -rf src # Fixes PHPSpec bug (creates a src directory)
