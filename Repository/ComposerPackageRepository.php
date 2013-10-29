<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Bundle\WizardBundle\Repository;

use Gnugat\Bundle\WizardBundle\Provider\ComposerPackageProvider;

/**
 * Collection of installed composer packages.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class ComposerPackageRepository
{
    /**
     * @var ComposerPackagesProvider
     */
    private $provider;

    /**
     * @param ComposerPackagesProvider $provider
     */
    public function __construct(ComposerPackageProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param string $name
     *
     * @return ComposerPackage
     */
    public function findOneByName($name)
    {
        $packages = $this->provider->getPackages();

        return $packages[$name];
    }
}
