# Usage

The purpose of this bundle is to get out of the way of the developer, so you
shouldn't need to use it directly too much.

## Enable command bundle

Synopsis: `app/console wizard:enable:bundle fully-qualified-classname`.

*Heads up*: you can use the shortcut
`app/console wiz:e:b fully-qualified-classname`.

A fully qualified clasname is composed of the full namespace with the classname:

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
                new Gnugat\Bundle\WizardBundle\GnugatWizardBundle(),
                // <-- This is where the fully qualified classname would be added.
            );

            if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            }

            return $bundles;
        }
    }

## Enable package command

Synopsis: `app/console wizard:enable:package name`.

*Heads up*: you can use the shortcut `app/console wiz:e:p name`.

This command will convert the given composer package name into a fully
qualified classname, and then inserts it in the application's kernel.
