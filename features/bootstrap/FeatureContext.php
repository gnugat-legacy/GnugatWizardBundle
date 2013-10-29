<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Behat\Behat\Context\ContextInterface;

use Symfony\Bundle\FrameworkBundle\Console\Application;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\StreamOutput;

/**
 * Step definitions used in acceptance tests.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class FeatureContext implements ContextInterface
{
    /**
     * @var string
     */
    private $appKernelPath;

    /**
     * @var string
     */
    private $bundleNameArgument;

    /**
     * @var string
     */
    private $formatOption;

    /**
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    private $input;

    /**
     * Initializes context. Every scenario gets it's own context object.
     *
     * @param array $parameters Suite parameters (directly coming from behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->appKernelPath = __DIR__.'/../../tests/app/AppKernel.php';
        if (file_exists($this->appKernelPath)) {
            unlink($this->appKernelPath);
        }
        copy($this->appKernelPath.'.skeleton', $this->appKernelPath);
        require_once $this->appKernelPath;
    }

    /**
     * @Given /^(an enabled|a new) bundle$/
     */
    public function setBundleNameArgument($bundleNameArgument)
    {
        $this->bundleNameArgument = $bundleNameArgument;
    }

    /**
     * @Given /^its (fully qualified classname|composer package name)$/
     */
    public function setFormatOption($formatOption)
    {
        $this->formatOption = $formatOption;
    }

    /**
     * @When I run the enable command
     */
    public function runCommand()
    {
        $this->makeInput();

        $this->output = new StreamOutput(fopen('php://memory', 'w', false));

        $kernel = new \AppKernel('test', true);
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $application->run($this->input, $this->output);
    }

    private function makeInput()
    {
        if ('fully qualified classname' === $this->formatOption) {
            $commandName = 'wizard:enable:bundle';
            $argumentName = 'fully-qualified-classname';
            if ('an enabled' === $this->bundleNameArgument) {
                $argument = 'Symfony\Bundle\FrameworkBundle\FrameworkBundle';
            }
            if ('a new' === $this->bundleNameArgument) {
                $argument = 'Acme\Bundle\DemoBundle\AcmeDemoBundle';
            }
        }
        if ('composer package name' === $this->formatOption) {
            $commandName = 'wizard:enable:package';
            $argumentName = 'name';
            if ('an enabled' === $this->bundleNameArgument) {
                $argument = 'symfony/framework-bundle';
            }
            if ('a new' === $this->bundleNameArgument) {
                $argument = 'acme/demo-bundle';
            }
        }

        $parameters = array(
            $commandName,
            $argumentName => $argument,
        );
        $definition = array(
            new InputArgument($argumentName),
        );

        $inputDefinition = new InputDefinition($definition);
        $this->input = new ArrayInput($parameters, $inputDefinition);

        PHPUnit_Framework_Assert::assertTrue($this->input->hasArgument($argumentName));
        PHPUnit_Framework_Assert::assertSame($parameters[$argumentName], $this->input->getArgument($argumentName));
    }

    /**
     * @Then it should be added in the AppKernel file
     */
    public function hasBeenAddedToAppKernel()
    {
        $appKernel = file_get_contents($this->appKernelPath);

        $namespace = 'Acme\Bundle\DemoBundle\AcmeDemoBundle';

        PHPUnit_Framework_Assert::assertNotSame(false, strpos($appKernel, $namespace));
    }

    /**
     * @Then I should get an error message
     */
    public function hasErrorMessage()
    {
        rewind($this->output->getStream());
        $display = stream_get_contents($this->output->getStream());

        $errorMessage = 'Bundle "Symfony\Bundle\FrameworkBundle\FrameworkBundle" is already defined in "AppKernel::registerBundles()".';

        PHPUnit_Framework_Assert::assertNotSame(false, strpos($display, $errorMessage));
    }
}
