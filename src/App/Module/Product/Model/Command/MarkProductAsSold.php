<?php

namespace App\Module\Product\Model\Command;

use App\Module\Product\Model\ProductId;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

class MarkProductAsSold extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function withData(ProductId $productId) : MarkProductAsSold
    {
        return new static([
            'product_id' => $productId
        ]);
    }

    public function productId()
    {
        return $this->payload['product_id'];
    }
}
