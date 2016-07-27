<?php

namespace DevGroup\Measure\tests\unit;

use DevGroup\Measure\helpers\MeasureHelper;
use DevGroup\Measure\models\Measure;

class ConverterTest extends UnitTestCase
{
    public function testTemperature()
    {
        $from = \DevGroup\Measure\models\Measure::getByUnit('°C');
        $to = \DevGroup\Measure\models\Measure::getByUnit('°F');
        $this->assertSame((double) 212, (double) MeasureHelper::convert(100, $to, $from));
        $this->assertSame((double) 100, (double) MeasureHelper::convert(212, $from, $to));
        $to = \DevGroup\Measure\models\Measure::getByUnit('°K');
        $this->assertSame((double) 373.15, (double) MeasureHelper::convert(100, $to, $from));
        $this->assertSame((double) 0, (double) MeasureHelper::convert(273.15, $from, $to));
    }
}
