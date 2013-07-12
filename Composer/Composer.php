<?php

namespace SfFactory\BundleCommandBundle\Composer;

/**
 * Manages PHP dependencies.
 *
 * @author Loic Chardonnet <loic.chardonnet@gmail.com>
 */
class Composer
{
    /**
     * @param Executor $executor The executor.
     */
    public function __construct(Executor $executor)
    {
        $this->executor = $executor;
    }

    /**
     * Adds the given package to the composer.json file and install it
     *
     * @param string $packageName The package name
     */
    public function install($packageName)
    {
        $this->executor->execute('composer.phar require '.$packageName);
    }
}
