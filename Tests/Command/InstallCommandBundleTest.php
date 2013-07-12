<?php

namespace SfFactory\BundleCommandBundle\Tests\Command;

class InstallBundleCommandTest extends CommandTestCase
{
    public function testDefaultCommand()
    {
        $packageName = 'author/package';

        $this->commandTester->execute(array(
            'command' => $this->command->getName(),
            'composer-package-name' => $packageName,
        ));
    }
}
