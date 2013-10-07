# SfFactoryBundleCommandBundle

Installing a bundle in the [Symfony2 framework](http://symfony.com) is pretty
tiresome, you must:

1. run `composer require <bundle> <version>` to download it
2. manually edit the `app/AppKernel.php` file to enable it

This bundle enables you to do it in one single step:

    app/console sf-factory:bundle:install <bundle> <version>

## Installation

This is the last time you will have to follow these step to install a bundle!

First of all download the bundle using [Composer](http://getcomposer.org/):

    composer require --dev sf-factory/bundle-command-bundle

Then enable the bundle by adding it in the Kernel (for `dev` and `test`
environments):

    <?php
    public function registerBundles()
    {
        // ...
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new SfFactory\BundleCommandBundle\SfFactoryBundleCommandBundle();
        }
    }

## Further documentation

Git tags are used to indicate versions, you can either check it:

* [from Github](https://github.com/sf-factory/SfFactoryBundleCommandBundle/releases)
* using the `git tag` command

You can find more documentation at the following links:

* [copyright and MIT license](LICENSE.md)
* [changes between versions](CHANGELOG.md);
* [versioning and branching models](VERSIONING.md);
* [contribution instructions](CONTRIBUTING.md).

This project began as a hackday at [SensioLabs](http://sensiolabs.com/).
