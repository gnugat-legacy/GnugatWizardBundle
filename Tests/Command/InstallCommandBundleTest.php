<?php

namespace Gnugat\CommandBundle\Tests\Command;

use Gnugat\CommandBundle\Tests\Command\CommandTestCase;

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
