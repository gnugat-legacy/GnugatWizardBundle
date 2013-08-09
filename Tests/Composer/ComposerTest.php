<?php

namespace SfFactory\BundleCommandBundle\Tests\Composer;

use SfFactory\BundleCommandBundle\Composer\Composer;
use SfFactory\BundleCommandBundle\Composer\Executor;

class ComposerTest extends \PHPUnit_Framework_TestCase
{
    public function testRequire()
    {
        $packageName = 'author/package';

        $executor = $this->getMock('SfFactory\\BundleCommandBundle\\Composer\\Executor');
        $executor->expects($this->once())
            ->method('execute')
            ->with($this->equalTo('composer.phar require '.$packageName));

        $composer = new Composer($executor);
        $composer->install($packageName);
    }
}
