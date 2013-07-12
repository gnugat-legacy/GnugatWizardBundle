<?php

namespace SfFactory\BundleCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
        $input->getArgument('composer-package-name');
    }
}
