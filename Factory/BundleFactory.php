<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Bundle\WizardBundle\Factory;

use Gnugat\Bundle\WizardBundle\Model\Bundle;

/**
 * Makes a Bundle out of the given namespace.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class BundleFactory
{
    /**
     * @param string $namespace
     *
     * @return Bundle
     */
    public function make($namespace)
    {
        $unqualifiedNames = explode('\\', $namespace);
        $vendorName = array_shift($unqualifiedNames);
        $bundleName = array_pop($unqualifiedNames);

        $bundleClassname = $bundleName;
        if ('Symfony' !== $vendorName) {
            $bundleClassname = $vendorName.$bundleName;
        }

        $fullyQualifiedClassname = $namespace.'\\'.$bundleClassname;

        return new Bundle($fullyQualifiedClassname);
    }
}
