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
        $sut = new BonusCalculator($this->buildFullRota());
        $result = $sut->getTotalBonus();

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals('20', $result->format('H'));
    }

    public function test_scenario_one()
    {
        $sut = new BonusCalculator($this->buildScenarioOne());
        $result = $sut->getTotalBonus();

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals('08', $sut->getTotalBonus()->format('H'));
    }

    public function test_scenario_two()
    {
        $sut = new BonusCalculator($this->buildScenarioTwo());
        $result = $sut->getTotalBonus();

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals('08', $sut->getTotalBonus()->format('H'));
    }

    public function test_scenario_three()
    {
        $sut = new BonusCalculator($this->buildScenarioThree());
        $result = $sut->getTotalBonus();

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals('04', $sut->getTotalBonus()->format('H'));
    }

    public function test_additional_scenario()
    {
        $sut = new BonusCalculator($this->buildAdditionalScenario());
        $result = $sut->getTotalBonus();

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals('00', $sut->getTotalBonus()->format('H'));
    }

    public function buildFullRota()
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

        return new Rota($shifts);
    }

    public function buildScenarioOne(): Rota
    {
        return new Rota([
            new Shift(
                1,
                'Black Widow',
                new DateTimeImmutable(self::MONDAY . '09:00'),
                new DateTimeImmutable(self::MONDAY . '17:00')
            )
        ]);
    }

    public function buildScenarioTwo(): Rota
    {
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

        return new Rota($shifts);
    }

    public function buildScenarioThree(): Rota
    {
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

        return new Rota($shifts);
    }

    public function buildAdditionalScenario(): Rota
    {
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

        return new Rota($shifts);
    }


}