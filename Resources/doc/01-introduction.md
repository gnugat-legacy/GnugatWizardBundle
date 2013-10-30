# Introduction

This project aims at shrinking bundle installation to one single step. Here's
why and how.

## Bundle installation is too tedious

In order to install a bundle into a Symfony2 application, you need at least the
2 following steps:

1. downloading it
2. enabling it

While the first step is achievable by running a command thanks to Composer, the
second one requires a manual edition of the application's kernel.

In the worst case scenario, the following steps can be added:

* creating a bundle (which can extends the installed one)
* creating some classes
* configuring it
* importing its routes

## Possible ways to achieve the single step installation

Downloading and enabling a bundle can definitively be done in one command:

1. create a command that enables it
2. add it to composer's scripts, on a post package installation event

### Automatic configuration

The idea is to create a command that asks interractively the user the values he
wants to use for each non-null and required parameters which hasn't any default
value.

To detect them, there is two possible ways:

1. read the exposed configuration throught the
   `DependencyInjection\Configuration` class
2. laucnh the kernel and catch the exception which indicates the missing
   parameter
