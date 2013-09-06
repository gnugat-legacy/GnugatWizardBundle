<?php

// autoload_namespaces.php

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Symfony\\Component\\Yaml\\' => array($vendorDir . '/symfony/yaml'),
    'Symfony\\Component\\Translation\\' => array($vendorDir . '/symfony/translation'),
    'Symfony\\Component\\Templating\\' => array($vendorDir . '/symfony/templating'),
    'Symfony\\Component\\Stopwatch\\' => array($vendorDir . '/symfony/stopwatch'),
    'Symfony\\Component\\Routing\\' => array($vendorDir . '/symfony/routing'),
    'Symfony\\Component\\HttpKernel\\' => array($vendorDir . '/symfony/http-kernel'),
    'Symfony\\Component\\HttpFoundation\\' => array($vendorDir . '/symfony/http-foundation'),
    'Symfony\\Component\\Filesystem\\' => array($vendorDir . '/symfony/filesystem'),
    'Symfony\\Component\\EventDispatcher\\' => array($vendorDir . '/symfony/event-dispatcher'),
    'Symfony\\Component\\DependencyInjection\\' => array($vendorDir . '/symfony/dependency-injection'),
    'Symfony\\Component\\Debug\\' => array($vendorDir . '/symfony/debug'),
    'Symfony\\Component\\Console\\' => array($vendorDir . '/symfony/console'),
    'Symfony\\Component\\Config\\' => array($vendorDir . '/symfony/config'),
    'Symfony\\Bundle\\FrameworkBundle\\' => array($vendorDir . '/symfony/framework-bundle'),
    'SfFactory\\BundleCommandBundle' => array($baseDir . '/'),
    'Sensio\\Bundle\\GeneratorBundle' => array($vendorDir . '/sensio/generator-bundle'),
    'Psr\\Log\\' => array($vendorDir . '/psr/log'),
    'Doctrine\\Common' => array($vendorDir . '/doctrine/common/lib'),
    'Author\\Package\\AuthorPackage' => array($vendorDir . '/author/package'),
    'AuthorName\\PackageName\\AuthorNamePackageName' => array($vendorDir . '/author-name/package-name'),
    'Fp\OpenIdBundle\FpOpenIdBundle' => array($vendorDir . '/fp/openid-bundle'),
    'FOS\UserBundle\FOSUserBundle' => array($vendorDir . '/friendsofsymfony/user-bundle'),
    'Knp\Bundle\MenuBundle\KnpMenuBundle' => array($vendorDir . '/knplabs/knp-menu-bundle'),
);
