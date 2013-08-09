<?php

namespace SfFactory\BundleCommandBundle\Tests\Mocks\Composer;

class Executor
{
    /**
     * Executes the given command.
     *
     * @param string $command The command that will be executed.
     *
     * @return string The last line from the result of the command.
     */
    public function execute($command)
    {
        return '';
    }
}
