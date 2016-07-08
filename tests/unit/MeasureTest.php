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
}
