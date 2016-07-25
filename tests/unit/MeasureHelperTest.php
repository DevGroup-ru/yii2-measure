<?php

namespace DevGroup\Measure\tests\unit;

use DevGroup\Measure\helpers\MeasureHelper;
use DevGroup\Measure\models\Measure;

class MeasureHelperTest extends UnitTestCase
{
    public function testConvert()
    {
        // Length
        $from = Measure::getByUnit('mi');
        $to = Measure::getByUnit('km');
        $this->assertEquals(2*1609.344/1000, MeasureHelper::convert(2, $to, $from));
        // Weight
        $from = Measure::getByUnit('lb');
        $to = Measure::getByUnit('kg');
        $this->assertEquals(300*0.45359237, MeasureHelper::convert(300, $to, $from));
        // Same measure
        $this->assertEquals(300, MeasureHelper::convert(300, $to, $to));
        // that's all
    }

    /**
     * @expectedException \yii\base\Exception
     * @expectedExceptionMessage `from` or `to` parameter is not a Measure
     */
    public function testConvertException()
    {
        MeasureHelper::convert(123, \Yii::$app, new Measure);
    }

    /**
     * @expectedException \yii\base\Exception
     * @expectedExceptionMessage Measures have different types
     */
    public function testConvertException2()
    {
        $from = Measure::getByUnit('m');
        $to = Measure::getByUnit('kg');
        MeasureHelper::convert(123, $from, $to);
    }

    public function testFormat()
    {
        // without converting
        $to = Measure::getByUnit('kg');
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

    public function testParseString()
    {
        $matchRules = [
            '#^(?P<integral>[\d]+)(?:\.(?P<fractional>[\d]+))?$#',
            '#^(?P<integral>[\d]+)(?:\,(?P<fractional>[\d]+))?$#',
        ];
        $this->assertSame(1000.5, MeasureHelper::parseString('1000.50', $matchRules));
        $this->assertSame(1000.5, MeasureHelper::parseString('1000,50', $matchRules));
        $this->assertSame(1000.5, MeasureHelper::parseString('1,000.5', function($s) {return (double) str_replace(',', '', $s);}));
        $this->assertSame(false, MeasureHelper::parseString('1k', $matchRules));
    }
}
