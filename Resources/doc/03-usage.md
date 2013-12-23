# Usage

This file describes the available commands. If you installed the composer
plugin ([gnugat/wizard-plugin](https://github.com/gnugat/wizard-plugin)), the
only command you need to run is:

    composer require "<package>:<version>"

If the bundle has been locally created, or if it has been downloaded using
composer but not registered for some reasons, you can use one of the follwing
command:

* `app/console wizard:register:bundle <fully-qualified-classname>`
* `app/console wizard:register:package <composer-package-name>`

## Register package command

If the bundle has already been downloaded using composer, but needs to be
registered, use this command.

Example: `app/console wizard:register:package "acme/demo-bundle"`.

*Heads up*: you can use the shortcut `app/console wiz:r:p "acme/demo-bundle"`.

It converts the given composer package name into a fully
qualified classname, and then inserts it in the application's kernel.

## Register bundle command

If the bundle is present but hasn't been downloaded using composer (for
example local bundles), you can register it using this command.

Example: `app/console wizard:register:bundle "Acme\DemoBundle\AcmeDemoBundle"`.

*Heads up*: you can use the shortcut
`app/console wiz:r:b "Acme\DemoBundle\AcmeDemoBundle"`.

A fully qualified classname is composed of the full namespace with the classname:

    \<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>

This command simply adds it in the application's kernel (usually the
`app/AppKernel.php` file). For example:

    <?php
    // File: app/AppKernel.php

    use Symfony\Component\HttpKernel\Kernel;

    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
                // <-- This is where the fully qualified classname would be added.
            );

            if (in_array($this->getEnvironment(), array('dev', 'test'))) {
                $bundles[] = new Gnugat\Bundle\WizardBundle\GnugatWizardBundle();
            }

            return $bundles;
        }
    }

##  Next readings

* [tests](04-tests.md)

## Previous readings

* [introduction](01-introduction.md)
* [installation](02-installation.md)
