<?php
namespace extas\components\extensions;

use extas\components\items\SnuffRepository;
use extas\components\SystemContainer;
use extas\interfaces\extensions\IExtensionRepositoryGet;

/**
 * Trait TExtensions
 *
 * @package extas\components\extensions
 * @author jeyroik@gmail.com
 */
trait TSnuffExtensions
{
    /**
     * @param array $repos
     */
    protected function createRepoExt(array $repos): void
    {
        $repos[] = 'snuffRepository';

        (new ExtensionRepository())->create(new Extension([
            Extension::FIELD__CLASS => ExtensionRepositoryGet::class,
            Extension::FIELD__INTERFACE => IExtensionRepositoryGet::class,
            Extension::FIELD__SUBJECT => '*',
            Extension::FIELD__METHODS => $repos
        ]));
    }

    /**
     * @param array $repos
     */
    protected function addReposForExt(array $repos): void
    {
        $repos['snuffRepository'] = SnuffRepository::class;
        
        foreach ($repos as $interface => $class) {
            SystemContainer::addItem($interface, $class);
        }
    }

    /**
     * Delete ext repo
     */
    protected function deleteSnuffExtensions(): void
    {
        (new ExtensionRepository())->delete([Extension::FIELD__CLASS => [
            ExtensionRepositoryGet::class
        ]]);
    }
}
