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
            'fp/openid-bundle' => 'Fp\OpenIdBundle\FpOpenIdBundle',
            'friendsofsymfony/user-bundle' => 'FOS\UserBundle\FOSUserBundle',
            'knplabs/knp-menu-bundle' => 'Knp\Bundle\MenuBundle\KnpMenuBundle',
        );

        $namespaceGenerator = new NamespaceGenerator(__DIR__."/Fixtures/autoload_namespaces.php");
        foreach ($PackagesAndNamespaces as $composerPackageName => $namespace) {
            $this->assertSame(
                $namespace,
                $namespaceGenerator->makeFromComposerPackageName($composerPackageName)
            );
        }
    }

    public function testSymfonyCase()
    {
        $namespaceGenerator = new NamespaceGenerator(__DIR__."/Fixtures/autoload_namespaces.php");

        $this->assertSame(
            'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
            $namespaceGenerator->makeFromComposerPackageName('symfony/framework-bundle')
        );
    }
}
