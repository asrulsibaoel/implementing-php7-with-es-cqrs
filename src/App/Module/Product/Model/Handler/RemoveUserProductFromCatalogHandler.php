<?php
declare(strict_types=1);

namespace App\Module\Product\Model\Handler;

use App\Module\Product\Model\ProductId;
use App\Module\Product\Model\ProductCollection;
use App\Module\Product\Model\Exception\ProductNotFound;

class RemoveUserProductFromCatalogHandler
{   
    private $productCollection;
    
    public function __construct(ProductCollection $productCollection)
    {
        $this->productCollection = $productCollection;    
    }
    
    public function __invoke(RemoveUserProductFromCatalog $command)
    {
        $product = $this->productCollection->get($command->productId());
        
        if (!$product) {
            ProductNotFound::withProductId($command->productId());
        }
        
        $product->markAsDeleted();
    }
}
