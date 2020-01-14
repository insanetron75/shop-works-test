<?php

namespace App;


use DateTime;

class BonusCalculator
{
    const MONDAY = 'Monday';
    const TUESDAY = 'Tuesday';
    const WEDNESDAY = 'Wednesday';
    const THURSDAY = 'Thursday';
    const FRIDAY = 'Friday';

    private $rota;

    /**
     * @var array
     */
    private $shifts = [];

    private $totalBonus;

    public function __construct(Rota $rota)
    {
        $this->rota = $rota;
        $this->formatShifts($rota);
        $this->totalBonus = $this->calculateTotalBonus();
    }

    private function formatShifts(Rota $rota)
    {
        $this->shifts = array_map(function (Shift $shift) {
            return [
                'id'         => $shift->getId(),
                'name'       => $shift->getName(),
                'day'        => $shift->getStartTime()->format('l'),
                'start_time' => $shift->getStartTime(),
                'end_time'   => $shift->getEndTime()
            ];
        }, $rota->getShifts());
    }

    private function calculateTotalBonus()
    {
        $bonus = 0;
        $bonus += $this->getBonusByDay(self::MONDAY);
        $bonus += $this->getBonusByDay(self::TUESDAY);
        $bonus += $this->getBonusByDay(self::WEDNESDAY);
        $bonus += $this->getBonusByDay(self::THURSDAY);
        $bonus += $this->getBonusByDay(self::FRIDAY);

        $bonusDTO = new DateTime();
        $bonusDTO->setTimestamp($bonus);
        return $bonusDTO;
    }

    private function getBonusByDay($day)
    {
        $dayShifts = [];
        foreach ($this->shifts as $shift) {
            if ($shift['day'] === $day) {
                $dayShifts[] = $shift;
            }
        }

        if (empty($dayShifts)) {
            return 0;
        };

        // If only one shift for the day return whole shift
        if (count($dayShifts) === 1) {
            $total = ($dayShifts[0]['end_time']->getTimestamp() - $dayShifts[0]['start_time']->getTimestamp());

            return $total;
        }

        // do any of the shifts overlap, if so get bonuses
        if ($this->overlapCheck($dayShifts[0], $dayShifts[1])) {
            return $this->getBonusHours($dayShifts[0], $dayShifts[1]);
        }

        // if no overlap no bonus
        return 0;
    }

    private function overlapCheck($shift1, $shift2)
    {
        $end1 = $shift1['end_time'];
        $start2 = $shift2['start_time'];

        if ($end1 < $start2) {
            return false;
        }

        return true;
    }

    private function getBonusHours($shift1, $shift2)
    {
        // check difference for bonus seconds
        $firstShiftBonusTime = $shift2['start_time']->getTimestamp() - $shift1['start_time']->getTimestamp();

        // check difference
        $secondShiftDifference = $shift2['end_time']->getTimestamp() - $shift1['end_time']->getTimestamp();


        return ($firstShiftBonusTime + $secondShiftDifference);
    }

    public function getTotalBonus()
    {
        return $this->totalBonus;
    }


}
