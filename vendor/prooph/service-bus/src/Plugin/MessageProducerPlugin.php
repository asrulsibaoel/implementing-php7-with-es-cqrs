<?php
/*
 * This file is part of the prooph/service-bus.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 10/3/15 - 9:04 PM
 */
namespace Prooph\ServiceBus\Plugin;

use Prooph\Common\Event\ActionEvent;
use Prooph\Common\Event\ActionEventEmitter;
use Prooph\Common\Event\ActionEventListenerAggregate;
use Prooph\Common\Event\DetachAggregateHandlers;
use Prooph\ServiceBus\Async\MessageProducer;
use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\MessageBus;

/**
 * Class MessageProducerPlugin
 *
 * If the MessageProducerPlugin is attached to a message bus it routes all messages
 * to the Prooph\ServiceBus\Async\MessageProducer it is initialized with.
 *
 * @package Prooph\ServiceBus\Plugin
 */
final class MessageProducerPlugin implements ActionEventListenerAggregate
{
    use DetachAggregateHandlers;

    /**
     * @var MessageProducer
     */
    private $messageProducer;

    /**
     * @param MessageProducer $messageProducer
     */
    public function __construct(MessageProducer $messageProducer)
    {
        $this->messageProducer = $messageProducer;
    }

    /**
     * @param ActionEventEmitter $emitter
     */
    public function attach(ActionEventEmitter $emitter)
    {
        $this->trackHandler($emitter->attachListener(MessageBus::EVENT_INITIALIZE, [$this, 'onDispatchInitialize']));
    }

    /**
     * @param ActionEvent $event
     */
    public function onDispatchInitialize(ActionEvent $event)
    {
        $bus = $event->getTarget();

        if ($bus instanceof EventBus) {
            $listeners = $event->getParam(EventBus::EVENT_PARAM_EVENT_LISTENERS, []);
            $listeners[] = $this->messageProducer;
            $event->setParam(EventBus::EVENT_PARAM_EVENT_LISTENERS, $listeners);
        } else {
            $event->setParam(MessageBus::EVENT_PARAM_MESSAGE_HANDLER, $this->messageProducer);
        }
    }
}
