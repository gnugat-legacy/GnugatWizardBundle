<?php

namespace SfFactory\BundleCommandBundle\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use SfFactory\BundleCommandBundle\Command\InstallBundleCommand;

use SfFactory\BundleCommandBundle\Tests\Mocks\AppKernel\Kernel;

use PHPUnit_Framework_TestCase;

abstract class CommandTestCase extends PHPUnit_Framework_TestCase
{
    protected $command;
    protected $commandTester;

    public function __construct()
    {
        $application = $this->makeApplication();
        $container = $this->makeContainer($application->getKernel());
        $this->setCommand($application, $container);
        $this->commandTester = new CommandTester($this->command);
    }

    protected function makeApplication()
    {
        $mockedKernel = $this->getMock('Symfony\\Component\\HttpKernel\\Kernel', array(), array(), '', false);
        $application = new Application($mockedKernel);

        return $application;
    }

    protected function makeContainer($kernel)
    {
        $container = new ContainerBuilder();

        $container->register(
            'sf_factory_bundle_command.executor',
            'SfFactory\\BundleCommandBundle\\Tests\\Mocks\\Composer\\Executor'
        );

        $container->register(
            'sf_factory_bundle_command.kernel_manipulator',
            'SfFactory\\BundleCommandBundle\\Tests\\Mocks\\Manipulator\\KernelManipulator'
        )
            ->addArgument($kernel)
        ;

        $container->register(
            'sf_factory_bundle_command.namespace_generator',
            'SfFactory\\BundleCommandBundle\\AppKernel\\NamespaceGenerator'
        )
            ->addArgument(new Kernel())
        ;

        return $container;
    }

    protected function setCommand($application, $container)
    {
        $command = new InstallBundleCommand();
        $command->setContainer($container);
        $application->add($command);

        $this->command = $application->find('sf-factory:bundle:install');
    }
}
