# CHANGELOG

This file logs the changes between versions.

## 2.0: albus-dumbledore

### 2.0.0: Integration in Symfony Standard Edition

* removed `enable` aliases from the commands [BC BREAK]
* udated documentation
* removed `DependencyInjection\Factory`
* removed `EventListener\ComposerListener`

## 1.2: fytherley-undercliffe

### 1.2.0: PSR4 support

* added PSR4 support
* fixed dependencies version to stable ones

## 1.1: edessa-sakndenberg

### 1.1.3: Community feedback

* fixed `installer.sh` script for PHP 5.5
* fixed stability by moving composer to the development requirements
* added input validation for the `wizard:register:bundle` command
* added messages to report when the task is done
* changed from `__construct` to `congirure` in commands

### 1.1.2: Bug fix

* fixed syntax error
* fixed installation version

### 1.1.1: Fixed [fourth Insight analysis](https://insight.sensiolabs.com/projects/dd522b32-abcf-47b8-a2ad-fa18e7c035ec/analyses/4)

* removed unused `use` statement

### 1.1.0: Automatic registration on bundle installation

* changed `enable` verb to `register`
* created the Composer event listener:
  - takes a composer package event (e.g. `post-package-install`)
  - extracts its composer package name
  - finds its associated namespace
  - makes the bundle's fully qualified classname out of it
  - adds it in the application's kernel

## 1.0: phyllida-spore

### 1.0.1: Fixed [first Insight analysis](https://insight.sensiolabs.com/projects/dd522b32-abcf-47b8-a2ad-fa18e7c035ec/analyses/1)

* added Insight widget to README
* fixed logo size
* fixed permission rights

### 1.0.0: Enable commands

* improved the documentation
* removed the `sf-factory:bundle:install` command
* created the `wizard:enable:package` command:
  - takes a composer package name
  - finds its associated namespace in the installed packages
  - makes the bundle's fully qualified classname out of it
  - adds it in the application's kernel
* created the `wizard:enable:bundle` command:
  - takes a fully qualified classname
  - adds it in the application's kernel
* changed unit tests to specification tests (PHPSpec instead of PHPUnit)
* created acceptance tests with behat
* renamed the bundle to `GnugatWizardBundle`
* changed the git flow to `master => feature => master` cycle

## 0.1.2: Fixed quality

* fixed dead code
* fixed permissions
* fixed test/code coverage
* fixed synopsis coupling with command definition

## 0.1.1: Fixed tests

* fixed CommandTestCase by making it abstract
* fixed undefined namespace constant error
* fixed command name in tests

## 0.1.0: Initial release

* created `sf-factory:bundle:install` command:
  - `composer require` call
  - `AppKernel` line adding
