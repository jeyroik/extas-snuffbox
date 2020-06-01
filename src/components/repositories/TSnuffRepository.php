<?php
namespace extas\components\repositories;

use extas\components\extensions\TSnuffExtensions;
use extas\interfaces\IItem;
use extas\interfaces\repositories\IRepository;

/**
 * Trait TSnuffRepository
 *
 * @package extas\components\repositories
 * @author jeyroik <jeyroik@gmail.com>
 */
trait TSnuffRepository
{
    use TSnuffExtensions;

    /**
     * @var IRepository[]
     */
    protected array $snuffRepos = [];

    /**
     * @param array $repos
     */
    protected function registerSnuffRepos(array $repos): void
    {
        foreach ($repos as $alias => $class) {
            $alias = $alias ?: $class;
            $this->snuffRepos[$alias] = new $class();
            $this->snuffRepos[$alias]->drop();
        }

        $this->addReposForExt($repos);
    }

    /**
     * @param string $alias
     * @param IItem $item
     * @return IItem
     * @throws \Exception
     */
    protected function createWithSnuffRepo(string $alias, IItem $item): IItem
    {
        if (isset($this->snuffRepos[$alias])) {
            return $this->snuffRepos[$alias]->create($item);
        }

        throw new \Exception('Missed repo with alias "' . $alias . '"');
    }

    /**
     * Drop all repos
     */
    protected function unregisterSnuffRepos(): void
    {
        foreach ($this->snuffRepos as $repo) {
            $repo->drop();
        }

        $this->snuffRepos = [];
        $this->deleteSnuffExtensions();
    }
}
