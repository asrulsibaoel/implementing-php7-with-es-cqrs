<?php
declare(strict_types=1);

namespace App\Module\Product\Model;

use Doctrine\Common\Collections\ArrayCollection;

class ProductFeatures extends ArrayCollection
{
    public static function fromArray(array $features) : ProductFeatures
    {
        return new static($features);
    }

    public function sameValueAs(ProductFeatures $features) : bool
    {
        return $this->toArray() === $features->toArray();
    }
}
