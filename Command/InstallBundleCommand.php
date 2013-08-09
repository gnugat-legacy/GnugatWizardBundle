<?php

namespace SfFactory\BundleCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Sensio\Bundle\GeneratorBundle\Manipulator\KernelManipulator;

/**
 * Installation of a bundle.
 *
 * @author Loic Chardonnet <loic.chardonnet@gmail.com>
 */
class InstallBundleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bundle:install')
            ->addArgument('composer-package-name', InputArgument::REQUIRED, 'The Composer package name')
            ->addArgument('version', InputArgument::REQUIRED, 'The version')
            ->setHelp(<<<EOT
The <info>bundle:install</info> command helps you to install existing bundles
by:
1. using the `composer.phar require <composer-package-name> <version>`;
2. adding it to the `app/AppKernel.php` file;
3. setting its default configuration.
EOT
        );
    }

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
