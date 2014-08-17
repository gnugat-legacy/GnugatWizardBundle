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
    const PACKAGE_NAME_PSR1 = 'acme/demo-bundle';
    const PACKAGE_NAMESPACE_PSR1 = 'Acme\Bundle\AcmeDemo';

    const PACKAGE_NAME_PSR4 = 'monolog/monolog';
    const PACKAGE_NAMESPACE_PSR4 = 'Monolog';

    public function it_is_initializable()
    {
        $this->shouldImplement('Gnugat\Bundle\WizardBundle\Provider\ComposerPackageProvider');
        $this->shouldHaveType('Gnugat\Bundle\WizardBundle\Provider\ComposerEventPackage');
    }

    public function let(PackageInterface $package)
    {
        $autoloadNamespaces = array(
            'psr-0' => array(
                self::PACKAGE_NAMESPACE_PSR1 => array(self::PACKAGE_NAME_PSR1),
            ),
            'psr-4' => array(
                self::PACKAGE_NAMESPACE_PSR4 => array(self::PACKAGE_NAME_PSR4),
            ),
        );
        $package->getAutoload()->willReturn($autoloadNamespaces);

        $this->beConstructedWith($package);
    }

    public function it_retrieves_package_from_psr1_autoload()
    {
        $package = $this->getPackage(self::PACKAGE_NAME_PSR1);

        $package->name->shouldBe(self::PACKAGE_NAME_PSR1);
        $package->namespace->shouldBe(self::PACKAGE_NAMESPACE_PSR1);
    }

    public function it_retrieves_package_from_psr4_autoload()
    {
        $package = $this->getPackage(self::PACKAGE_NAME_PSR4);

        $package->name->shouldBe(self::PACKAGE_NAME_PSR4);
        $package->namespace->shouldBe(self::PACKAGE_NAMESPACE_PSR4);
    }
}
