<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Bundle\WizardBundle\Command;

use PhpSpec\ObjectBehavior;

/**
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class RegisterPackageCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Gnugat\Bundle\WizardBundle\Command\RegisterPackageCommand');
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');

        $this->getName()->shouldBe('wizard:register:package');
        $this->getDefinition()->hasArgument('name')->shouldBe(true);
    }
}
