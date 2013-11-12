# Introduction

This project aims at shrinking bundle installation to one single step. Here's
why and how.

## Bundle installation is too tedious

In order to install a bundle into a Symfony2 application, you need at least the
2 following steps:

1. downloading it
2. registering it

While the first step is achievable by running a command thanks to Composer, the
second one requires a manual edition of the application's kernel.

In the worst case scenario, the following steps can be added:

* creating a bundle (which can extends the installed one)
* creating some classes
* configuring the bundle
* importing its routes
