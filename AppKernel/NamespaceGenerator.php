<?php

namespace SfFactory\BundleCommandBundle\AppKernel;

class NamespaceGenerator
{
    public function makeFromComposerPackageName($composerPackageName)
    {
        list($vendor, $bundle) = explode('/', $composerPackageName);

        $bundleParts = array_map('ucfirst', explode('-', $bundle));
        $bundleName = implode('', $bundleParts);

        $vendorParts = array_map('ucfirst', explode('-', $vendor));
        $vendorName = implode('', $vendorParts);

        return $vendorName.'\\'.$bundleName.'\\'.$vendorName.$bundleName;
    }
}
