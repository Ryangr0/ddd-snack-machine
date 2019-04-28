<?php

namespace SnackMachine\Model\SnackMachine;

use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

class SnackMachineId
{
    /** @var string */
    private $aggregateId;

    public function __construct(string $aggregateId)
    {
        if (!Uuid::isValid($aggregateId)) {
            throw new InvalidUuidStringException($aggregateId);
        }
        $this->aggregateId = $aggregateId;
    }

    public static function fromString(string $aggregateId): self
    {
        return new self($aggregateId);
    }

    public function toString()
    {
        return $this->aggregateId;
    }
}
