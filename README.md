# Wizard bundle

No more manual edition of the `app/AppKernel.php` file during a bundle
installation thanks to GnugatWizardBundle:

    app/console wiz:e:b 'Acme\DemonBundle\AcmeDemoBundle'
    # or
    composer require 'acme/demo-bunlde:*'
    app/console wiz:e:p 'acme/demo-bunlde'

## Installation

This is the last time you will have to follow these step to install a bundle!

First of all download the bundle using [Composer](http://getcomposer.org/):

    composer require gnugat/wizard-bundle

Then enable the bundle by adding it in `app/AppKernel.php` (for `dev` and `test`
environments):

    <?php
    public function registerBundles()
    {
        // ...
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Gnugat\Bundle\WizardBundle\GnugatWizardBundle();
        }
    }

## Usage

Lost in the shell? Don't panic! Here's how to display a friendly and helpful
message:

    app/console wiz:e:b -h
    app/console wiz:e:p -h

## Tests

You can run the tests with the following script:

    sh bin/test.sh

## Further documentation

Git tags are used to indicate versions, you can either check it:

* [from Github](https://github.com/gnugat/GnugatWizardBundle/releases)
* using the `git tag` command

You can find more documentation at the following links:

* [copyright and MIT license](LICENSE)
* [changes between versions](CHANGELOG.md);
* [versioning and branching models](VERSIONING.md);
* [contribution instructions](CONTRIBUTING.md).

This project began as a hackday at [SensioLabs](http://sensiolabs.com/).
