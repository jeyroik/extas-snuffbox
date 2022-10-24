<?php
namespace extas\components\items;

use extas\components\Item;
use extas\components\THasAliases;
use extas\components\THasClass;
use extas\components\THasDescription;
use extas\components\THasId;
use extas\components\THasName;
use extas\components\THasPriority;
use extas\components\THasType;
use extas\components\THasValue;

/**
 * Class SnuffItem
 *
 * @package extas\components
 * @author jeyroik <jeyroik@gmail.com>
 */
class SnuffItem extends Item
{
    use THasId;
    use THasName;
    use THasValue;
    use THasClass;
    use THasDescription;
    use THasType;
    use THasAliases;
    use THasPriority;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'snuff.item';
    }
}
