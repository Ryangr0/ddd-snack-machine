<?php

namespace SnackMachine\Tests\Model;

use SnackMachine\Model\Money;
use SnackMachine\Model\MoneyBuffer;
use SnackMachine\Tests\AggregateTestCase;

class MoneyBufferTest extends AggregateTestCase
{
    public function test_that_class_is_instantiable()
    {
        $money = $this->prophesize(Money::class);
        $this->assertInstanceOf(
            MoneyBuffer::class,
            MoneyBuffer::create($money->reveal())
        );
    }
}
