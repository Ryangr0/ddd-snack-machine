<?php

namespace SnackMachine\Tests\Model;

use Prooph\EventSourcing\AggregateChanged;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use SnackMachine\Events\SnackMachineTurnedOn;
use SnackMachine\Model\SnackMachine;
use SnackMachine\Model\SnackMachine\SnackMachineId;
use SnackMachine\Tests\AggregateTestCase;

class SnackMachineTest extends AggregateTestCase
{
    public function test_that_when_uuid_is_invalid_the_aggregate_throws_error()
    {
        $this->expectException(InvalidUuidStringException::class);

        $snackMachineId = $this->prophesize(SnackMachineId::class);
        $snackMachineId->toString()->willReturn('invalidUuid');

        SnackMachine::turnOn($snackMachineId->reveal());
    }

    public function test_that_when_the_uuid_is_valid_the_class_is_instantiable()
    {
        $snackMachineId = $this->prophesize(SnackMachineId::class);
        $snackMachineId->toString()->willReturn(Uuid::uuid4()->toString());

        $this->assertInstanceOf(
            SnackMachine::class,
            SnackMachine::turnOn($snackMachineId->reveal())
        );
    }

    public function test_turns_machine_on()
    {
        $snackMachineId = $this->prophesize(SnackMachineId::class);
        $snackMachineId->toString()->willReturn(Uuid::uuid4()->toString());

        $snackMachine = SnackMachine::turnOn($snackMachineId->reveal());

        /** @var AggregateChanged[] $events */
        $events = $this->popRecordedEvents($snackMachine);

        $this->assertCount(1, $events);

        /** @var \SnackMachine\Events\SnackMachineTurnedOn $event */
        $event = $events[0];

        $this->assertSame(SnackMachineTurnedOn::class, $event->messageName());
    }
}
