<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Bundle\WizardBundle\EventListener;

use Composer\Package\PackageInterface;
use Composer\Script\Event;

use Gnugat\Bundle\WizardBundle\DependencyInjection\Factory;

/**
 * Controller which:
 * - takes composer's events as input
 * - returns nothing as output
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class ComposerListener
{
    /**
     * On Composer's "post-package-install" event, register the package.
     *
     * @param Event $event
     */
    public static function postPackageInstall(Event $event)
    {
        $installedPackage = $event->getOperation()->getPackage();

        if (!self::isBundle($installedPackage)) {
            return;
        }

        self::enablePackage($installedPackage);
    }

    /**
     * Checks if the given package is a Symfony bundle.
     *
     * @param PackageInterface $package
     *
     * @return bool
     */
    public static function isBundle(PackageInterface $package)
    {
        return 'symfony-bundle' === $package->getType();
    }

    /**
     * @param string      $consoleInput
     * @param IOInterface $consoleOutput
     *
     * @throws \RuntimeException If an error occured during the running
     */
    public static function enablePackage(PackageInterface $package)
    {
        $packageRepository = Factory::makePackageRepository($package);
        $bundleFactory = Factory::makeBundleFactory();
        $kernelManipulator = Factory::makeKernelManipulator();

        $composerPackage = $packageRepository->findOneByName($package->getName());
        $bundle = $bundleFactory->make($composerPackage->namespace);

        $kernelManipulator->addBundle($bundle->fullyQualifiedClassname)
    }
}
