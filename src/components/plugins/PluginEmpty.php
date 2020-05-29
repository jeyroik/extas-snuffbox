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
    public static int $worked = 0;

    /**
     * @param mixed ...$args
     */
    public function __invoke(...$args)
    {
        self::$worked++;
    }
}
