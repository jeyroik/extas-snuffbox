<?php
namespace extas\components\plugins;

/**
 * Class PluginException
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginException extends Plugin
{
    /**
     * @param mixed ...$args
     * @throws \Exception
     */
    public function __invoke(...$args)
    {
        throw new \Exception('Expected exception', 500);
    }
}
