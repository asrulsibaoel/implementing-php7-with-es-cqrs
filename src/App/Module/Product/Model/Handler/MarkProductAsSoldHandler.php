<?php

namespace App\Module\Product\Model\Handler;

use App\Module\Product\Model\Command\MarkProductAsSold;
use App\Module\Product\Model\Exception\ProductNotFound;
use App\Module\Product\Model\ProductCollection;

class MarkProductAsSoldHandler
{
    private $productCollection;

    public function __construct(ProductCollection $productCollection)
    {
        $this->productCollection = $productCollection;
    }

    public function __invoke(MarkProductAsSold $command)
    {
        $product = $this->productCollection->get($command->productId());

        if (! $product) {
            ProductNotFound::withProductId($command->productId());
        }

        $product->markAsSold();
    }
}
