<?php
namespace extas\components\repositories;

use extas\components\extensions\TSnuffExtensions;
use extas\components\items\SnuffRepository;
use extas\components\SystemContainer;
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
    protected function registerSnuffRepos(...$repos): void
    {
        SystemContainer::addItem('snuffRepository', SnuffRepository::class);

        foreach ($repos as $alias) {
            $this->snuffRepos[$alias] = SystemContainer::getItem($alias);
            if (method_exists($this->snuffRepos[$alias], 'drop')) {
                $this->snuffRepos[$alias]->drop();
            }
        }

        $this->addReposForExt($repos);
    }

    /**
     * @param string $alias
     * @param array $where
     * @return array
     * @throws \Exception
     */
    protected function allSnuffRepos(string $alias, array $where = []): array
    {
        if (isset($this->snuffRepos[$alias])) {
            return $this->snuffRepos[$alias]->all($where);
        }

        throw new \Exception('Missed repo with alias "' . $alias . '"');
    }

    /**
     * @param string $alias
     * @param array $where
     * @return mixed
     * @throws \Exception
     */
    protected function oneSnuffRepos(string $alias, array $where = [])
    {
        if (isset($this->snuffRepos[$alias])) {
            return $this->snuffRepos[$alias]->one($where);
        }

        throw new \Exception('Missed repo with alias "' . $alias . '"');
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
            if (method_exists($repo, 'drop')) {
                $repo->drop();
            }
        }

        $this->snuffRepos = [];
        $this->deleteSnuffExtensions();
    }
}
