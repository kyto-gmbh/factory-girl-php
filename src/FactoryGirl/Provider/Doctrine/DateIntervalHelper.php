<?php
/**
 * Created by PhpStorm.
 * User: cebeling
 * Date: 29/05/15
 * Time: 11:35
 */

namespace FactoryGirl\Provider\Doctrine;


class DateIntervalHelper
{

    const DATE_TIME = 1;
    const TIMESTAMP = 2;
    const STRING = 3;

    public $negative;


    public function __construct(\DateTime $time, $negative = false)
    {
        $this->time = $time;
        $this->negative = $negative;
    }

    public function years($years)
    {
        if (!is_numeric($years)) {
            throw new \RuntimeException();
        }
        $interval = new \DateInterval('P'.$years.'Y');
        $interval->invert = (int) $this->negative;
        $this->time->add($interval);
        return $this;
    }

    public function months($months)
    {
        if (!is_numeric($months)) {
            throw new \RuntimeException();
        }

        $interval = new \DateInterval('P'.$months.'M');
        $interval->invert = (int) $this->negative;
        $this->time->add($interval);
        return $this;
    }

    public function days($days)
    {
        if (!is_numeric($days)) {
            throw new \RuntimeException();
        }

        $interval = new \DateInterval('P'.$days.'D');
        $interval->invert = (int) $this->negative;
        $this->time->add($interval);
        return $this;
    }

    public function get($format = self::TIMESTAMP)
    {
        if ($format == self::DATE_TIME) {
            return $this->time;
        } elseif ($format == self::TIMESTAMP) {
            return $this->time->getTimestamp();
        } elseif ($format == self::STRING) {
            return $this->time->format('d-m-y');
        } else {
            throw new \InvalidArgumentException("Unknown time format '". $format ."'");
        }
    }

}