<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Bundle\WizardBundle\Factory;

use PhpSpec\ObjectBehavior;

/**
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class BundleFactorySpec extends ObjectBehavior
{
    public function it_makes_a_bundle_out_of_a_namespace()
    {
        $bundle = $this->make('Acme\Bundle\DemoBundle');

        $bundle->shouldBeAnInstanceOf('Gnugat\Bundle\WizardBundle\Model\Bundle');
        $bundle->fullyQualifiedClassname->shouldBe('Acme\Bundle\DemoBundle\AcmeDemoBundle');
    }
}
