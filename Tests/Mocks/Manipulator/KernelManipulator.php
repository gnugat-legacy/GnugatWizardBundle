<?php

namespace SfFactory\BundleCommandBundle\Tests\Mocks\Manipulator;

use Sensio\Bundle\GeneratorBundle\Manipulator\Manipulator;
use Symfony\Component\HttpKernel\KernelInterface;

class KernelManipulator extends Manipulator
{
    protected $kernel;

    /**
     * @param KernelInterface $kernel A KernelInterface instance
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->reflected = new \ReflectionObject($kernel);
    }

    /**
     * @param string $bundle The bundle class name
     *
     * @return Boolean true if it worked, false otherwise
     */
    public function addBundle($bundle)
    {
        return true;
    }
}
