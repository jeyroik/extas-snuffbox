<?php
namespace extas\components\plugins;

/**
 * Class PluginEmpty
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginEmpty extends Plugin
{
    /**
     * @param mixed ...$args
     */
    public function __invoke(...$args)
    {
    }
}
