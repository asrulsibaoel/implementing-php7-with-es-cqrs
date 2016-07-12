<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Projection\Product;

use App\Module\Product\Model\Event\ProductWasAddedToDatabase;
use App\Projection\Product\ProductFinder;
use App\Projection\Table;
use Doctrine\DBAL\Connection;

/**
 * Description of ProductProjector
 *
 * @author asrulsibaoel
 */
class ProductProjector
{
    /**
     *
     * @var Connection
     */
    private $connection;
    
    /**
     *
     * @var ProductFinder
     */
    private $productFinder;
    
    /**
     * 
     * @param Connection $connection
     * @param ProductFinder $productFinder
     */
    public function __construct(Connection $connection, ProductFinder $productFinder)
    {
        $this->connection = $connection;
        $this->productFinder = $productFinder;
    }
    
    public function onProductWasAddedToDatabase(ProductWasAddedToDatabase $event)
    {
        $this->connection->insert(Table::PRODUCT,[
            'product_id' =>$event->productId()->toString(),
            'owner_id' => $event->ownerId()->toString(),
            'product_name' => $event->productName(),
            'product_description' => $event->productDescription(),
            'product_features' => $event->productFeatures(),
            'product_images' => $event->productImages(),
            'product_price' => $event->productPrice()->toString(),
            'product_status' => $event->productStatus()->toString()
        ]);
    }
}
