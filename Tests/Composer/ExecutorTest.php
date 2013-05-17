<?php

namespace Gnugat\CommandBundle\Tests\Composer;

use Gnugat\CommandBundle\Composer\Executor;

class ExecutorTest extends \PHPUnit_Framework_TestCase
{
    public function testExecution()
    {
        $message = 'Hello world!';

        $executor = new Executor();

        $this->assertSame($message, $executor->execute("echo '$message'"));
    }
}
