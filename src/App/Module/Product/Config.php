<?php
declare(strict_types=1);

namespace App\Module\Product;

use App\Module\Product\Model\Command\AddProductToDatabase;
use App\Module\Product\Model\ProductCollection;
use App\Module\Product\Container\Infrastructure\Repository\EventStoreProductCollectionFactory;
use App\Module\Product\Model\Handler\AddProductToDatabaseHandler;
use App\Module\Product\Container\Model\Handler\AddProductToDatabaseHandlerFactory;
use App\Module\Product\Infrastructure\Repository\EventStoreProductCollection;
use App\Module\Product\Model\Product;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;

class Config
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'invokeables' => [

                ],
                'factories' => [
                    ProductCollection::class => EventStoreProductCollectionFactory::class,
                    AddProductToDatabaseHandler::class => AddProductToDatabaseHandlerFactory::class,
                ],
            ],
            'prooph' => [
                'event_store' => [
                    'product_collection' => [
                        'repository_class' => EventStoreProductCollection::class,
                        'aggregate_type' => Product::class,
                        'aggregate_translator' => AggregateTranslator::class,
                    ],
                ],
                'service_bus' => [
                    'command_bus' => [
                        'router' => [
                            'routes' => [
                                AddProductToDatabase::class => AddProductToDatabaseHandler::class,
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
