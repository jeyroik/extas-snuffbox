<?php
namespace extas\components\plugins;

/**
 * Trait TSnuffPlugins
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
trait TSnuffPlugins
{
    /**
     * @param array $stages
     */
    protected function createPluginEmpty(array $stages): void
    {
        $this->createSnuffPlugin(PluginEmpty::class, $stages);
    }

    /**
     * @param array $stages
     */
    protected function createPluginException(array $stages): void
    {
        $this->createSnuffPlugin(PluginException::class, $stages);
    }

    /**
     * @param string $name
     * @param array $stages
     */
    protected function createSnuffPlugin(string $name, array $stages): void
    {
        $repo = new class extends PluginRepository {
            public function reload()
            {
                parent::$stagesWithPlugins = [];
            }
        };
        $repo->reload();
        foreach ($stages as $stage) {
            $repo->create(new Plugin([
                Plugin::FIELD__CLASS => $name,
                Plugin::FIELD__STAGE => $stage
            ]));
        }
    }

    /**
     * Delete all snuff plugins
     */
    protected function deleteSnuffPlugins(): void
    {
        (new PluginRepository())->delete([Plugin::FIELD__CLASS => [
            PluginEmpty::class,
            PluginException::class
        ]]);
    }
}
