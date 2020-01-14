<?php


use App\BonusCalculator;
use App\Rota;
use App\Shift;
use PHPUnit\Framework\TestCase;

class BonusCalculatorTest extends TestCase
{
    const MONDAY = '2020-01-13';
    const TUESDAY = '2020-01-14';
    const WEDNESDAY = '2020-01-15';
    const THURSDAY = '2020-01-16';

    public function test_calculate_total_bonus()
    {
        $sut = new BonusCalculator($this->buildRota());

        $this->assertEquals('20', $sut->getTotalBonus()->format('H'));
    }

    public function buildRota()
    {
        return new Rota($this->buildShifts());
    }

    public function buildShifts()
    {
        $shifts[] = new Shift(
            1,
            'Black Widow',
            new DateTimeImmutable(self::MONDAY . '09:00'),
            new DateTimeImmutable(self::MONDAY . '17:00')
        );

        $shifts[] = new Shift(
            1,
            'Black Widow',
            new DateTimeImmutable(self::TUESDAY . '09:00'),
            new DateTimeImmutable(self::TUESDAY . '12:30')
        );

        $shifts[] = new Shift(
            1,
            'Thor',
            new DateTimeImmutable(self::TUESDAY . '12:30'),
            new DateTimeImmutable(self::TUESDAY . '17:00')
        );

        $shifts[] = new Shift(
            1,
            'Wolverine',
            new DateTimeImmutable(self::WEDNESDAY . '09:00'),
            new DateTimeImmutable(self::WEDNESDAY . '14:00')
        );

        $shifts[] = new Shift(
            1,
            'Gemora',
            new DateTimeImmutable(self::WEDNESDAY . '10:00'),
            new DateTimeImmutable(self::WEDNESDAY . '17:00')
        );

        // Additional Scenario
        $shifts[] = new Shift(
            1,
            'Wolverine',
            new DateTimeImmutable(self::WEDNESDAY . '09:00'),
            new DateTimeImmutable(self::WEDNESDAY . '17:00')
        );

        $shifts[] = new Shift(
            1,
            'Gemora',
            new DateTimeImmutable(self::WEDNESDAY . '09:00'),
            new DateTimeImmutable(self::WEDNESDAY . '17:00')
        );
        return $shifts;
    }
}