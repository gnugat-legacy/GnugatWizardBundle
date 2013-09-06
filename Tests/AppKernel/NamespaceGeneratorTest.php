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

        $namespaceGenerator = new NamespaceGenerator("/var/www/dev/SfFactoryBundleCommandBundle/Tests/AppKernel/Fixtures/autoload_namespaces.php");
        foreach ($PackagesAndNamespaces as $composerPackageName => $namespace) {
            $this->assertSame(
                $namespace,
                $namespaceGenerator->makeFromComposerPackageName($composerPackageName)
            );
        }
    }
}
