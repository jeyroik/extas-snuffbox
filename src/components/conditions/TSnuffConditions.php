<?php
namespace extas\components\conditions;

use extas\interfaces\conditions\ICondition;
use extas\interfaces\repositories\IRepository;

/**
 * Trait TSnuffConditions
 *
 * @package extas\components\conditions
 * @author jeyroik <jeyroik@gmail.com>
 */
trait TSnuffConditions
{
    protected array $available = [];

    /**
     * @param array $names
     */
    protected function createSnuffConditions(array $names): void
    {
        foreach ($names as $name) {
            $this->createSnuffCondition($name);
        }
    }

    /**
     * @param string $name
     */
    protected function createSnuffCondition(string $name): void
    {
        $available = $this->getAvailableConditions();
        $byName = array_column($available, null, ICondition::FIELD__NAME);

        if (isset($byName[$name])) {
            $this->getConditionRepository()->create(new Condition($byName[$name]));
        }
    }

    /**
     *
     */
    protected function deleteSnuffConditions(): void
    {
        $available = $this->getAvailableConditions();
        $this->getConditionRepository()->delete([
            ICondition::FIELD__NAME => array_column($available, ICondition::FIELD__NAME)
        ]);
    }

    /**
     * @return ConditionRepository
     */
    protected function getConditionRepository(): IRepository
    {
        return new ConditionRepository();
    }

    /**
     * @return array
     */
    protected function getAvailableConditions(): array
    {
        if (empty($this->available)) {
            $condExtasPath = getcwd() . '/vendor/jeyroik/extas-conditions/extas.json';
            if (is_file($condExtasPath)) {
                $condExtas = json_decode(file_get_contents($condExtasPath), true);
                return $this->available = $condExtas['conditions'] ?? [];
            }
        }

        return $this->available;
    }
}
