<?php
/**
 * Created by PhpStorm.
 * User: cebeling
 * Date: 29/05/15
 * Time: 17:33
 */

namespace FactoryGirl\Tests\Provider\Doctrine\Fixtures;


use FactoryGirl\Provider\Doctrine\DateIntervalHelper;
use FactoryGirl\Provider\Doctrine\FieldDef;

class TimeTest extends TestCase
{
    public function testGetTimePast()
    {
        $time = new \DateTime();
        $interval = new \DateInterval('P3Y1M2D');
        $interval->invert = 1;
        $time->add($interval);
        $this->assertEquals(
            $time->getTimestamp(),
            FieldDef::past()->days(2)->months(1)->years(3)->get());
        $this->assertEquals(
            $time,
            FieldDef::past()->days(2)->months(1)->years(3)->get(DateIntervalHelper::DATE_TIME));
        $this->assertEquals(
            $time->format('d-m-y'),
            FieldDef::past()->days(2)->months(1)->years(3)->get(DateIntervalHelper::STRING));

    }

    public function testGetTimeFuture()
    {
        $time = new \DateTime();
        $interval = new \DateInterval('P3Y1M2D');
        $time->add($interval);
        $this->assertEquals(
            $time->getTimestamp(),
            FieldDef::future()->days(2)->months(1)->years(3)->get());
        $this->assertEquals(
            $time,
            FieldDef::future()->days(2)->months(1)->years(3)->get(DateIntervalHelper::DATE_TIME));
        $this->assertEquals(
            $time->format('d-m-y'),
            FieldDef::future()->days(2)->months(1)->years(3)->get(DateIntervalHelper::STRING));

    }


}