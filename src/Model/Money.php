<?php

namespace SnackMachine\Model;

use Assert\Assertion;
use SnackMachine\Model\Money\FiftyCents;
use SnackMachine\Model\Money\FiftyEuros;
use SnackMachine\Model\Money\FiveCents;
use SnackMachine\Model\Money\FiveEuros;
use SnackMachine\Model\Money\OneCent;
use SnackMachine\Model\Money\OneEuro;
use SnackMachine\Model\Money\TenCents;
use SnackMachine\Model\Money\TenEuros;
use SnackMachine\Model\Money\TwentyCents;
use SnackMachine\Model\Money\TwentyEuros;
use SnackMachine\Model\Money\TwoCents;
use SnackMachine\Model\Money\TwoEuros;
use SnackMachine\Model\Money\UnknownDenominationException;

class Money
{
    private $oneCentCount;
    private $twoCentsCount;
    private $fiveCentsCount;
    private $tenCentsCount;
    private $twentyCentsCount;
    private $fiftyCentsCount;
    private $oneEuroCount;
    private $twoEurosCount;
    private $fiveEurosCount;
    private $tenEurosCount;
    private $twentyEurosCount;
    private $fiftyEurosCount;
    private $total;

    private function __construct(
        int $oneCentCount,
        int $twoCentsCount,
        int $fiveCentsCount,
        int $tenCentsCount,
        int $twentyCentsCount,
        int $fiftyCentsCount,
        int $oneEuroCount,
        int $twoEurosCount,
        int $fiveEurosCount,
        int $tenEurosCount,
        int $twentyEurosCount,
        int $fiftyEurosCount
    ) {
        $this->oneCentCount     = $oneCentCount;
        $this->twoCentsCount    = $twoCentsCount;
        $this->fiveCentsCount   = $fiveCentsCount;
        $this->tenCentsCount    = $tenCentsCount;
        $this->twentyCentsCount = $twentyCentsCount;
        $this->fiftyCentsCount  = $fiftyCentsCount;
        $this->oneEuroCount     = $oneEuroCount;
        $this->twoEurosCount    = $twoEurosCount;
        $this->fiveEurosCount   = $fiveEurosCount;
        $this->tenEurosCount    = $tenEurosCount;
        $this->twentyEurosCount = $twentyEurosCount;
        $this->fiftyEurosCount  = $fiftyEurosCount;

        $this->total = \Money\Money::EUR(
            $this->oneCentCount * OneCent::value() +
            $this->twoCentsCount * TwoCents::value() +
            $this->fiveCentsCount * FiveCents::value() +
            $this->tenCentsCount * TenCents::value() +
            $this->twentyCentsCount * TwentyCents::value() +
            $this->fiftyCentsCount * FiftyCents::value() +
            $this->oneEuroCount * OneEuro::value() +
            $this->twoEurosCount * TwoEuros::value() +
            $this->fiveEurosCount * FiveEuros::value() +
            $this->tenEurosCount * TenEuros::value() +
            $this->twentyEurosCount * TwentyEuros::value() +
            $this->fiftyEurosCount * FiftyEuros::value()
        );
    }

    public static function create(\Money\Money ...$monies): self
    {
        Assertion::notEmpty($monies);

        $oneCents    = 0;
        $twoCents    = 0;
        $fiveCents   = 0;
        $tenCents    = 0;
        $twentyCents = 0;
        $fiftyCents  = 0;
        $oneEuros    = 0;
        $twoEuros    = 0;
        $fiveEuros   = 0;
        $tenEuros    = 0;
        $twentyEuros = 0;
        $fiftyEuros  = 0;

        foreach ($monies as $money) {
            switch ($money->getAmount()) {
                case OneCent::value():
                    $oneCents++;
                    break;
                case TwoCents::value():
                    $twoCents++;
                    break;
                case FiveCents::value():
                    $fiveCents++;
                    break;
                case TenCents::value():
                    $tenCents++;
                    break;
                case TwentyCents::value():
                    $twentyCents++;
                    break;
                case FiftyCents::value():
                    $fiftyCents++;
                    break;
                case OneEuro::value():
                    $oneEuros++;
                    break;
                case TwoEuros::value():
                    $twoEuros++;
                    break;
                case FiveEuros::value():
                    $fiveEuros++;
                    break;
                case TenEuros::value():
                    $tenEuros++;
                    break;
                case TwentyEuros::value():
                    $twentyEuros++;
                    break;
                case FiftyEuros::value():
                    $fiftyEuros++;
                    break;
                default:
                    throw new UnknownDenominationException($money->getAmount());
            }
        }

        return new self(
            $oneCents,
            $twoCents,
            $fiveCents,
            $tenCents,
            $twentyCents,
            $fiftyCents,
            $oneEuros,
            $twoEuros,
            $fiveEuros,
            $tenEuros,
            $twentyEuros,
            $fiftyEuros
        );
    }

    public function total(): \Money\Money
    {
        return $this->total;
    }
}
