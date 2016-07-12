<?php
declare(strict_types=1);

namespace App\Module\Product\Model;

interface ProductCollection
{
    public function add(Product $product);

    public function get(ProductId $productId);
}
