<?php
declare(strict_types=1);

namespace App\Module\Product\Model;

class ProductImage
{
    private $image;

    private function __construct(\SplFileInfo $image)
    {
        $this->image = $image;
    }

    public static function fromString($image) : ProductImage
    {
        return new static(new \SplFileInfo($image));
    }

    public function toString() : string
    {
        return $this->image->getPathname();
    }

    public function sameValueAs(ProductImage $image) : bool
    {
        return $this->toString() === $image->toString();
    }
}
