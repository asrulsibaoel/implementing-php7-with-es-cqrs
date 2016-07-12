<?php
declare(strict_types=1);

namespace App\Module\Product\Model;

use Assert\Assertion;

class ProductStatus
{
    const SOLD = 'sold';
    const UNSOLD = 'unsold';
    const REMOVED = 'removed';

    private $status;

    private function __construct(string $status)
    {
        Assertion::inArray($status, [self::SOLD, self::UNSOLD]);
        $this->status = $status;
    }

    public static function sold() : ProductStatus
    {
        return new static(static::SOLD);
    }

    public static function unsold() : ProductStatus
    {
        return new static(static::UNSOLD);
    }

    public function isSold() : bool
    {
        return $this->status === self::SOLD;
    }

    public function isUnsold() : bool
    {
        return $this->status === self::UNSOLD;
    }

    public static function fromString(string $status) : ProductStatus
    {
        return new static($status);
    }

    public function toString() : string
    {
        return $this->status;
    }

    public function sameValueAs(ProductStatus $productStatus) : bool
    {
        return $this->toString() === $productStatus->toString();
    }
}
