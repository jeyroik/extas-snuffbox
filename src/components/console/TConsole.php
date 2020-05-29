<?php
namespace extas\components\console;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Trait TConsole
 *
 * @package extas\components\console
 * @author jeyroik <jeyroik@gmail.com>
 */
trait TConsole
{
    /**
     * @param array $options
     * @return InputInterface
     */
    protected function getInput(array $options): InputInterface
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
     * @return OutputInterface
     */
    protected function getOutput(): OutputInterface
    {
        return new NullOutput();
    }
}
