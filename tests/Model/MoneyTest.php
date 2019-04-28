<?php

namespace SnackMachine\Tests\Model;

use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use SnackMachine\Model\Money;
use SnackMachine\Model\Money\UnknownDenominationException;

class MoneyTest extends TestCase
{
    public function test_that_money_cannot_be_empty()
    {
        $this->expectException(AssertionFailedException::class);
        Money::create();
    }

    public function test_that_money_throws_exception_when_weird_denomination_is_passed(
    )
    {
        $this->expectException(UnknownDenominationException::class);
        Money::create(\Money\Money::EUR(3));
    }

    public function test_that_when_valid_denominations_are_passed_the_class_is_instantiated(
    )
    {
        $this->assertInstanceOf(
            Money::class,
            Money::create(\Money\Money::EUR(1))
        );
    }

    public function test_that_count_of_denominations_is_correct()
    {
        $expectedAmount = \Money\Money::EUR(8888);
        $this->assertTrue(
            $expectedAmount->equals(Money::create(
                \Money\Money::EUR(1),
                \Money\Money::EUR(2),
                \Money\Money::EUR(5),
                \Money\Money::EUR(10),
                \Money\Money::EUR(20),
                \Money\Money::EUR(50),
                \Money\Money::EUR(100),
                \Money\Money::EUR(200),
                \Money\Money::EUR(500),
                \Money\Money::EUR(1000),
                \Money\Money::EUR(2000),
                \Money\Money::EUR(5000),
                )->total()),
        );
    }
}
