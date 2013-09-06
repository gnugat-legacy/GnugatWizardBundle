<?php

namespace SfFactory\BundleCommandBundle\AppKernel;

use Symfony\Component\HttpKernel\Kernel;
/**
 * @author Loic Chardonnet <loic.chardonnet@gmail.com>
 */
class NamespaceGenerator
{
    public $namespacesPath;

    public function __construct($namespacesPath)
    {
        $this->namespacesPath = $namespacesPath;
    }
    /**
     * Generates a namespace from a composer package name.
     *
     * @param string $composerPackageName
     *
     * @return string
     */
    public function makeFromComposerPackageName($composerPackageName)
    {
        $arrayMaps = include($this->namespacesPath);
        $namespacesWithPackageNames = $this->getNamespacesWithPackageNames($arrayMaps);

        return $namespacesWithPackageNames[$composerPackageName];
    }

    /**
     * Return array with namespaces indexed by composer package name
     *
     * @param Array $arrayMaps
     *
     * @return Array $arrayNamespaces
     */
    private function getNamespacesWithPackageNames($arrayMaps)
    {
        $arrayNamespaces = array();
        foreach($arrayMaps as $namespace => $path){
            // package name is after the last '/' of path,  author name is before the last '/' of path
            $packageName = substr($path[0], strrpos($path[0], '/') +1);
            $pathWithoutPackageName = substr($path[0], 0, strrpos($path[0], '/'));
            $authorName = substr($pathWithoutPackageName, strrpos($pathWithoutPackageName, '/') +1);
            $composerPackageName = $authorName . '/' .$packageName;

            $arrayNamespaces[$composerPackageName] = $namespace;
        }

        return $arrayNamespaces;
    }
}
