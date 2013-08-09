<?php

namespace SfFactory\BundleCommandBundle\Tests\Mocks\Manipulator;

use Sensio\Bundle\GeneratorBundle\Manipulator\Manipulator;
use Symfony\Component\HttpKernel\KernelInterface;

class KernelManipulator extends Manipulator
{
    protected $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->reflected = new \ReflectionObject($kernel);
    }

    public function addBundle($bundle)
    {
        return true;
    }
}
