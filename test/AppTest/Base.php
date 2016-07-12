<?php

namespace AppTest;

use Prooph\EventSourcing\AggregateRoot;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;

class Base extends \PHPUnit_Framework_TestCase
{
     private $aggregateTranslator;

    protected function popRecordedEvent(AggregateRoot $aggregateRoot)
    {
        return $this->getAggregateTranslator()->extractPendingStreamEvents($aggregateRoot);
    }

    private function getAggregateTranslator()
    {
        if ($this->aggregateTranslator === null) {
            $this->aggregateTranslator = new AggregateTranslator();
        }

        return $this->aggregateTranslator;
    }
}
