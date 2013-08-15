<?php

namespace SfFactory\BundleCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This command executes the following steps:
 *
 * 1. download the bundle
 * 2. add the bundle to app/AppKernel.php
 *
 * @author Loic Chardonnet <loic.chardonnet@gmail.com>
 */
class InstallBundleCommand extends ContainerAwareCommand
{
    /**
     * @{@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sf-factory:bundle:install')
            ->addArgument('composer-package-name', InputArgument::REQUIRED, 'The Composer package name')
            ->addArgument('version', InputArgument::REQUIRED, 'The version')
            ->setHelp(file_get_contents(__DIR__.'/../Resources/synopsis.txt'));
    }

    /**
     * @{@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $errorMessage = '';

        $composerPackageName = $input->getArgument('composer-package-name');

        $namespacedBundleClassname = $this->getContainer()
            ->get('sf_factory_bundle_command.namespace_generator')
            ->makeFromComposerPackageName($composerPackageName);


        $this->getContainer()
            ->get('sf_factory_bundle_command.executor')
            ->execute(sprintf(
                'composer require %s %s',
                $composerPackageName,
                $input->getArgument('version')
            ));

        try {
            $hasBeenAdded = $this->getContainer()
                ->get('sf_factory_bundle_command.kernel_manipulator')
                ->addBundle($namespacedBundleClassname);

            if (!$hasBeenAdded) {
                $errorMessage = 'Error: AppKernel or $bundles array not found';
            }
        } catch (\RuntimeException $e) {
            $errorMessage = 'Error: bundle already defined in AppKernel';
        }

        if (!empty($errorMessage)) {
            return array(
                $errorMessage,
                '',
            );
        }
    }
}
