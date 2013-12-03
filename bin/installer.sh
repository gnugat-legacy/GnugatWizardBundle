#!/bin/sh

if ! hash "composer" 2>/dev/null && ! hash "composer.phar" 2>/dev/null; then
    echo '[curl] Getting Composer, the PHP dependency manager'
    curl -sS https://getcomposer.org/installer | php
    mv composeR.phar composer
fi

echo '[composer] Downloading the bundle'
composer require "gnugat/wizard-bundle:~1"

PHP_VERSION=`php -v`
PHP_OPEN_TAG=''
if ( echo $PHP_VERSION | grep -vq "PHP 5.5" ); then
    PHP_OPEN_TAG='<?php'
fi

echo '[php] Subscribing to the post-package-install event'
php -a <<EOF
$PHP_OPEN_TAG 
\$composerConfigFile = file_get_contents('composer.json');
\$composerConfig = json_decode(\$composerConfigFile, true);

if (!isset(\$composerConfig['scripts'])) {
    \$composerConfig['scripts'] = array();
}

if (!isset(\$composerConfig['scripts']['post-package-install'])) {
    \$composerConfig['scripts']['post-package-install'] = array();
}

\$composerConfig['scripts']['post-package-install'][] = 'Gnugat\\Bundle\\WizardBundle\\EventListener\\ComposerListener::registerPackage';
\$composerConfigFile = json_encode(\$composerConfig, JSON_PRETTY_PRINT);
file_put_contents('composer.json', \$composerConfigFile);
EOF

echo '[sed] Enabling the bundle'
sed -i 's/        }/            $bundles[] = new Gnugat\\Bundle\\WizardBundle\\GnugatWizardBundle();\n        }/' app/AppKernel.php
