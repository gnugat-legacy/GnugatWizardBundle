<?php

namespace Gnugat\CommandBundle\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

use Gnugat\CommandBundle\Command\InstallCommandBundle;

class CommandTestCase extends \PHPUnit_Framework_TestCase
{
    protected $command;
    protected $commandTester;

    public function __construct()
    {
        $this->setCommand();
        $this->commandTester = new CommandTester($this->command);
    }

    protected function setCommand()
    {
        $mockedKernel = $this->getMock('Symfony\\Component\\HttpKernel\\Kernel', array(), array(), '', false);
        $application = new Application($mockedKernel);
        $application->add(new InstallCommandBundle());

        $this->command = $application->find('bundle:install');
    }
}
