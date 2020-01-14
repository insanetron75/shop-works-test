<?php
namespace App;

class Rota
{
    /**
     * @var array
     */
    private $shifts;

    public function __construct($shifts)
    {
        $this->shifts = $shifts;
    }

    public function getShifts()
    {
        return $this->shifts;
    }
}