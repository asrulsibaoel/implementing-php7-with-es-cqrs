<?php
declare(strict_types=1);

namespace App\Module\Product\Infrastructure\Repository;

use App\Module\Product\Model\Product;
use App\Module\Product\Model\ProductCollection;
use App\Module\Product\Model\ProductId;
use Prooph\EventStore\Aggregate\AggregateRepository;

class EventStoreProductCollection extends AggregateRepository implements ProductCollection
{
    public function add(Product $product)
    {
        $this->addAggregateRoot($product);
    }

    public function get(ProductId $productId)
    {
        return $this->getAggregateRoot($productId->toString());
    }
}
