<?php

namespace SfFactory\BundleCommandBundle\AppKernel;

use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @author Loic Chardonnet <loic.chardonnet@gmail.com>
 */
class NamespaceGenerator
{
    public $namespacesPath;

    public function __construct(KernelInterface $kernel)
    {
        $this->namespacesPath = $kernel->getRootDir().'/../vendor/composer/autoload_namespaces.php';
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
        $namespacesWithPackageNames = $this->getNamespacesWithPackageNames($arrayMaps, $composerPackageName);

        return $namespacesWithPackageNames[$composerPackageName];
    }

    /**
     * Return array with namespaces indexed by composer package name
     *
     * @param Array $arrayMaps
     *
     * @return Array $arrayNamespaces
     */
    private function getNamespacesWithPackageNames($arrayMaps, $packageNameNeeded)
    {
        $arrayNamespaces = array();
        foreach ($arrayMaps as $namespace => $paths) {
            $path = array_pop($paths);

            $explodedPath = explode('/', $path);
            $packageName = array_pop($explodedPath);
            $composerAuthorName = array_pop($explodedPath);
            $composerPackageName = $composerAuthorName.'/'.$packageName;

            $namespaceLength = strlen($namespace);
            if ('\\' !== $namespace[$namespaceLength - 1 ]) {
                $namespace .= '\\';
            }

            $explodedNamespace = explode('\\', $namespace);
            $namespaceAuthorName = array_shift($explodedNamespace);
            array_pop($explodedNamespace);
            $bundleName = array_pop($explodedNamespace);

            $authorNamespaceName =  $namespaceAuthorName . $bundleName;

            if ('Symfony' == $namespaceAuthorName) {
                $authorNamespaceName = $bundleName;
            }
            $arrayNamespaces[$composerPackageName] = $namespace . $authorNamespaceName;

            if ($packageNameNeeded == $composerPackageName) {
                break 1;
            }
        }

        return $arrayNamespaces;
    }
}
