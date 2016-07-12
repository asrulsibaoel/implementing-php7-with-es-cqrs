<?php
declare(strict_types=1);

namespace App\Module\Product\Model\Event;

use App\Module\Product\Model\ProductCategory;
use App\Module\User\Model\UserId;
use App\Module\Product\Model\ImageList;
use App\Module\Product\Model\ProductFeatures;
use App\Module\Product\Model\ProductId;
use App\Module\Product\Model\ProductPrice;
use App\Module\Product\Model\ProductStatus;
use Prooph\EventSourcing\AggregateChanged;

final class ProductWasAddedToDatabase extends AggregateChanged
{
    private $productId;

    private $ownerId;

    private $productName;

    private $productDescription;

    private $productCategory;

    private $productFeatures;

    private $productImages;

    private $productPrice;

    private $productStatus;

    public static function withData(
        ProductId $productId,
        UserId $ownerId,
        string $productName,
        string $productDescription,
        ProductCategory $productCategory,
        ProductFeatures $productFeatures,
        ImageList $productImages,
        ProductPrice $productPrice,
        ProductStatus $productStatus
    ) : ProductWasAddedToDatabase {
        $event = static::occur($productId->toString(), [
            'owner_id' => $ownerId->toString(),
            'product_name' => $productName,
            'product_description' => $productDescription,
            'product_category' => $productCategory->toString(),
            'product_features' => $productFeatures->toArray(),
            'product_images' => $productImages->toArray(),
            'product_price' => $productPrice->toString(),
            'product_status' => $productStatus->toString()
        ]);

        $event->productId = $productId;
        $event->ownerId = $ownerId;
        $event->productName = $productName;
        $event->productDescription = $productDescription;
        $event->productCategory = $productCategory;
        $event->productFeatures = $productFeatures;
        $event->productImages = $productImages;
        $event->productPrice = $productPrice;
        $event->productStatus = $productStatus;

        return $event;
    }

    public function productId() : ProductId
    {
        if (is_null($this->productId)) {
            $this->productId = ProductId::fromString($this->aggregateId());
        }

        return $this->productId;
    }

    public function ownerId() : UserId
    {
        if (is_null($this->ownerId)) {
            $this->ownerId = UserId::fromString($this->payload['owner_id']);
        }

        return $this->ownerId;
    }

    public function productName() : string
    {
        if (is_null($this->productName)) {
            $this->productName = $this->payload['product_name'];
        }

        return $this->productName;
    }

    public function productDescription() : string
    {
        if (is_null($this->productDescription)) {
            $this->productDescription = $this->payload['product_description'];
        }

        return $this->productDescription;
    }

    public function productCategory() : ProductCategory
    {
        if (is_null($this->productCategory)) {
            $this->productCategory = ProductCategory::fromString($this->payload['product_category']);
        }

        return $this->productCategory;
    }

    public function productFeatures() : ProductFeatures
    {
        if (is_null($this->productFeatures)) {
            $this->productFeatures = ProductFeatures::fromArray($this->payload['product_features']);
        }

        return $this->productFeatures;
    }

    public function productImages() : ImageList
    {
        if (is_null($this->productImages)) {
            $this->productImages = ImageList::fromArray($this->payload['product_images']);
        }
        return $this->productImages;
    }

    public function productPrice() : ProductPrice
    {
        if (is_null($this->productPrice)) {
            $this->productPrice = ProductPrice::fromString($this->payload['product_price']);
        }
        return $this->productPrice;
    }

    public function productStatus() : ProductStatus
    {
        if (is_null($this->productStatus)) {
            $this->productStatus = ProductStatus::fromString($this->payload['product_status']);
        }

        return $this->productStatus;
    }
}
