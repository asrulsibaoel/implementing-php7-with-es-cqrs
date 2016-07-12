<?php
declare(strict_types=1);

namespace App\Module\Product\Model\Command;

use App\Module\Product\Model\ProductCategory;
use App\Module\User\Model\UserId;
use App\Module\Product\Model\ImageList;
use App\Module\Product\Model\ProductFeatures;
use App\Module\Product\Model\ProductId;
use App\Module\Product\Model\ProductPrice;
use App\Module\Product\Model\ProductStatus;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

class AddProductToDatabase extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function withData(
        string $productId,
        string $ownerId,
        string $productName,
        string $productDescription,
        string $productCategory,
        array $productFeatures,
        array $productImages,
        int $amount,
        string $currency
    ) : AddProductToDatabase {
        return new self([
            'product_id' => $productId,
            'owner_id' => $ownerId,
            'product_name' => $productName,
            'product_description' => $productDescription,
            'product_category' => $productCategory,
            'product_features' => $productFeatures,
            'product_images' => $productImages,
            'amount' => $amount,
            'currency' => $currency
        ]);
    }

    public function productId() : ProductId
    {
        return ProductId::fromString($this->payload['product_id']);
    }

    public function ownerId() : UserId
    {
        return UserId::fromString($this->payload['owner_id']);
    }

    public function productName() : string
    {
        return $this->payload['product_name'];
    }

    public function productDescription() : string
    {
        return $this->payload['product_description'];
    }

    public function productCategory() : ProductCategory
    {
        return ProductCategory::fromString($this->payload['product_category']);
    }

    public function productFeatures() : ProductFeatures
    {
        return ProductFeatures::fromArray($this->payload['product_features']);
    }

    public function productImages() : ImageList
    {
        return ImageList::fromArray($this->payload['product_images']);
    }

    public function productPrice() : ProductPrice
    {
        return ProductPrice::fromString(
            sprintf('%s %s', $this->payload['amount'], $this->payload['currency'])
        );
    }

    public function productStatus() : ProductStatus
    {
        return ProductStatus::unsold();
    }
}
