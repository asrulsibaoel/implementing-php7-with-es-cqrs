<?php
declare(strict_types=1);

namespace App\Module\Product\Model\Event;

use App\Module\Product\Model\ProductId;
use App\Module\Product\Model\ProductStatus;
use Prooph\EventSourcing\AggregateChanged;

final class ProductWasMarkedSold extends AggregateChanged
{
    private $productId;

    private $oldStatus;

    private $newStatus;

    public static function fromStatus(ProductId $productId, ProductStatus $oldStatus, ProductStatus $newStatus)
    {
        $event = static::occur($productId->toString(), [
            'old_status' => $oldStatus->toString(),
            'new_status' => $newStatus->toString()
        ]);

        $event->productId = $productId;
        $event->oldStatus = $oldStatus;
        $event->newStatus = $newStatus;

        return $event;
    }

    public function productId()
    {
        if (is_null($this->productId)) {
            $this->productId = ProductId::fromString($this->aggregateId());
        }

        return $this->productId;
    }

    public function oldStatus()
    {
        if (is_null($this->oldStatus)) {
            $this->oldStatus = ProductStatus::fromString($this->payload['old_status']);
        }

        return $this->oldStatus;
    }

    public function newStatus()
    {
        if (is_null($this->newStatus)) {
            $this->newStatus = ProductStatus::fromString($this->payload['new_status']);
        }

        return $this->newStatus;
    }
}
