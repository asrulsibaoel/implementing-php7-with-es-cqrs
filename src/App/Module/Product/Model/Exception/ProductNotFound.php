<?php

namespace App\Module\Product\Model\Exception;

use App\Module\Product\Model\ProductId;

class ProductNotFound extends \DomainException
{
    public static function withProductId(ProductId $productId)
    {
        throw new static(sprintf(
            'Product with id %s cannot be found',
            $productId->toString()
        ));
    }
}
