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
        foreach ($arrayMaps as $namespace => $paths) {
            $path = array_pop($paths);

            $explodedPath = explode('/', $path);
            $packageName = array_pop($explodedPath);
            $composerAuthorName = array_pop($explodedPath);
            $composerPackageName = $composerAuthorName.'/'.$packageName;

            $explodedNamespace = explode('\\', $namespace);
            $namespaceAuthorName = array_shift($explodedNamespace);

            $bundleName = array_pop($explodedNamespace);
            $bundleName = array_pop($explodedNamespace);


            $authorNamespaceName =  $namespaceAuthorName . $bundleName;

            if('Symfony' == $namespaceAuthorName){
                $authorNamespaceName = $bundleName;
            }
            $arrayNamespaces[$composerPackageName] = $namespace . $authorNamespaceName;
        }

        return $arrayNamespaces;
    }
}
