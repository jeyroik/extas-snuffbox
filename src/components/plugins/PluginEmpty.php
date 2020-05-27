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
    public static bool $worked = false;

    /**
     * @param mixed ...$args
     */
    public function __invoke(...$args)
    {
        self::$worked = true;
    }
}
