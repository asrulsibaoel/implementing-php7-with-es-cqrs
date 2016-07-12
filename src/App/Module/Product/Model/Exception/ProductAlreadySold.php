<?php
declare(strict_types=1);

namespace App\Module\Product\Model\Exception;

use App\Module\Product\Model\Product;
use App\Module\Product\Model\ProductStatus;

class ProductAlreadySold extends \DomainException
{
    public static function triedStatus(ProductStatus $status, Product $product) : ProductAlreadySold
    {
        return new static(sprintf(
            'Tried change status of Product %s to %s. But Product already sold',
            $product->productStatus()->toString(),
            $status->toString()
        ));
    }
}
