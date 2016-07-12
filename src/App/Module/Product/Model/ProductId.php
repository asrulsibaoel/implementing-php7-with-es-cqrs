<?php
declare(strict_types=1);

namespace App\Module\Product\Model;

use Rhumsaa\Uuid\Uuid;

class ProductId
{
    private $uuid;

    private function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function generate() : ProductId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $uuid) : ProductId
    {
        return new self(Uuid::fromString($uuid));
    }

    public function toString() : string
    {
        return $this->uuid->toString();
    }

    public function sameValueAs(ProductId $productId) : bool
    {
        return $this->uuid->toString() === $productId->toString();
    }
}
