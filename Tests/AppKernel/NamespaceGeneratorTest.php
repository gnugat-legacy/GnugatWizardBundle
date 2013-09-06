<?php

namespace SfFactory\BundleCommandBundle\Tests\AppKernel;

use SfFactory\BundleCommandBundle\AppKernel\NamespaceGenerator;

use SfFactory\BundleCommandBundle\Tests\Mocks\AppKernel\Kernel;

class NamespaceGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testMakeFromComposerPackageName()
    {
        $PackagesAndNamespaces = array(
            'author-name/package-name' =>'AuthorName\\PackageName\\AuthorNamePackageName',
            'author/package' =>'Author\\Package\\AuthorPackage',
            'fp/openid-bundle' => 'Fp\OpenIdBundle\FpOpenIdBundle',
            'friendsofsymfony/user-bundle' => 'FOS\UserBundle\FOSUserBundle',
            'knplabs/knp-menu-bundle' => 'Knp\Bundle\MenuBundle\KnpMenuBundle',
        );

        $namespaceGenerator = new NamespaceGenerator(new Kernel());
        foreach ($PackagesAndNamespaces as $composerPackageName => $namespace) {
            $this->assertSame(
                $namespace,
                $namespaceGenerator->makeFromComposerPackageName($composerPackageName)
            );
        }
    }

    public function testSymfonyCase()
    {
        $namespaceGenerator = new NamespaceGenerator(new Kernel());

        $this->assertSame(
            'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
            $namespaceGenerator->makeFromComposerPackageName('symfony/framework-bundle')
        );
    }
}
