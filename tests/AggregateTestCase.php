<?php

namespace SnackMachine\Tests;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\AggregateRoot;

abstract class AggregateTestCase extends TestCase
{
    /**
     * @var AggregateTranslator
     */
    private $aggregateTranslator;

    protected function popRecordedEvents(AggregateRoot $aggregateRoot): array
    {
        return $this->getAggregateTranslator()->extractPendingStreamEvents(
            $aggregateRoot
        );
    }

    /**
     * @return object
     */
    protected function reconstituteAggregateFromHistory(
        string $aggregateRootClass,
        array $events
    ) {
        return $this->getAggregateTranslator()
                    ->reconstituteAggregateFromHistory(
                        AggregateType::fromAggregateRootClass(
                            $aggregateRootClass
                        ),
                        new ArrayIterator($events)
                    );
    }

    private function getAggregateTranslator(): AggregateTranslator
    {
        if (null === $this->aggregateTranslator) {
            $this->aggregateTranslator = new AggregateTranslator();
        }

        return $this->aggregateTranslator;
    }
}
