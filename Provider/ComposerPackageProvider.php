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

/**
 * Provides a collection of ComposerPackage.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
interface ComposerPackageProvider
{
    /**
     * @param $name
     *
     * @return array
     *
     * @throws \Exception If the package isn't installed
     */
    public function getPackage($name);
}
