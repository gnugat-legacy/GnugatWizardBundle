<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Bundle\WizardBundle\Provider;

use Composer\Package\PackageInterface;

use Gnugat\Bundle\WizardBundle\Model\ComposerPackage;

/**
 * Uses the Package object provided by a Composer event.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class ComposerEventPackage implements ComposerPackageProvider
{
    /**
     * @var PackageInterface
     */
    private $composerEventPackage;

    /**
     * @param PackageInterface $composerEventPackage
     */
    public function __construct(PackageInterface $composerEventPackage)
    {
        $this->composerEventPackage = $composerEventPackage;
    }

    /**
     * {@inheritdoc}
     */
    public function getPackage($name)
    {
        $packages = array();

        $autoload = $this->composerEventPackage->getAutoload();

        $autoloadNamespaces = array();
        if (isset($autoload['psr-0'])) {
            $autoloadNamespaces = array_merge($autoloadNamespaces, $autoload['psr-0']);
        }
        if (isset($autoload['psr-4'])) {
            $autoloadNamespaces = array_merge($autoloadNamespaces, $autoload['psr-4']);
        }

        foreach ($autoloadNamespaces as $namespace => $paths) {
            if ($paths && false !== strpos($paths[0], $name)) {
                $package = new ComposerPackage();
                $package->namespace = trim($namespace, '\\');
                $package->name = $name;

                return $package;
            }
        }

        throw new \Exception(sprintf('Package "%s" not installed', $name));
    }
}
