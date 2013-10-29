Feature:
    In order to install a bundle
    As a Symfony2 developer
    I need to enable it in the AppKernel

    Scenario: 1 - Can enable a bundle once, using its fully qualified classname
        Given a new bundle
        And its fully qualified classname
        When I run the enable command
        Then it should be added in the AppKernel file

    Scenario: 2 - Cannot enable a bundle twice, using its fully qualified classname
        Given an enabled bundle
        And its fully qualified classname
        When I run the enable command
        Then I should get an error message

    Scenario: 3 - Can enable a bundle once, using its composer package name
        Given a new bundle
        And its composer package name
        When I run the enable command
        Then it should be added in the AppKernel file

    Scenario: 4 - Cannot enable a bundle twice, using its composer package name
        Given an enabled bundle
        And its composer package name
        When I run the enable command
        Then I should get an error message
