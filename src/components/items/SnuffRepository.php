<?php
namespace extas\components\items;

use extas\components\repositories\Repository;

/**
 * Class SnuffRepository
 *
 * @package extas\components
 * @author jeyroik <jeyroik@gmail.com>
 */
class SnuffRepository extends Repository
{
    protected string $name = 'snuff_items';
    protected string $scope = 'extas';
    protected string $pk = 'id';
    protected string $itemClass = SnuffItem::class;

    public static array $addedItems = [];

    /**
     * @param $item
     * @return mixed
     */
    public function create($item)
    {
        self::$addedItems[] = $item;
        return parent::create($item);
    }
}
