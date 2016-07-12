<?php
declare(strict_types=1);

namespace App\Module\User\Container\Infrastructure\Repository;

use Prooph\EventStore\Container\Aggregate\AbstractAggregateRepositoryFactory;

final class EventStoreUserCollectionFactory extends AbstractAggregateRepositoryFactory
{
    public function containerId() : string
    {
        return 'user_collection';
    }
}
