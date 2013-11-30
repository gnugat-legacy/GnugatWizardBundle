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
 * Command to enable a bundle by adding its fully qualified classname in
 * AppKernel.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class RegisterPackageCommand extends ContainerAwareCommand
{
    public function __construct()
    {
        $commandName = 'wizard:register:package';
        parent::__construct($commandName);

        // @deprecated Deprecated in 1.1, to be removed in 2.0.
        $commandAlias = 'wizard:enable:package';
        $this->setAliases(array($commandAlias));

        $argumentName = 'name';
        $argumentMode = InputArgument::REQUIRED;
        $argumentDescription = 'The name of the composer package to enable';

        $this->addArgument($argumentName, $argumentMode, $argumentDescription);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $packageRepository = $this->getContainer()->get('gnugat_wizard.package.repository');
        $bundleFactory = $this->getContainer()->get('gnugat_wizard.bundle.factory');
        $kernelManipulator = $this->getContainer()->get('gnugat_wizard.kernel_manipulator');

        $packageName = $input->getArgument('name');

        $composerPackage = $packageRepository->findOneByName($packageName);
        $bundle = $bundleFactory->make($composerPackage->namespace);

        $kernelManipulator->addBundle($bundle->fullyQualifiedClassname);

        $output->writeln(sprintf('Just finished to register "%s"', $bundle->fullyQualifiedClassname));
    }
}
