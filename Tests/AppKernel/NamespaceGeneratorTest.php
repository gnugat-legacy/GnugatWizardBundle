<?php

namespace SfFactory\BundleCommandBundle\Tests\AppKernel;

use SfFactory\BundleCommandBundle\AppKernel\NamespaceGenerator;

class NamespaceGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testMakeFromComposerPackageName()
    {
        $PackagesAndNamespaces = array(
            'author-name/package-name' =>'AuthorName\\PackageName\\AuthorNamePackageName',
            'author/package' =>'Author\\Package\\AuthorPackage',
        );

        $namespaceGenerator = new NamespaceGenerator();
        foreach ($PackagesAndNamespaces as $composerPackageName => $namespace) {
            $this->assertSame(
                $namespace,
                $namespaceGenerator->makeFromComposerPackageName($composerPackageName)
            );
        }
    }
}
