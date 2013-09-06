<?php

namespace SfFactory\BundleCommandBundle\Composer;

use Symfony\Component\Process\Process;

/**
 * Executes an external program.
 *
 * @author Loic Chardonnet <loic.chardonnet@gmail.com>
 */
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
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return $process->getOutput();
    }
}
