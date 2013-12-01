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

use Gnugat\Bundle\WizardBundle\Model\Bundle;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Registers a Symfony2 bundle by adding the given fully qualified namespace
 * into the application's AppKernel file.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class RegisterBundleCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('wizard:register:bundle');

        // @deprecated Deprecated in 1.1, to be removed in 2.0.
        $commandAlias = 'wizard:enable:bundle';
        $this->setAliases(array($commandAlias));

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

        $this->validate($input);
        $kernelManipulator->addBundle($fullyQualifiedClassname);

        $output->writeln(sprintf('Just finished to register "%s"', $fullyQualifiedClassname));
    }

    /**
     * @param InputInterface $input
     *
     * @throws \InvalidArgumentException If the given namespace isn't valid
     */
    private function validate(InputInterface $input)
    {
        $validator = $this->getContainer()->get('validator');

        $fullyQualifiedClassname = $input->getArgument('fully-qualified-classname');
        $bundle = new Bundle($fullyQualifiedClassname);

        $errors = $validator->validate($bundle);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new \InvalidArgumentException($errorsString);
        }
    }
}
