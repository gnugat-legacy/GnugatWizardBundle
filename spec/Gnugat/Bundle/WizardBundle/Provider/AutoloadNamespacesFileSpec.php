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
class AutoloadNamespacesFileSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldImplement('Gnugat\Bundle\WizardBundle\Provider\ComposerPackageProvider');
        $this->shouldHaveType('Gnugat\Bundle\WizardBundle\Provider\AutoloadNamespacesFile');
    }

    public function let(KernelInterface $kernel)
    {
        $kernel->getRootDir()->willReturn(__DIR__.'/../../../../../Resources/local/app');

        $this->beConstructedWith($kernel);
    }

    public function it_retrieves_package_from_psr1_file()
    {
        $name = 'acme/demo-bundle';
        $namespace = 'Acme\\Bundle\\DemoBundle';
        $package = $this->getPackage($name);

        $package->name->shouldBe($name);
        $package->namespace->shouldBe($namespace);
    }

    public function it_retrieves_package_from_psr4_file()
    {
        $name = 'monolog/monolog';
        $namespace = 'Monolog';
        $package = $this->getPackage($name);

        $package->name->shouldBe($name);
        $package->namespace->shouldBe($namespace);
    }
}
