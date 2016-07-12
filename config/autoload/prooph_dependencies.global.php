<?php

use Prooph\ServiceBus\Plugin\InvokeStrategy\OnEventStrategy;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\Common\Messaging\FQCNMessageFactory;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\Container\EventStoreFactory;
use Prooph\EventStore\Snapshot\SnapshotStore;
use Prooph\EventStore\Container\Snapshot\SnapshotStoreFactory;
use Prooph\ServiceBus\CommandBus;
use Prooph\ServiceBus\Container\CommandBusFactory;
use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Container\EventBusFactory;
use Prooph\ServiceBus\QueryBus;
use Prooph\ServiceBus\Container\QueryBusFactory;
use Prooph\EventStoreBusBridge\TransactionManager;
use Prooph\EventStoreBusBridge\Container\TransactionManagerFactory;
use Prooph\EventStoreBusBridge\EventPublisher;
use Prooph\EventStoreBusBridge\Container\EventPublisherFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'dependencies' => [
        'invokables' => [
            OnEventStrategy::class => OnEventStrategy::class,
            AggregateTranslator::class => AggregateTranslator::class
        ],
        'factories' => [
            FQCNMessageFactory::class => InvokableFactory::class,
            EventStore::class => EventStoreFactory::class,
            SnapshotStore::class => SnapshotStoreFactory::class,
            // service bus
            CommandBus::class => CommandBusFactory::class,
            EventBus::class => EventBusFactory::class,
            QueryBus::class => QueryBusFactory::class,
            // service bus event store bridge
            TransactionManager::class => TransactionManagerFactory::class,
            EventPublisher::class => EventPublisherFactory::class,
        ],
    ]
];
