<?php

namespace SfFactory\BundleCommandBundle\Tests\Composer;

use SfFactory\BundleCommandBundle\Composer\Executor;

class ExecutorTest extends \PHPUnit_Framework_TestCase
{
    public function testExecution()
    {
        $message = 'Hello world!';

        $executor = new Executor();
        $this->assertSame($message."\n", $executor->execute("echo '$message'"));
    }
}
