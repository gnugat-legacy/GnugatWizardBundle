# Introduction

This project removes manual steps from the bundle installation process and aims
at shrinking it into a single command.

To do so, it provides two commands to register a bundle into the application's
kernel:

* `wizard:register:bundle` which takes the bundle's fully qualified classname
  (e.g. `Acme\DemoBundle\AcmeDemoBundle`)
* `wizard:register:package` which takes the bundle's composer package name
  (e.g. `acme/demo-bundle`)

See the [usage documentation](03-usage.md) to learn more about them.

**Note**: By using the composer plugin
([gnugat/wizard-plugin](https://github.com/gnugat/wizard-plugin)), the only
command you need to run is `composer require <package>`.

## What's the point?

Bundle installation is currently too tedious: In order to install a bundle
into a Symfony2 application, you need to follow at least the 2 following steps:

1. downloading it
2. registering it

While the first step is achievable by running a command thanks to Composer, the
second one requires a manual edition of the application's kernel.

##  Next readings

* [installation](02-installation.md)
* [usage](03-usage.md)
* [tests](04-tests.md)
