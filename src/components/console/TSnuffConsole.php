<?php
namespace extas\components\console;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Trait TConsole
 *
 * @package extas\components\console
 * @author jeyroik <jeyroik@gmail.com>
 */
trait TSnuffConsole
{
    /**
     * @param array $options
     * @return InputInterface
     */
    protected function getInput(array $options = []): InputInterface
    {
        $args = [];
        $defs = [];

        foreach ($options as $name => $value) {
            $args['--' . $name] = $value;
            $defs[] = new InputOption($name);
        }

        return new ArrayInput($args, new InputDefinition($defs));
    }

    /**
     * @param bool $buffered
     * @return OutputInterface
     */
    protected function getOutput(bool $buffered = false): OutputInterface
    {
        return $buffered ? new BufferedOutput() : new NullOutput();
    }
}
