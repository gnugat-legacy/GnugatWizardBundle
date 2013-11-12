# Usage

Registering bundles which have to be downloaded can be done with the following
command:

    composer require "acme/demo-bundle:~1.0"

If the bundle doesn't need to be downloaded using composer, use one of the
following command.

## Register package command

If the bundle has already been downloaded using composer, but needs to be
registered, use this command.

Synopsis: `app/console wizard:register:package name`.

*Heads up*: you can use the shortcut `app/console wiz:r:p name`.

It converts the given composer package name into a fully
qualified classname, and then inserts it in the application's kernel.

## Register bundle command

If the bundle is present but hasn't been downloaded using composer (for
example local bundles), you can register it using this command.

Synopsis: `app/console wizard:register:bundle fully-qualified-classname`.

*Heads up*: you can use the shortcut
`app/console wiz:r:b fully-qualified-classname`.

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
