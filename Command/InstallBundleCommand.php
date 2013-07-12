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
            ->setHelp(<<<EOT
The <info>bundle:install</info> command helps you to install existing bundles
by:
1. using the `composer.phar require <composer-package-name>`;
2. adding it to the `app/AppKernel.php` file;
3. setting its default configuration.
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $errorMessage = '';

        $composerPackageName = $input->getArgument('composer-package-name');

        // sensio/generator-bundle
        // Sensio\GeneratorBundle\SensioGeneratorBundle


        $this->getContainer()
            ->get('sf_factory_bundle_command_bundle.executor')
            ->execute('composer require '.$composerPackageName);

        try {
            $hasBeenAdded = $this->getContainer()
                ->get('sf_factory_bundle_command_bundle.kernel_manipulator')
                ->addBundle($namespace.'\\'.$bundle);

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
