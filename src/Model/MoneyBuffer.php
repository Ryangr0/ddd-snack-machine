<?php

namespace SnackMachine\Model;

final class MoneyBuffer
{
    private $money;

    private function __construct(Money $money)
    {
        $this->money = $money;
    }

    public static function create(Money $money): self
    {
        return new self($money);
    }
}
