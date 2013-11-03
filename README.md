# Gnugat Wizard Bundle

Removes [muggle](http://en.wikipedia.org/wiki/Muggle) steps from bundle
installation (for instance the manual edition of `app/AppKernel.php`) by
shrinking it to a single command:

    composer require 'acme/demo-bunlde:*'

Find out more and get enchanted with the following
[introduction](Resources/doc/01-introduction.md).

![GnugatWizardBundle logo](Resources/img/logo.jpg)

## Features

For now you can enable a bundle using the following commands:

    # Enabling a local bundle:
    app/console wiz:e:b "Acme\DemoBundle\AcmeDemoBundle"

    # Enabling a composer package:
    composer require "acme/demo-bundle:*"
    app/console wiz:e:p "acme/demo-bundle"

Read more about the usage with the
[documentation](Resources/doc/03-usage.md).

The following improvements are currently under heavy witchcrafting:

* automagic running of the command after `composer require`
* interractive configuration
* bundle removal
* bundle renaming

## Installation

To download and install this bundle into your [Symfony2](http://symfony.com/)
application, run the following command:

    curl -sS  https://raw.github.com/gnugat/GnugatWizardBundle/master/bin/installer.sh | sh

Learn more about installation by reading its
[documentation](Resources/doc/02-installation.md).

## Tests

You can run the tests with the following script:

    sh bin/tester.sh

Grasp more about those tests by having a look at the
[documentation](Resources/doc/04-tests.md).

## Further documentation

You can see the current and past versions using one of the following:

* the `git tag` command
* the [releases page on Github](https://github.com/gnugat/GnugatWizardBundle/releases)
* the file listing the [changes between versions](CHANGELOG.md)

You can find more documentation at the following links:

* [copyright and MIT license](LICENSE)
* [versioning and branching models](VERSIONING.md)
* [contribution instructions](CONTRIBUTING.md)
* [documentation directory](Resources/doc)

This project began as a hackday at [SensioLabs](http://sensiolabs.com/), with
the help of:

* [Loïc Chardonnet](https://github.com/gnugat) (lead developer)
* [Inal Djafar](https://github.com/inalgnu)
* [Thomas Gay](https://github.com/thomas-gay)
* [Kathryn Greer](https://github.com/KathrynG)
* [Julien Didier](https://github.com/juliendidier)
* [Mickaël Andrieu](https://github.com/mickaelandrieu)
* and other
  [awesome developers](https://github.com/gnugat/GnugatWizardBundle/graphs/contributors)
