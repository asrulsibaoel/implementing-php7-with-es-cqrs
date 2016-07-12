<?php

namespace App\Module\Product\Model\Exception;

class InvalidProductCategory extends \DomainException
{
    public static function withCategoryName(string $categoryName)
    {
        throw new static(sprintf(
            'Category %s is invalid',
            $categoryName
        ));
    }
}
