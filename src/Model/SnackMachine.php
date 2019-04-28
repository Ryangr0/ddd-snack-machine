<?php

namespace SnackMachine\Model;

use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use SnackMachine\Events\SnackMachineTurnedOn;
use SnackMachine\Model\SnackMachine\SnackMachineId;

final class SnackMachine extends AggregateRoot
{
    /** @var SnackMachineId */
    private $snackMachineId;

    public static function turnOn(SnackMachineId $snackMachineId)
    {
        $self = new self();

        $self->recordThat(
            SnackMachineTurnedOn::occur($snackMachineId->toString())
        );

        return $self;
    }

    protected function aggregateId(): string
    {
        return $this->snackMachineId->toString();
    }

    protected function apply(AggregateChanged $event): void
    {
        switch ($event->messageName()) {
            case SnackMachineTurnedOn::class:
                /** @var SnackMachineTurnedOn $event */

                $this->snackMachineId = $event->snackMachineId();
                break;
        }
    }
}
