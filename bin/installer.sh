#!/bin/sh

if ! hash "composer" 2>/dev/null && ! hash "composer.phar" 2>/dev/null; then
    echo '[curl] Getting Composer, the PHP dependency manager'
    curl -sS https://getcomposer.org/installer | php
    mv composeR.phar composer
fi

echo '[composer] Downloading the bundle'
composer require "gnugat/wizard-bundle:~1.0"

echo '[sed] Enabling the bundle'
sed -i 's/        }/            $bundles[] = new Gnugat\\Bundle\\WizardBundle\\GnugatWizardBundle();\n        }/' app/AppKernel.php
