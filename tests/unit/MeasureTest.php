<?php

namespace DevGroup\Measure\tests\unit;

use DevGroup\Measure\models\Measure;

class MeasureTest extends UnitTestCase
{
    public function testUnknownType()
    {
        $measure = Measure::find()->one();
        $measure->type = 'UnknownType';
        $this->assertFalse($measure->validate());
        $this->assertSame(1, count($measure->errors));
        $this->assertTrue(isset($measure->errors['type']));
    }

    public function testUnitUnique()
    {
        $measure = Measure::find()->one();
        $measure->isNewRecord = true;
        $this->assertFalse($measure->validate());
        $this->assertSame(1, count($measure->errors));
        $this->assertTrue(isset($measure->errors['unit']));
    }

    public function testFindByUnit()
    {
        $model1 = Measure::findOne(['unit' => 'kg']);
        $model2 = Measure::getByUnit('kg');
        $this->assertEquals($model1, $model2);
    }

    public function testGetMeasures()
    {
        $this->assertSame((int) Measure::find()->where(['type' => 'Length'])->count(), count(Measure::getMeasures('Length')));
        $list = Measure::getMeasures(null);
        $this->assertSame((int) Measure::find()->count(), count($list));
        $item = Measure::getByUnit('kg');
        $this->assertTrue(isset($list[$item->id]));
        $this->assertSame($item->name, $list[$item->id]);
    }

    public function testConverterClass()
    {
        $measure = new Measure;
        $measure->converter_class_name = '';
        $this->assertTrue($measure->validate(['converter_class_name']));
        $measure->converter_class_name = 'bla\bla\bla';
        $this->assertFalse($measure->validate(['converter_class_name']));
        $measure->converter_class_name = 'yii\db\ActiveRecord';
        $this->assertFalse($measure->validate(['converter_class_name']));
        $measure->converter_class_name = 'DevGroup\Measure\converters\temperature\CelsiusConverter';
        $this->assertTrue($measure->validate(['converter_class_name']));
    }
}
