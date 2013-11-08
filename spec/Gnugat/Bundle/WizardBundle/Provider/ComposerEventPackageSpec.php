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

use Composer\Package\PackageInterface;

/**
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class ComposerEventPackageSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldImplement('Gnugat\Bundle\WizardBundle\Provider\ComposerPackageProvider');
        $this->shouldHaveType('Gnugat\Bundle\WizardBundle\Provider\ComposerEventPackage');
    }

    public function let(PackageInterface $package)
    {
        $autoloadNamespaces = array(
            'psr-0' => array(
                'Acme\Bundle\AcmeDemo' => '',
            ),
        );
        $package->getAutoload()->willReturn($autoloadNamespaces);
        $package->getName()->willReturn('acme/demo-bundle');

        $this->beConstructedWith($package);
    }

    public function it_retrieves_name_and_namespace_from_composer_event_package()
    {
        $packages = $this->getPackages();

        $packages->shouldBeArray();
    }
}
