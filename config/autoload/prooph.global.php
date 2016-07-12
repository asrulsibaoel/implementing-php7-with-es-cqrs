<?php

use Prooph\Common\Messaging\FQCNMessageFactory;
use Prooph\EventStoreBusBridge\EventPublisher;
use Prooph\EventStoreBusBridge\TransactionManager;
use Prooph\ServiceBus\Plugin\InvokeStrategy\OnEventStrategy;

return [
    'prooph' => [
        'middleware' => [
            'query' => [
                'message_factory' => FQCNMessageFactory::class
            ],
            'command' => [
                'message_factory' => FQCNMessageFactory::class
            ],
            'event' => [
                'message_factory' => FQCNMessageFactory::class
            ],
        ],
        'event_store' => [
            'plugins' => [
                EventPublisher::class,
                TransactionManager::class,
            ],
        ],
        'service_bus' => [
            'event_bus' => [
                'plugins' => [
                    OnEventStrategy::class,
                ],
            ],
        ],
    ],
];
