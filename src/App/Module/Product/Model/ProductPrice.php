<?php
declare(strict_types=1);

namespace App\Module\Product\Model;

use ValueObjects\Money\Money;

class ProductPrice
{
    private $price;

    private function __construct(Money $price)
    {
        $this->price = $price;
    }

    public static function fromString(string $price) : ProductPrice
    {
        list($amount, $currency) = explode(' ', $price);
        return new static(Money::fromNative($amount, $currency));
    }

    public function toString() : string
    {
        return sprintf(
            '%s %s',
            $this->price->getAmount(),
            $this->price->getCurrency()->getCode()->getName()
        );
    }

    public function sameValueAs(ProductPrice $price) : bool
    {
        return $this->toString() === $price->toString();
    }
}
