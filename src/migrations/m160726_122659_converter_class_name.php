<?php

use DevGroup\Measure\models\Measure;
use yii\db\Migration;

class m160726_122659_converter_class_name extends Migration
{
    public function up()
    {
        $this->addColumn(Measure::tableName(), 'converter_class_name', $this->string(255)->defaultValue(''));
    }

    public function down()
    {
        $this->dropColumn(Measure::tableName(), 'converter_class_name');
    }
}
