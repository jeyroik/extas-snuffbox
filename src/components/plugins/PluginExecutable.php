<?php
namespace extas\components\plugins;

/**
 * Class PluginExecutable
 *
 * PluginExecutable::addExecute(function () {...});
 *
 * @package extas\components\plugins
 * @author jeyroik <jeyroik@gmail.com>
 */
class PluginExecutable extends Plugin
{
    protected static array $executes = [];

    /**
     * @param $execute
     * @param bool $returnResult
     */
    public static function addExecute($execute, bool $returnResult = false)
    {
        self::$executes[] = [$execute, $returnResult];
    }

    /**
     * Reset executes
     */
    public static function reset(): void
    {
        self::$executes = [];
    }

    /**
     * @param mixed ...$args
     * @return mixed
     */
    public function __invoke(...$args)
    {
        foreach (self::$executes as list($execute, $returnResult)) {
            if ($returnResult) {
                $operated = false;
                $result = $execute($this, $operated, ...$args);

                if ($operated) {
                    return $result;
                }
            } else {
                $execute($this, ...$args);
            }
        }

        return null;
    }
}
