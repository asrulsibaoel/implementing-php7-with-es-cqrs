<?php
declare(strict_types=1);

namespace App\Module\Product\Model;

use Doctrine\Common\Collections\ArrayCollection;

class ImageList extends ArrayCollection
{
    public static function fromArray(array $imageList)
    {
        $imageList = array_map(function ($image) {
            return ProductImage::fromString($image);
        }, $imageList);

        return new static($imageList);
    }

    public function toArray()
    {
        return array_map(function (ProductImage $image) {
            return $image->toString();
        }, parent::toArray());
    }

    public function sameValueAs(ImageList $imageList)
    {
        return $this->toArray() === $imageList->toArray();
    }
}
