<?php
declare(strict_types=1);

namespace App\Module\Product\Container\Infrastructure\Repository;

use Prooph\EventStore\Container\Aggregate\AbstractAggregateRepositoryFactory;

class EventStoreProductCollectionFactory extends AbstractAggregateRepositoryFactory
{
    public function containerId() : string
    {
        return 'product_collection';
    }
}
