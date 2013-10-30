#!/bin/sh

usage()
{
    cat <<EOT
Usage:
    tester.sh [-a | --acceptance] [-s | --specification]
    tester.sh -h | --help

Options:
    -a --acceptance    Runs acceptance tests using Behat
    -s --specification Runs specification tests using phpspec
    -h --help          Show this screen
EOT
}

has_acceptance_tests=false
has_specification_tests=false

if [ $# -eq 0 ]; then
    has_acceptance_tests=true
    has_specification_tests=true
fi

case $1 in
    -h | --help)
        usage
        exit
        ;;
    -a | --acceptance)
        has_acceptance_tests=true
        ;;
    -s | --specification)
        has_specification_tests=true
        ;;
    '')
        ;;
    *)
        echo "ERROR: unknown argument \"$1\""
        usage
        exit 1
        ;;
esac

if $has_acceptance_tests; then
    echo '[behat] Running acceptance tests'
    php vendor/bin/behat -c=Resources/config/behat.yml
fi

if $has_specification_tests; then
    echo '[phpspec] Running specification tests'
    php vendor/bin/phpspec
    rm -rf src # Fixes PHPSpec bug (creates a src directory)
fi
