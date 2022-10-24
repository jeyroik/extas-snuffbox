<?php
namespace extas\components\extensions;

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

        $repo = SystemContainer::getItem('extensions');

        $repo->create(new Extension([
            Extension::FIELD__CLASS => ExtensionRepositoryGet::class,
            Extension::FIELD__INTERFACE => IExtensionRepositoryGet::class,
            Extension::FIELD__SUBJECT => '*',
            Extension::FIELD__METHODS => $repos
        ]));
    }

    /**
     * Delete ext repo
     */
    protected function deleteSnuffExtensions(): void
    {
        $repo = SystemContainer::getItem('extensions');
        $repo->drop();
    }
}
