<?php

namespace DevGroup\Measure\tests\unit;

use DevGroup\Measure\helpers\MeasureHelper;
use DevGroup\Measure\models\Measure;

class MeasureHelperTest extends UnitTestCase
{
    public function testConvert()
    {
        // Length
        $from = Measure::findOne(['unit' => 'mi']);
        $to = Measure::findOne(['unit' => 'km']);
        $this->assertEquals(2*1609.344/1000, MeasureHelper::convert(2, $to, $from));
        // Weight
        $from = Measure::findOne(['unit' => 'lb']);
        $to = Measure::findOne(['unit' => 'kg']);
        $this->assertEquals(300*0.45359237, MeasureHelper::convert(300, $to, $from));
        // Same measure
        $this->assertEquals(300, MeasureHelper::convert(300, $to, $to));
        // that's all
    }

    /**
     * @expectedException \yii\base\Exception
     * @expectedExceptionMessage One or more measures is null
     */
    public function testConvertException()
    {
        MeasureHelper::convert(123, null, null);
    }

    public function testFormat()
    {
        // without converting
        $to = Measure::findOne(['unit' => 'kg']);
        $this->assertSame('2,500.5 кг', MeasureHelper::format(2500.5, $to));
        // with converting
        $from = Measure::findOne(['unit' => 'g']);
        $this->assertSame('2.5 кг', MeasureHelper::format(2500, $to, $from));
        // custom formatter
        $to->use_custom_formatter = true;
        $to->decimal_separator = ',';
        $this->assertSame('2 500,5 кг', MeasureHelper::format(2500.5, $to));
    }

    /**
     * @expectedException \yii\base\Exception
     * @expectedExceptionMessage Unknown object
     */
    public function testFormatException()
    {
        MeasureHelper::format(2500, null);
    }

    public function testT()
    {
        $this->assertSame('Длина', MeasureHelper::t('Length'));
    }
}
