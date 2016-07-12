<?php
declare(strict_types=1);

namespace App\Module\Product\Model;

use App\Module\Product\Model\Event\ProductWasMarkedSold;
use App\Module\Product\Model\Exception\ProductAlreadySold;
use App\Module\User\Model\UserId;
use App\Module\Product\Model\Event\ProductWasAddedToDatabase;
use Prooph\EventSourcing\AggregateRoot;

class Product extends AggregateRoot
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

    public static function addWithData(
        ProductId $productId,
        UserId $ownerId,
        string $productName,
        string $productDescription,
        ProductCategory $productCategory,
        ProductFeatures $productFeatures,
        ImageList $productImages,
        ProductPrice $productPrice,
        ProductStatus $productStatus
    ) : Product {
        $self = new static();

        $self->recordThat(ProductWasAddedToDatabase::withData(
            $productId,
            $ownerId,
            $productName,
            $productDescription,
            $productCategory,
            $productFeatures,
            $productImages,
            $productPrice,
            $productStatus
        ));

        return $self;
    }

    public function markAsSold()
    {
        $status = ProductStatus::fromString(ProductStatus::SOLD);

        if ($this->productStatus->isSold()) {
            throw ProductAlreadySold::triedStatus($status, $this);
        }

        $this->recordThat(ProductWasMarkedSold::fromStatus($this->productId, $this->productStatus, $status));

    }

    public function whenProductWasMarkedSold(ProductWasMarkedSold $event)
    {
        $this->productStatus = $event->newStatus();
    }

    public function whenProductWasAddedToDatabase(ProductWasAddedToDatabase $event)
    {
        $this->productId = $event->productId();
        $this->ownerId = $event->ownerId();
        $this->productName = $event->productName();
        $this->productDescription = $event->productDescription();
        $this->productCategory = $event->productCategory();
        $this->productFeatures = $event->productFeatures();
        $this->productImages = $event->productImages();
        $this->productPrice = $event->productPrice();
        $this->productStatus = $event->productStatus();
    }

    public function aggregateId() : string
    {
        return $this->productId->toString();
    }

    public function productId() : ProductId
    {
        return $this->productId;
    }

    public function ownerId() : UserId
    {
        return $this->ownerId;
    }

    public function productName() : string
    {
        return $this->productName;
    }

    public function productDescription() : string
    {
        return $this->productDescription;
    }

    public function productFeatures() : ProductFeatures
    {
        return $this->productFeatures;
    }

    public function productImages() : ImageList
    {
        return $this->productImages;
    }

    public function productPrice() : ProductPrice
    {
        return $this->productPrice;
    }

    public function productStatus() : ProductStatus
    {
        return $this->productStatus;
    }
}
