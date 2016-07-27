<?php

use DevGroup\Measure\models\Measure;
use yii\db\Migration;

class m160727_054127_temperature extends Migration
{
    public function up()
    {
        $this->batchInsert(
            Measure::tableName(),
            ['type', 'name', 'unit', 'rate', 'converter_class_name'],
            [
                ['Temperature', 'Kelvin', '°K', 1, ''],
                ['Temperature', 'Celsius', '°C', 1, 'DevGroup\Measure\converters\temperature\CelsiusConverter'],
                ['Temperature', 'Fahrenheit', '°F', 1, 'DevGroup\Measure\converters\temperature\FahrenheitConverter'],
            ]
        );
    }

    public function down()
    {
        $this->delete(Measure::tableName(), ['type' => 'Temperature']);
    }
}
