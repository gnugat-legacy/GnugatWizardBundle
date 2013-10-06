<?php

namespace SfFactory\BundleCommandBundle\Tests\Command;

use SfFactory\BundleCommandBundle\Command\InstallBundleCommand;

use SfFactory\BundleCommandBundle\Tests\Mocks\AppKernel\Kernel;

class InstallBundleCommandTest extends CommandTestCase
{
    public function testDefaultCommand()
    {
        $packageName = 'author/package';

        $this->commandTester->execute(array(
            'command' => $this->command->getName(),
            'composer-package-name' => $packageName,
            'version' => '1.3.37',
        ));
    }

    public function testName()
    {
        $command = new InstallBundleCommand();

        $this->assertSame('sf-factory:bundle:install', $command->getName());
    }

    public function testArguments()
    {
        $command = new InstallBundleCommand();
        $definition = $command->getDefinition();

        $this->assertTrue($definition->hasArgument('composer-package-name'));
        $this->assertTrue($definition->hasArgument('version'));
    }

    public function testHelp()
    {
        $command = new InstallBundleCommand();

        $expectedHelp = file_get_contents(__DIR__.'/../../Resources/synopsis.txt');
        $this->assertSame($expectedHelp, $command->getHelp());
    }
}
