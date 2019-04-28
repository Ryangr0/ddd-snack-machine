<?php

namespace SnackMachine\Events;

use Prooph\EventSourcing\AggregateChanged;
use SnackMachine\Model\SnackMachine\SnackMachineId;

class SnackMachineTurnedOn extends AggregateChanged
{
    public function snackMachineId(): SnackMachineId
    {
        return SnackMachineId::fromString($this->aggregateId());
    }
}
