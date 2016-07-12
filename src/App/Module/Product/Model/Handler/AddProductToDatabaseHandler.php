<?php
declare(strict_types=1);

namespace App\Module\Product\Model\Handler;

use App\Module\Product\Model\Command\AddProductToDatabase;
use App\Module\Product\Model\Product;
use App\Module\Product\Model\ProductCollection;

class AddProductToDatabaseHandler
{
    private $productCollection;

    public function __construct(ProductCollection $productCollection)
    {
        $this->productCollection = $productCollection;
    }

    public function __invoke(AddProductToDatabase $command)
    {
        $product = Product::addWithData(
            $command->productId(),
            $command->ownerId(),
            $command->productName(),
            $command->productDescription(),
            $command->productCategory(),
            $command->productFeatures(),
            $command->productImages(),
            $command->productPrice(),
            $command->productStatus()
        );

        $this->productCollection->add($product);
    }
}
