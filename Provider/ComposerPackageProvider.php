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

use Gnugat\Bundle\WizardBundle\Model\ComposerPackage;

use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Provides a collection of ComposerPackage.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
interface ComposerPackageProvider
{
    /**
     * @return array
     */
    public function getPackages();
}
