<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Bundle\WizardBundle\Repository;

use Gnugat\Bundle\WizardBundle\Model\ComposerPackage;
use Gnugat\Bundle\WizardBundle\Provider\ComposerPackageProvider;

use PhpSpec\ObjectBehavior;

/**
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class ComposerPackageRepositorySpec extends ObjectBehavior
{
    const PACKAGE_NAME = 'acme/demo-bundle';
    const PACKAGE_NAMESPACE = 'Acme\\Bundle\\DemoBundle';

    public function let(ComposerPackage $package, ComposerPackageProvider $provider)
    {
        $package->name = self::PACKAGE_NAME;
        $package->namespace = self::PACKAGE_NAMESPACE;

        $provider->getPackages()->willReturn(array(self::PACKAGE_NAME => $package));

        $this->beConstructedWith($provider);
    }

    public function it_finds_a_package_by_its_name()
    {
        $package = $this->findOneByName(self::PACKAGE_NAME);

        $package->shouldHaveType('Gnugat\Bundle\WizardBundle\Model\ComposerPackage');
        $package->name->shouldBe(self::PACKAGE_NAME);
        $package->namespace->shouldBe(self::PACKAGE_NAMESPACE);
    }
}
