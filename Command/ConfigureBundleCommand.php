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

use Symfony\Component\Config\Definition\Dumper\YamlReferenceDumper;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\ArrayNode;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Configures a Symfony2 bundle by:
 * 1. getting its configuration definition
 * 2. extracting parameters which are: required, not nullable and without default value
 * 3. asking interractively the user a value for each parameters
 * 4. inserting the answer in the application's configuration
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class ConfigureBundleCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('wizard:configure:bundle');

        $argumentName = 'bundle-name';
        $argumentMode = InputArgument::REQUIRED;
        $argumentDescription = 'The fully qualified classname of the bundle to configure';

        $this->addArgument($argumentName, $argumentMode, $argumentDescription);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $bundleName = $input->getArgument('bundle-name');
        $containerBuilder = $this->getContainerBuilder();

        $bundles = $this->getContainer()->get('kernel')->getBundles();
        $extension = $bundles[$bundleName]->getContainerExtension();
        $configuration = $extension->getConfiguration(array(), $containerBuilder);
        $node = $configuration->getConfigTreeBuilder()->buildTree();

        $parameters = $this->getParameters($node);
        //var_dump($parameters);

        $output->writeln(sprintf('Just finished to configure "%s"', $bundleName));
    }

    public function getParameters($node)
    {
        if ('secret' === $node->getName()) {
            var_dump($node);
        }
        $parameters = array();
        $parameters[] = $node->getPath();

        if ($node instanceof ArrayNode) {
            foreach ($node->getChildren() as $childNode) {
                $childParameters = $this->getParameters($childNode);

                $parameters = array_merge($parameters, $childParameters);
            }
        }

        return $parameters;
    }

    /**
     * Loads the ContainerBuilder from the cache.
     *
     * @return ContainerBuilder
     *
     * @throws \LogicException
     */
    protected function getContainerBuilder()
    {
        if (!$this->getApplication()->getKernel()->isDebug()) {
            throw new \LogicException(sprintf('Debug information about the container is only available in debug mode.'));
        }

        if (!is_file($cachedFile = $this->getContainer()->getParameter('debug.container.dump'))) {
            throw new \LogicException(sprintf('Debug information about the container could not be found. Please clear the cache and try again.'));
        }

        $container = new ContainerBuilder();

        $loader = new XmlFileLoader($container, new FileLocator());
        $loader->load($cachedFile);

        return $container;
    }
}
