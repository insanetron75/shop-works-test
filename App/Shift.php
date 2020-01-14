<?php
namespace App;

use DateTimeImmutable;

class Shift
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var DateTimeImmutable
     */
    private $startTime;
    /**
     * @var DateTimeImmutable
     */
    private $endTime;

    /**
     * Shift constructor.
     *
     * @param int               $id
     * @param string            $name
     * @param DateTimeImmutable $startTime
     * @param DateTimeImmutable $endTime
     * @param string            $bonusTime
     */
    public function __construct($id, $name, DateTimeImmutable $startTime, DateTimeImmutable $endTime, $bonusTime = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->bonusTime = $bonusTime;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEndTime()
    {
        return $this->endTime;
    }
}