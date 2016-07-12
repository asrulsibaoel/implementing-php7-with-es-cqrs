<?php
declare(strict_types=1);

namespace App\Module\Product\Model;

use App\Module\Product\Model\Exception\InvalidProductCategory;

class ProductCategory
{
    const CATEGORY_LIST = [
        'Mobil', 'Motor', 'Properti', 'Fashion', 'Perhiasan', 'Hobi'
    ];

    private $categoryName;

    private function __construct(string $categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public static function fromString(string $categoryName)
    {
        if (! in_array($categoryName, static::CATEGORY_LIST)) {
            InvalidProductCategory::withCategoryName($categoryName);
        }

        return new static($categoryName);
    }

    public function toString() : string
    {
        return $this->categoryName;
    }

    public function sameValueAs(ProductCategory $productCategory)
    {
        return $this->categoryName === $productCategory->toString();
    }
}
