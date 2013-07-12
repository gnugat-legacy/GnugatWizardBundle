# VERSIONING

This file explains the versioning, branching and API model of this project.

## Versioning

The versioning is inspired by [Semantic Versioning](http://semver.org/):

* fixes or new tests will increase patch number (Z);
* new functionalities and options will increase minor number (Y);
* removal and modification of functionalities and options will increase major
  number (X).

## Branching Model

The branching model is inspired by the article
[A successful Git branching model](http://nvie.com/posts/a-successful-git-branching-model/):
* __master__ branch is the main stable one;
* __develop__ is the main unstable one;
* functionality branches come from __develop__;
* __release/*__ branches are between __develop__ and __master__;
* __refactoring/*__ branches come from __develop__.
