# Installation

The `bin/installer.sh` script allows you to do automagically all the steps
described here.

## 1. Downloading

First of all, you should download the bundle using
[Composer](http://getcomposer.org/):

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

## 3. Binding the registration to Composer events

Finally, subscribe the
`Gnugat\Bundle\WizardBundle\EventListener\ComposerListener` class to the
Composer's `post-package-install` event, in the `composer.json` file:

    {
        "scripts": {
            "post-package-install": [
                "Gnugat\\Bundle\\WizardBundle\\EventListener\\ComposerListener::registerPackage",
            ]
        }
    }
