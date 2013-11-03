<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Bundle\WizardBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Enables a Symfony2 bundle by adding the given fully qualified namespace into
 * the application's AppKernel file.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class EnableBundleCommand extends ContainerAwareCommand
{
    public function __construct()
    {
        $commandName = 'wizard:enable:bundle';

        parent::__construct($commandName);

        $argumentName = 'fully-qualified-classname';
        $argumentMode = InputArgument::REQUIRED;
        $argumentDescription = 'The fully qualified classname of the bundle to enable';

        $this->addArgument($argumentName, $argumentMode, $argumentDescription);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $kernelManipulator = $this->getContainer()->get('gnugat_wizard.kernel_manipulator');

        $fullyQualifiedClassname = $input->getArgument('fully-qualified-classname');

        $kernelManipulator->addBundle($fullyQualifiedClassname);
    }
}
