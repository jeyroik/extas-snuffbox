<?php
namespace extas\components\extensions;

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
        (new ExtensionRepository())->create(new Extension([
            Extension::FIELD__CLASS => ExtensionRepositoryGet::class,
            Extension::FIELD__INTERFACE => IExtensionRepositoryGet::class,
            Extension::FIELD__SUBJECT => '*',
            Extension::FIELD__METHODS => $repos
        ]));
    }

    /**
     * Delete ext repo
     */
    protected function deleteRepoExt(): void
    {
        (new ExtensionRepository())->delete([Extension::FIELD__CLASS => ExtensionRepositoryGet::class]);
    }
}
