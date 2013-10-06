<?php

namespace SfFactory\BundleCommandBundle\Tests\Mocks\AppKernel;

use Symfony\Component\HttpKernel\KernelInterface;

use Symfony\Component\HttpKernel\Kernel as BaseKernel;

use Symfony\Component\Config\Loader\LoaderInterface;

class Kernel extends BaseKernel
{
    public function __construct()
    {
    }

    public function getRootDir()
    {
        return __DIR__.'/../../AppKernel/Fixtures/vendor';
    }

    public function registerBundles()
    {
        return array();
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}
