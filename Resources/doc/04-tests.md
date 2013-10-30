# Tests

To make sure this bundle works as expected, 3 kinds of tests are available:

1. manual tests, using a local console
2. acceptance tests, using [Behat](http://behat.org/)
3. specification tests, using [phpspec](http://www.phpspec.net/)

The `bin/tester.sh` script allows you to run acceptance and specification tests.

*Heads up*: you can choose the type of test to run with the script:

    sh bin/tester.sh [--specification|-s] [--acceptance|-a]

## Manual tests

No need to create an empty Symfony2 project and install the bundle in it to try
it, a "local application" is available. You can list this bundle commands using:

    php Resources/local/app/console list wizard

*Heads up*: at each run the application's kernel is re-initialized, to prevent
exceptions to be raised after trying the enable command.

## Acceptance tests

Each new feature is described in a User Story card which can be written in 4
lines:

1. the title of the user story (starts with `Feature:`)
2. the purpose to achieve (starts with `In order to`)
3. the role of the user (starts with `As a/an`)
4. the way it attains it (starts with `I need to`)

Those User Story cards can be found in `features`, and come
along with acceptance criteria which can be written with:

1. a title (starts with `Scenario:`)
2. one or more context steps (starts with `Given`)
3. one or more event steps (starts with `When`)
4. one or more outcome steps (starts with `Then`)

Acceptance tests translate those steps into code and are similar to functional
tests, except that instead of making sure that the system works, it checks if
the system actually fulfills business needs.

You can find them in the `features/bootstrap` directory.

## Specification tests

In order to ensure each class behaves in the expected way on a technical level,
this project uses specification tests which are located in the `spec` directory.
