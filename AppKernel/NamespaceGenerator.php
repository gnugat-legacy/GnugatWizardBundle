<?php

namespace SfFactory\BundleCommandBundle\AppKernel;

/**
 * @author Loic Chardonnet <loic.chardonnet@gmail.com>
 */
class NamespaceGenerator
{
    /**
     * Generates a namespace from a composer package name.
     *
     * @param string $composerPackageName
     *
     * @return string
     */
    public function makeFromComposerPackageName($composerPackageName)
    {
        list($vendor, $bundle) = explode('/', $composerPackageName);

        $bundleParts = array_map('ucfirst', explode('-', $bundle));
        $bundleName = implode('', $bundleParts);

        $vendorParts = array_map('ucfirst', explode('-', $vendor));
        $vendorName = implode('', $vendorParts);

        return implode(NAMESPACE_SEPARATOR, array(
            $vendorName,
            $bundleName,
            $vendorName.$bundleName,
        ));
    }
}
