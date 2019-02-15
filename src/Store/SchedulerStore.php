<?php

/**
 * Scheduler implementation
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Scheduler\Store;

use Amp\Promise;
use ServiceBus\Scheduler\Data\ScheduledOperation;
use ServiceBus\Scheduler\ScheduledOperationId;

/**
 *
 */
interface SchedulerStore
{
    /**
     * Extract operation (load and delete)
     *
     * @param ScheduledOperationId $id
     * @param callable             $postExtract
     *
     * @return Promise
     *
     * @throws \ServiceBus\Scheduler\Store\Exceptions\ScheduledOperationNotFound
     * @throws \ServiceBus\Storage\Common\Exceptions\ConnectionFailed
     * @throws \ServiceBus\Storage\Common\Exceptions\StorageInteractingFailed
     * @throws \ServiceBus\Storage\Common\Exceptions\InvalidConfigurationOptions
     */
    public function extract(ScheduledOperationId $id, callable $postExtract): Promise;

    /**
     * Remove operation
     *
     * @param ScheduledOperationId $id
     * @param callable             $postRemove
     *
     * @return Promise It doesn't return any result
     *
     * @throws \ServiceBus\Storage\Common\Exceptions\ConnectionFailed
     * @throws \ServiceBus\Storage\Common\Exceptions\StorageInteractingFailed
     * @throws \ServiceBus\Storage\Common\Exceptions\InvalidConfigurationOptions
     */
    public function remove(ScheduledOperationId $id, callable $postRemove): Promise;

    /**
     * Save a new operation
     *
     * @param ScheduledOperation $operation
     * @param callable           $postAdd
     *
     * @return Promise It doesn't return any result
     *
     * @throws \ServiceBus\Storage\Common\Exceptions\ConnectionFailed
     * @throws \ServiceBus\Storage\Common\Exceptions\StorageInteractingFailed
     * @throws \ServiceBus\Storage\Common\Exceptions\InvalidConfigurationOptions
     */
    public function add(ScheduledOperation $operation, callable $postAdd): Promise;
}