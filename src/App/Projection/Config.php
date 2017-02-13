<?php
declare(strict_types = 1);

namespace App\Projection;

use App\Projection\Product\Container\ProductFinderFactory;
use App\Projection\Product\Container\ProductProjectorFactory;
use App\Projection\Product\ProductFinder;
use App\Projection\Product\ProductProjector;
use App\Projection\User\Container\UserFinderFactory;
use App\Projection\User\Container\UserProjectorFactory;
use App\Projection\User\UserFinder;
use App\Projection\User\UserProjector;
use Prooph\ServiceBus\Plugin\InvokeStrategy\OnEventStrategy;
use App\Module\Product\Model\Event\ProductWasAddedToDatabase;
use App\Module\User\Model\Event\UserWasRegistered;

class Config
{

    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    UserFinder::class => UserFinderFactory::class,
                    UserProjector::class => UserProjectorFactory::class,
                    ProductProjector::class => ProductProjectorFactory::class,
                    ProductFinder::class => ProductFinderFactory::class
                ],
            ],
            'prooph' => [
                'service_bus' => [
                    'event_bus' => [
                        'router' => [
                            'routes' => [
                                UserWasRegistered::class => [
                                    UserProjector::class,
                                ],
                                ProductWasAddedToDatabase::class => [
                                    ProductProjector::class,
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }

}
