# Installation

By default, running the `bin/installer.sh` script will download the composer
plugin ([gnugat/wizard-plugin](https://github.com/gnugat/wizard-plugin)) which
requires this bundle.

This means once the script is done, you can simply run
`composer require "<package>:<version>"` to download and register a bundle in
your Symfony2 application.

If you want to install this bundle without the plugin, the script provides a
`--bundle-only` option.

If you want to manually install the bundle, just follow the following steps
(those are exactly what the `bin/installer.sh` script does).

## 1. Downloading

First of all, you should download the bundle using
[Composer](http://getcomposer.org/):

    composer require "gnugat/wizard-plugin:~1"

If you want to install the bundle without the plugin, use:

    composer require "gnugat/wizard-bundle:~1"

## 2. Registering the bundle

*Heads up*: This is the kind of step you will never have to follow again with
other bundles!

Then simply register it by adding its fully qualified classname in the
application's kernel, for example like this:

    <?php
    // File: app/AppKernel.php

    use Symfony\Component\HttpKernel\Kernel;

    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // Other bundles...
            );

            if (in_array($this->getEnvironment(), array('dev', 'test'))) {
                // Other bundles...
                $bundles[] = new Gnugat\Bundle\WizardBundle\GnugatWizardBundle();
            }

            return $bundles;
        }
    }

##  Next readings

* [usage](03-usage.md)
* [tests](04-tests.md)

## Previous readings

* [introduction](01-introduction.md)
