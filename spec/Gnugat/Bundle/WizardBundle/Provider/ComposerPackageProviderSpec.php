<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Bundle\WizardBundle\Provider;

use PhpSpec\ObjectBehavior;

use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class ComposerPackageProviderSpec extends ObjectBehavior
{
    public function let(KernelInterface $kernel)
    {
        $kernel->getRootDir()->willReturn(__DIR__.'/../../../../../Resources/local/app');

        $this->beConstructedWith($kernel);
    }

    public function it_retrieves_name_and_namespace_from_autoload_namespaces_file()
    {
        $packages = $this->getPackages();

        $packages->shouldBeArray();
    }

    public function it_gets_package_name_from_paths()
    {
        $name = 'acme/demo-bundle';
        $path = __DIR__.'/../../../../../tests/vendor';

        $paths = array($path.'/'.$name);
        $this->getNameFromPaths($paths)->shouldBe($name);
    }
}
