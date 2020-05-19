<?php
namespace extas\components\items;

use extas\interfaces\repositories\IRepository;

/**
 * Trait TSnuffItems
 *
 * @package extas\components\items
 * @author jeyroik <jeyroik@gmail.com>
 */
trait TSnuffItems
{
    /**
     * @param array $config
     * @return SnuffItem
     */
    public function createSnuffItem(array $config = [])
    {
        return new SnuffItem($config);
    }

    /**
     * @return IRepository
     */
    public function snuffRepository(): IRepository
    {
        return new SnuffRepository();
    }

    /**
     * @param array $where
     */
    public function deleteSnuffItems(array $where): void
    {
        $this->snuffRepository()->delete($where);
    }
}
