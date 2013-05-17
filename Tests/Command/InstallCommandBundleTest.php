<?php

namespace Gnugat\CommandBundle\Tests\Command;

use  Gnugat\CommandBundle\Tests\Command\CommandTestCase;

class InstallBundleCommandTest extends CommandTestCase
{
    public function testDefaultCommand()
    {
        $this->commandTester->execute(array('command' => $this->command->getName()));
    }
}
