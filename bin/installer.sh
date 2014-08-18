#!/bin/sh

usage()
{
    cat <<EOT
Usage:
    installer.sh [--bundle-only]
    installer.sh -h | --help

Options:
    --bundle-only Does not install gnugat/wizard-plugin
    -h --help     Shows this screen
EOT
}

package='gnugat/wizard-plugin:~1'

case $1 in
    -h | --help)
        usage
        exit
        ;;
    --bundle-only)
        package='gnugat/wizard-bundle:~1'
        ;;
    '')
        ;;
    *)
        echo "ERROR: unknown argument \"$1\""
        usage
        exit 1
        ;;
esac

echo '[curl] Getting Composer, the PHP dependency manager'
curl -sS https://getcomposer.org/installer | php

echo '[composer] Downloading the dependencies'
php composer.phar require "$package"
