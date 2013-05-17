<?php

namespace Gnugat\GnugatCommandBundle\Tests\Command;

use  Gnugat\GnugatCommandBundle\Tests\Command\CommandTestCase;

class InstallBundleCommandTest extends CommandTestCase
{
    public function testDefaultCommand()
    {
        $this->commandTester->execute(array('command' => $this->command->getName()));
    }
}
